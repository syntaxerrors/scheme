<?php

class ProjectController extends Core_HomeController {

    public function getIndex()
    {
        $projects = Project::where('creatorId', $this->activeUser->id)->get();

        $this->setViewData('projects', $projects);
    }

    public function getCreate()
    {
        // get user groups

        $this->setViewData('owners', array('user:' . Auth::user()->id => 'User: ' . Auth::user()->username));
    }

    public function postCreate()
    {
        $input = e_array(Input::all());

        if ($input != null) {
            $owner = explode(':', $input['owner']);

            $project = new Project;
            $project->name          = $input['name'];
            $project->privateFlag   = isset($input['privateFlag']) ? $input['privateFlag'] : '0';
            $project->ownerType     = $owner[0];
            $project->ownerId       = $owner[1];
            $project->creatorId     = Auth::user()->id;
            
            $this->checkErrorsSave($project);
        }

        return $this->redirect('/project');
    }

    public function getCreateTable($projectId)
    {
        $project = Project::find($projectId);
        $engine = array('myisam' => 'MyiSAM', 'innodb' => 'InnoDB');
        $template = Template::all();

        Menu::setItemList('main', new Menu\Items\ItemList);

        Menu::handler('main')
            ->add('/', 'Home')
            ->add('javascript:void(0);', $project->name . ' Scheme', Menu::items()
                ->add('/project/buildAll/' . $project->id,           'Full project build')
                ->add('/project/buildAllModels/' . $project->id,     'Build all modles')
                ->add('/project/buildAllMigration/' . $project->id,  'Build all migrations')
                ->add('/project/buildAllSeeds/' . $project->id,      'Build all seeds')
                ->add('/project/builds/' . $project->id,      'Project Builds')
            )
            ->add('/project/create-table/' . $project->id, 'Add Table');

        $this->setMenu();

        $this->setViewData('template', $template->lists('name', 'id'));
        $this->setViewData('engine', $engine);
        $this->setViewData('project', $project);
    }

    public function postCreateTable()
    {
        $input = e_array(Input::all());

        if ($input != null) {
            $project = new Table;
            $project->projectId         = $input['projectId'];
            $project->name              = $input['name'];
            $project->className         = $input['className'];
            $project->namespace         = $input['namespace'];
            $project->timestampsFlag    = isset($input['timestampsFlag']) ? $input['timestampsFlag'] : 0;
            $project->softDeletesFlag   = isset($input['softDeletesFlag']) ? $input['softDeletesFlag'] : 0;
            $project->tableTemplateId   = $input['templateId'];
            $project->postionLeft       = 30;
            $project->postionTop        = 60;
            $project->extends           = $input['extends'];
            
            $this->checkErrorsSave($project);
        }

        return $this->redirect('/project/view/' . $input['projectId']);
    }

    public function getCreateColumn($tableId)
    {
        $columnTypes = Column_Type::all();

        $columnAttributes = [
            'NONE' => 'None',
            // 'BINARY' => '',
            'UNSIGNED' => 'Unsigned',
            // 'UNSIGNED ZEROFILL' => ''
        ];

        $indexes = [
            'NONE' => 'None',
            'INDEX' => 'Index',
            'PRIMARY_KEY' => 'Primary Key',
            'UNIQUE' => 'Unique'
        ];

        $this->setViewData('columnAttributes', $columnAttributes);
        $this->setViewData('indexes', $indexes);
        $this->setViewData('columnTypes', $columnTypes->lists('name', 'id'));
        $this->setViewData('tableId', $tableId);
    }

    public function postCreateColumn()
    {
        $input = e_array(Input::all());

        if ($input != null) {
            $table = Table::find((int) $input['tableId']);

            $column = new Column;
            $column->tableId           = $table->id;
            $column->name              = $input['name'];
            $column->typeId            = $input['typeId'];
            $column->defaultValue      = $input['defaultValue'];
            $column->value             = $input['value'];
            $column->attribute         = $input['attribute']; // Should this be an unsigned flag?
            $column->index             = $input['index'];
            $column->nullableFlag      = isset($input['nullableFlag'])       ? $input['nullableFlag']        : 0;
            $column->autoIncrementFlag = isset($input['autoIncrementFlag'])  ? $input['autoIncrementFlag']   : 0;
            $column->fillableFlag      = isset($input['fillableFlag'])       ? $input['fillableFlag']        : 0;
            $column->visibleFlag       = isset($input['visibleFlag'])        ? $input['visibleFlag']         : 0;
            $column->guardedFlag       = isset($input['guardedFlag'])        ? $input['guardedFlag']         : 0;
            $column->hiddenFlag        = isset($input['hiddenFlag'])         ? $input['hiddenFlag']          : 0;
            $column->order             = count($table->columns);
            
            $this->checkErrorsSave($column);
        }

        return $this->redirect('/project/view/' . $table->projectId);
    }

    public function getView($scheme)
    {
        // eager load data needed to generate page.
        $scheme = Project::with([
            'tables',
            'tables.columns' => function ($query) {
                $query->orderBy('order', 'asc');
            },
            'tables.columns.type',
            'tables.template',
            'tables.local',
            'tables.local.type',
            'tables.foreign',
            'tables.foreign.type',
            'tables.through',
            'tables.through.type'
        ])
        ->find($scheme);

        Menu::setItemList('main', new Menu\Items\ItemList);

        Menu::handler('main')
            ->add('/', 'Home')
            ->add('javascript:void(0);', $scheme->name . ' Scheme', Menu::items()
                ->add('/project/buildAll/' . $scheme->id,           'Full project build')
                ->add('/project/buildAllModels/' . $scheme->id,     'Build all modles')
                ->add('/project/buildAllMigration/' . $scheme->id,  'Build all migrations')
                ->add('/project/buildAllSeeds/' . $scheme->id,      'Build all seeds')
                ->add('/project/builds/' . $scheme->id,      'Project Builds')
            )
            ->add('/project/create-table/' . $scheme->id, 'Add Table');

        $this->setMenu();

        $this->setViewData('scheme', $scheme);
    }

    public function postUpdateTableLocation()
    {
        $input = Input::all();

        $input['id'] = str_replace('dbtable_', '', $input['id']);

        $table = Table::find((int) $input['id']);
        $table->postionLeft = (int) $input['postionLeft'];
        $table->postionTop = (int) $input['postionTop'];
        $table->save();

        // return true;
    }

    public function postUpdateTableOrder()
    {
        $input = Input::all();

        $columns = explode(',', $input['order']);
        foreach ($columns as $key => $column) {
            $column = Column::find($column);
            $column->order = $key;
            $column->save();
        }

        // return true;
    }

    public function getDeleteColumn($columnId)
    {
        $column = Column::with([
            'type',
            'local',
            'local.type',
            'foreign',
            'foreign.type',
            'through',
            'through.type'
        ])->find($columnId);

        $this->setViewData('column', $column);
    }

    public function postDeleteColumn()
    {
        $input = Input::all();

        $column = Column::find($input['columnId']);

        if ( $column->loacl->count() > 0) {
            $column->local->delete();
        }

        if ( $column->foreign->count() > 0) {
            $column->foreign->delete();
        }

        if ( $column->through->count() > 0) {
            $column->through->delete();
        }

        $column->delete();

    }

}