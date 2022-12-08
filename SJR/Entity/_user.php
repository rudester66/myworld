<?php

namespace SJR\Entity;
use SJR\Database\sqlRun;

class _user
{
    private $UserID;
    private $Forename;
    private $Surname;
    private $Email;
    private $Password;
    private $UserLevel;
    private $UserValid;

    //  Other fields
    private $Fullname;

    private $insert;
    private $Update;

    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
        self::setFullname();
    }

    private function usersArray(){
        return array(
            0 => 'UserID',
            1 => 'Forename',
            2 => 'Surname',
            3 => 'Email',
            4 => 'Password',
            5 => 'UserLevel',
            6 => 'UserValid',
        );
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
    public function getFullname()
    {
        return $this->Fullname;
    }

    /**
     * @param mixed $Fullname
     */
    public function setFullname(): void
    {
        $this->Fullname = $this->Forename ." " .$this->Surname;
    }

    /**
     * @return mixed
     */
    public function getInsert()
    {
        return $this->insert;
    }

    /**
     * @param mixed $insert
     */
    public function setInsert(): void
    {
        $insert = array();
        foreach($this->usersArray() AS $key=>$value){
            $insert[':' .$value] = $this->$value;
        }
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
        $set = array();
        foreach($this->usersArray() AS $key=>$value){
            $set[':' .$value] = $this->$value;
        }
        $update = array(
            'SET' => $set,
            'WHERE' => array(
                ':UserID' => $this->UserID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'users', $update, 'MYWORLD', false);
    }





}