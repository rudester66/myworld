<?php

namespace SJR\Models;

use SJR\Configs\cipher;
use SJR\Controllers\RenderViews;
use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;

class User
{

    /**
     * User constructor.
     * @param string $function
     * @param array $requests
     */
    public static function construct(string $function, array $requests)
    {
        $requests = static::setDefaults($requests);    //  checks the requests, setting defaults if necessary
        $runFunction = static::$function($requests);      //  runs the requested function

        return $runFunction;
    }

    private static function main($requests)
    {
        $array = array(
            'requests' => $requests,
            'component' => '',
        );
        $obj = new pageVariables($array);

        return $obj;
    }


    private static function settings($requests)
    {
        $array = array(
            'requests' => $requests,
            'component' => SJR_VIEW .'/userSettings.php',
        );
        $obj = new pageVariables($array);

        return $obj;
    }


    static public function tableExists()
    {
        $sql = "SELECT table_name 
                        FROM information_schema.tables
                        WHERE table_schema = 'myworld' 
                            AND table_name = 'users'";
        $check = sqlRun::sqlRun($sql, "", array(), "MYWORLD", true);
        if (empty($check)) {
            static::CreateUserTable();
            return false;
        } else {
            return true;
        }
    }


    /**
     * Creates the table and then goes to the add user page to add the first admin user
     * @return void
     */
    static public function CreateUserTable()
    {
        $sql = "
                    CREATE TABLE users (
                            UserID int(13) NOT NULL AUTO_INCREMENT,
                            Forename varchar(100) NOT NULL,
                            Surname varchar(100) NOT NULL,
                            Email varchar(100) NOT NULL COMMENT 'Used as Users Login, must be unique',
                            Password varchar(60) NOT NULL COMMENT 'Users Password to authenticate login',
                            UserLevel int(2) NOT NULL DEFAULT 0 COMMENT 'Level fo user, restricting permissions. Defaults 0 => User, 99 => Admin',
                            UserValid int(1) NOT NULL DEFAULT 1 COMMENT 'Whether User i still valid. Default 1 (True)',
                            UNIQUE (Email),
                            CONSTRAINT PK_UserID PRIMARY KEY (UserID)
                       );
            ";
        sqlRun::sqlRun($sql, "", array(), "MYWORLD", false);

        // Add Admin User
        $insert = array(
            ':Forename' => 'Administrator',
            ':Surname' => 'User',
            ':Email'=> 'admin@test.com',
            ':Password' => cipher::cipher('password'),
            ':UserLevel' => 99,
        );
        sqlRun::sqlRun('insert', 'users', $insert, 'MYWORLD', false);
    }

    static public function getUser($id){
        $db = databaseObjFunction::getMYWORLD();
        $occasions = $db->getUsersFields();
        $sql = "SELECT * 
                    FROM {$db->getUsers()}
                    WHERE {$occasions->getUserID()} = :id ";
        return sqlRun::sqlRun($sql, '', array(':id' => $id), 'MYWORLD', true)[0];
    }

    static public function getUsers(){
        $db = databaseObjFunction::getMYWORLD();
        $occasions = $db->getUsersFields();
        $sql = "SELECT * 
                    FROM {$db->getUsers()} ";
        return sqlRun::sqlRun($sql, '', array(), 'MYWORLD', true);
    }

    /**
     * Sets the required defaults variables needed for this controller and mode
     *      a) Checks all passed variables by $_REQUESTS
     *      b) NO variable passed then set a default
     */
    private static function setDefaults($requests)
    {
        $requests['controller'] = 'Users';
        return $requests;
    }



//  TODO Delete if not used
//        static::addNewAdminUser($requests);

    static public function countUsers()
    {
        $obj = databaseObjFunction::getMYWORLD();
        $sql = "SELECT COUNT(*) AS CT FROM {$obj->getUsers()} ";
        $check = sqlRun::sqlRun($sql, "", array(), "MYWORLD", true);
        return intval($check[0]['CT']);
    }


    static public function addNewAdminUser($requests)
    {
        $requests['component'] = '';
        $variables = sjr::construct('addNewAdminUser', $requests);
        RenderViews::renderPage(SJR_PATH . '/Views/newAdminUser.php', $variables);
    }

}