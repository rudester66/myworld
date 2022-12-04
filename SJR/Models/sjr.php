<?php

namespace SJR\Models;

use Core\Configs\pageVariables;

class sjr
{

    /**
     * Member constructor.
     * @param string $function
     * @param array $requests
     */
    public static function construct(string $function, array $requests)
    {
        $requests['getEvents'] = true;

        $requests = static::setDefaults($requests);    //  checks the requests, setting defaults if necessary
        $runFunction = static::$function($requests);      //  runs the requested function

        return $runFunction;
    }


    static private function addNewAdminUser($requests)
    {
        $array = array(
            'requests' => $requests,
            'CSS' => array(
                0 => '/SJR/sjr.css',
            ),
        );
        $obj = new \SJR\Models\pageVariables($array);

        return $obj;

    }


    /**
     * Sets the required defaults variables needed for this controller and mode
     */
    static private function setDefaults($requests)
    {

        return $requests;
    }
}