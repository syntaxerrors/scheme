<?php
/**
 * Helper Methods
 *
 * This class provides function helpful for development of the site.
 *
 *
 * @author      Stygian <stygian.warlock.v2@gmail.com>
 * @package     Helpers
 * @subpackage  Global
 * @version     0.1
 */

function getInputData($name)
{
    // we should get old data and database fileds all in one method.
}

/**
 * Print Pre data.
 *
 * @param mixed $data   The data you would like to display
 * @param bool  $return Return the data instad of echoing it.
 *
 * @return string $output The data to display wrapped in pre tags.
 */
function pp($data, $return = false)
{
    $output = '<pre>';
    $output .= print_r($data, true);
    $output .= "</pre>";

    if ($return == true) {
        return $output;
    } else {
        echo $output;
    }
}

/**
 * Print Pre and die.
 *
 * @param mixed $data The data you would like to display
 *
 * @return void
 */
function ppd($data)
{
    $output = '<pre>';
    $output .= print_r($data, true);
    $output .= "</pre>";

    echo $output;
    die;
}

/**
 * Convert HTML characters to entities.
 *
 * The encoding specified in the application configuration file will be used.
 *
 * @param string[] $array
 *
 * @return string[]
 */
function e_array($array)
{
    foreach ($array as $key => $value) {
        if ( is_array($value) ) {
            $array[$key] = e_array($value);
        } else {
            $array[$key] = HTML::entities($value);
        }
    }

    return $array;
}

/**
 * Add the active class to an element if the url matchs the arguments.
 *
 * @param  string[] $controller An array of controller then action arguments to check for.
 * @param  bool     $justActive Return class="active" or just active.
 *
 * @return string
 */
function routeIs($controller, $justActive = false)
{
    if (!is_array($controller)) {
        if ($controller == '/' && Request::segment(1) == null) {
            return "class='active'";
        }
        if ( Request::segment(1) == $controller ) {
            if ($justActive) {
                return "active";
            } else {
                return "class='active'";
            }
        }
    } else {
        if ( Request::segment(1) == $controller[0]
                && Request::segment(2) == $controller[1]) {
            if ($justActive) {
                return "active";
            } else {
                return "class='active'";
            }
        }
    }

    return false;
}

function percent ($num_amount, $num_total)
{
    if($num_amount == 0 || $num_total == 0){
        return 0;
    }
    else {
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
}

function classify($value)
{
    $value  = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    $search = array('_', '-', '.', '/',':');

    return str_replace(' ', '_', str_replace($search, ' ', $value));
}

function cleanRoute($route, $returnArray = false)
{
    $route         = str_replace('_', '.', $route);
    $routeParts    = explode('@', $route);
    $routeParts[1] = preg_replace('/^get/', '', $routeParts[1]);
    $routeParts[1] = preg_replace('/^post/', '', $routeParts[1]);
    $route         = strtolower(str_replace('Controller', '', implode('.', $routeParts)));

    if ($returnArray == true) {
        $route  = explode('.', $route);
    }

    return $route;
}

function variableObject($object, $tap)
{
    if (strpos($tap, '->')) {
        $fields = explode('->', $tap);
        foreach ($fields as $field) {
            $object = $object->$field;
        }
    } else {
        $object = $object->$tap;
    }

    return $object;
}