<?php

namespace SJR\Models;

use App\Models\Occasion;

class Home
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

    static public function main($requests): object
    {
        $requests['anniversaries'] = Occasion::getAnniversaries();
        $array = array(
            'requests' => $requests,
            'component' => VIEW_PATH .'/Homes/pages/anniversaies.php',
        );
        $obj = new pageVariables($array);
        return $obj;
    }


    static public function Error($requests): object
    {
        $array = array(
            'requests' => $requests,
            'component' => SJR_VIEW .'/error.php',
        );
        $obj = new pageVariables($array);
        return $obj;
    }




    /**
     * Sets the required defaults variables needed for this controller and mode
     */
    static private function setDefaults(array $requests):array
    {

        return $requests;
    }

}