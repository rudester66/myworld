<?php

namespace SJR\Controllers;

use SJR\Models\Setting;
use SJR\Models\User;

class Settings
{
    /**
     *      Checks is a mode variable to passed, is so then run the function
     *          otherwise run the default
     */
    static public function main($requests)
    {
        $requests = self::setDefaults($requests);
        if (array_key_exists('mode', $requests) && $requests['mode'] != '') {
            $functionName = $requests['mode'];
            self::$functionName($requests);
        } else {
            $variables = Setting::construct('main', $requests);
            RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
        }
    }





    static public function setDefaults(array $requests):array
    {

        return $requests;
    }


}