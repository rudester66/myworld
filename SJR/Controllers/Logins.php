<?php

namespace SJR\Controllers;

use SJR\Models\Login;

class Logins
{
    /**
     *      Checks is a mode variable to passed, is so then run the function
     *          otherwise run the default
     */
    static public function main($requests)
    {
        $requests = self::setDefaults($requests);
//        viewArray($requests); exit;
        if (array_key_exists('mode', $requests) && $requests['mode'] != '') {
            $functionName = $requests['mode'];
            self::$functionName($requests);
        } else {
            $variables = Login::construct('main', $requests);
            RenderViews::renderPage(SJR_VIEW .'/login.php', $variables);
        }
    }


    static private function checkLogin($requests){
        $variables = Login::construct('checkLogin', $requests);
        RenderViews::renderPage($variables->getComponent(), $variables);
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