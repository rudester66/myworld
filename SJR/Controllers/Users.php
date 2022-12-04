<?php

namespace SJR\Controllers;

use SJR\Models\User;

class Users
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
            $variables = User::construct('main', $requests);
            RenderViews::renderPage(SJR_VIEW .'/login.php', $variables);
        }
    }


    static private function settings($requests){
        $variables = User::construct('settings', $requests);
        RenderViews::renderPage(BASE_PAGE_INDEX, $variables);

    }



    static public function setDefaults(array $requests):array
    {
        if(isset($_COOKIE['UserID'])){
            $requests['UserID'] = $_COOKIE['UserID'];
        } else {
            $requests['UserID'] = '';
        }

        if(!isset($requests['error'])){
            $requests['error'] = '';
        }
        return $requests;
    }


}