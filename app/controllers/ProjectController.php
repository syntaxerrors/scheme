<?php

class ProjectController extends Core_HomeController {

    public function getIndex()
    {
        $projects = Project::where('creatorId', $this->activeUser->id)->get();

        $this->setViewData('projects', $projects);
    }

    public function getView($scheme)
    {
        $scheme = Project::find($scheme);
        Menu::handler('main')
            ->add('javascript:void(0);', $scheme->name, Menu::items()
                ->add('/scheme/buildAll',           'Full project build')
                ->add('/scheme/buildAllModels',     'Build all modles')
                ->add('/scheme/buildAllMigration',  'Build all migrations')
                ->add('/scheme/buildAllSeeds',      'Build all seeds'));
    }
}