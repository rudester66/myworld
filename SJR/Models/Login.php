<?php

namespace SJR\Models;

use SJR\Configs\cipher;
use SJR\Database\sqlRun;

class Login
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

    static private function main($requests)
    {
        $array = array(
            'requests' => $requests,
        );
        $obj = new \SJR\Models\pageVariables($array);

        return $obj;
    }


    static private function checkLogin($requests){
        $sql = "SELECT UserID
                    FROM users
                    WHERE Email = :email
                        AND Password = :password ";
        $result = sqlRun::sqlRun($sql, '', array(':email' =>  $requests['Email'], ':password' => cipher::cipher($requests['Password'])), 'MYWORLD');
        if(empty($result)){
            // set the expiration date to one hour ago
            setcookie("userID", "", time() - 3600);
           $error = 'Incorrect credentials, please try again!!';
            header('Location: /Logins?&error=' .$error);
        } else {
            //  Set Cookie
            $cookie_name = "userID";
            $cookie_value = cipher::cipher($result[0]['UserID']);
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            //  Insert into session table
            Session::addSession(cipher::cipher($result[0]['UserID']));
            header('Location: /');
        }

    }


    /**
     * Sets the required defaults variables needed for this controller and mode
     */
    static private function setDefaults(array $requests):array
    {

        return $requests;
    }

}