<?php

namespace SJR\Models;

use SJR\Configs\cipher;
use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;

class Session
{
    /**
     * Returns the session variables for the specified user
     * @return array|false|string|null
     */
    static public function getSession($id)
    {
        $obj = databaseObjFunction::getMYWORLD();
        $session = $obj->getSessionsFields();
        $sql = "SELECT * 
                    FROM {$obj->getSessions()}
                    WHERE {$session->getUsersID()} = :id ";
        $result = sqlRun::sqlRun($sql, '', array(':id' => $id), 'MYWORLD', true);
        if(!empty($result)){
            return $result[0];
        } else {
            return array();
        }
    }

    /**
     * Checks if user exists, if so modify else add
     * @param $userID
     * @return void
     */
    static public function addSession($userID)
    {
        //  Check if session exists for user
        $check = static::getSession($userID);
        if($check){
            static::modifySession($userID);
        } else {
            static::insertSession($userID);
        }
    }

    /**
     * Insert a new session into the database
     * @param $userID
     * @return void
     */
    static public function insertSession($userID)
    {
        $insert = array(
            ':UsersID' => $userID,
            ':LastLogin' => date("Y-m-d H:i:s"),
        );
        sqlRun::sqlRun('insert', 'sessions', $insert, 'MYWORLD', false);
    }

    /**
     * Update the seesion table for the specified user
     * @param $userID
     * @return void
     */
    static public function modifySession($userID)
    {
        $update = array(
            'SET' => array(
                ':LastLogin' => date("Y-m-d H:i:s"),
            ),
            'WHERE' => array(
                ':UsersID' => $userID,
            ),
        );
        sqlRun::sqlRun('update', 'sessions', $update, 'MYWORLD', false);
    }


}