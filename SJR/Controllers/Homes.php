<?php

namespace SJR\Controllers;


use SJR\Controllers\RenderViews;
use SJR\Configs\cipher;
use SJR\Database\sqlRun;
use SJR\Models\Home;
use SJR\Models\Session;

class Homes
{

    /**
     *      Checks is a mode variable to passed, is so then run the function
     *          otherwise run the default
     */
   static public function main($requests)
    {
        $requests = self::setDefaults($requests);
        if (array_key_exists('mode', $requests)) {
            $functionName = $requests['mode'];
            self::$functionName($requests);
        } else {
            $variables = Home::construct('main', $requests);
            RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
        }
    }

    static public function insertAdminUser($requests)
    {
        $insert = array(
            ':Forename' => $requests['Forename'],
            ':Surname' => $requests['Surname'],
            ':Email' => $requests['Email'],
            ':Password' => cipher::cipher($requests['Password']),
            ':UserLevel' => $requests['UserLevel'],
        );
        $userID = sqlRun::sqlRun('insert', 'users', $insert, 'MYWORLD', false);

        //  Set Cookie
        $cookie_name = "userID";
        $cookie_value = cipher::cipher($userID);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        //  Insert into session table
        Session::addSession($userID);
        header('Location: Homes');
    }


    static private function Error($requests){
        $variables = Home::construct('Error', $requests);
        \SJR\Controllers\RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
    }


    static public function setDefaults(array $requests): array
    {
        return $requests;
    }


}