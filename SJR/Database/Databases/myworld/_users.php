<?php

namespace SJR\Database\Databases\myworld;

use App\Models\Occasion;
use SJR\Configs\cipher;
use SJR\Database\sqlRun;
use SJR\Models\User;

class _users
{
    private $UserID;
    private $Forename;
    private $Surname;
    private $Email;
    private $Password;
    private $UserLevel;
    private $UserValid;

    //  Functions
    private $SelectOne;
    private $SelectAll;
    private $Insert;
    private $Update;

    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            //  checks if property of this class
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
    }

    private function usersArray(){
        $array = array(
            0 => 'UserID',
            1 => 'Forename',
            2 => 'Surname',
            3 => 'Email',
            4 => 'Password',
            5 => 'UserLevel',
            6 => 'UserValid',
        );
        $this->setPassword(cipher::cipher($this->Password));
        $return = array();
        foreach($array AS $key=>$value){
            $return[':' .$value] = $this->$value;
        }
        return $return;
    }


    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->UserID;
    }

    /**
     * @param mixed $UserID
     */
    public function setUserID($UserID): void
    {
        $this->UserID = $UserID;
    }

    /**
     * @return mixed
     */
    public function getForename()
    {
        return $this->Forename;
    }

    /**
     * @param mixed $Forename
     */
    public function setForename($Forename): void
    {
        $this->Forename = $Forename;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * @param mixed $Surname
     */
    public function setSurname($Surname): void
    {
        $this->Surname = $Surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     */
    public function setPassword($Password): void
    {
        $this->Password = $Password;
    }

    /**
     * @return mixed
     */
    public function getUserLevel()
    {
        return $this->UserLevel;
    }

    /**
     * @param mixed $UserLevel
     */
    public function setUserLevel($UserLevel): void
    {
        $this->UserLevel = $UserLevel;
    }

    /**
     * @return mixed
     */
    public function getUserValid()
    {
        return $this->UserValid;
    }

    /**
     * @param mixed $UserValid
     */
    public function setUserValid($UserValid): void
    {
        $this->UserValid = $UserValid;
    }

    /**
     * @return mixed
     */
    public function getSelectOne()
    {
        return $this->SelectOne;
    }

    /**
     * @param mixed $SelectOne
     */
    public function setSelectOne($id): void
    {
        $results = User::getUser($id);
        foreach($this->usersArray() AS $key=>$value){
            $prop = 'set' .$value;
            $this->$prop($results[$value]);
        }
    }

    /**
     * @return mixed
     */
    public function getSelectAll()
    {
        return $this->SelectAll;
    }

    /**
     * @param mixed $SelectAll
     */
    public function setSelectAll($SelectAll): void
    {
        $results = User::getUsers();
        foreach($this->usersArray() AS $key=>$value){
            $prop = 'set' .$value;
            $this->$prop($results[$value]);
        }
        $this->SelectAll = $SelectAll;
    }

    /**
     * @return mixed
     */
    public function getInsert()
    {
        return $this->Insert;
    }

    /**
     * @param mixed $Insert
     */
    public function setInsert($obj): void
    {
        $insert = self::usersArray();
        $this->Insert  = sqlRun::sqlRun('insert', 'users', $insert, 'MYWORLD', false);
    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->Update;
    }

    /**
     * @param mixed $Update
     */
    public function setUpdate(): void
    {
        $update = array(
            'SET' => self::usersArray(),
            'WHERE' => array(
                ':UserID' => $this->UserID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'users', $update, 'MYWORLD', false);
    }




}