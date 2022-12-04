<?php

namespace SJR\Configs;

use App\Models\Member;
use SJR\Database\Databases\myworld\_route;

class Routes
{
    public function __construct()
    {
    }

    static public function getRoute()
    {
        $requests = static::setDefaults($_REQUEST);
        $URI = str_replace("/public/", "", $_SERVER['REQUEST_URI']);
        $requests['class'] = str_replace("/","",substr($URI, 0, strpos($URI, "?")));
        $inArray = array(
            'requests' => $requests,
            'URI' => str_replace("/public/", "", $_SERVER['REQUEST_URI']),
            'mode' => ($requests['mode'] ?? 'main'),
            'userID' => (cipher::uncipher($_COOKIE['userID']??null)),
        );
        $route = new _route($inArray);
//        viewArray($inArray, $route);exit;
        try {
            $route->getPageName()::main($route->getRequests());
        } catch (Error $e) {
//            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }


    /**
     * Extracts the pageName from the URI, the part from the first forward slash to the question mark
     */
    static public function sortURI($URI)
    {
        $pos = strpos($URI, "?");
        $pageName = substr($URI, 1, ($pos > -1 ? ($pos - 1) : strlen($URI)));
        //  If no pagename is passed then goto Homes controller
        if ($pageName == '') {
            $pageName = 'Homes';
        }
        return $pageName;
    }




    static public function classPath($class):string
    {
        $sjr = array(
            'Homes' => 'SJR\Controllers\\',
            'Logins' => 'SJR\Controllers\\',
            'Users' => 'SJR\Controllers\\',
            'Settings' => 'SJR\Controllers\\',
        );

        if (array_key_exists($class, $sjr)) {
            return $sjr[$class] . $class;
        } else {
            return 'App\Controllers\\' . $class;
        }
    }


    /**
     * Sets the required defaults variables needed for this controller and mode
     *      a) Checks all passed variables by $_REQUESTS
     *      b) Checks all passed variables by $_SERVER['REQUEST_URI']
     *      c) NO required variable passed then set a default value
     */
    static private function setDefaults(array $requests): array
    {

        return $requests;
    }


}