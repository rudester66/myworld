<?php

namespace SJR\Models;

use App\Entity\occasionsPage;
use Core\Databases\sjr\_occasions;
use SJR\Entity\usersPage;

class Setting
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
        $inArray = array();
        $array = array(
            'requests' => $requests,
            'Settings' => new usersPage($inArray),
            'component' => SJR_VIEW .'/settings.php',
        );
//        viewArray($array);exit;
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