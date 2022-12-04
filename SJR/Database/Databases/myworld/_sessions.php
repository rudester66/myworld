<?php

namespace SJR\Database\Databases\myworld;

class _sessions
{

private $SessionID;
private $UsersID;
private $LastLogin;

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

    /**
     * @return mixed
     */
    public function getSessionID()
    {
        return $this->SessionID;
    }

    /**
     * @param mixed $SessionID
     */
    public function setSessionID($SessionID): void
    {
        $this->SessionID = $SessionID;
    }

    /**
     * @return mixed
     */
    public function getUsersID()
    {
        return $this->UsersID;
    }

    /**
     * @param mixed $UsersID
     */
    public function setUsersID($UsersID): void
    {
        $this->UsersID = $UsersID;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->LastLogin;
    }

    /**
     * @param mixed $LastLogin
     */
    public function setLastLogin($LastLogin): void
    {
        $this->LastLogin = $LastLogin;
    }


}