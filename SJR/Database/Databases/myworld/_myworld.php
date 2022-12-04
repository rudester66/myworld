<?php

namespace SJR\Database\Databases\myworld;


use Core\Databases\sjr\_occasions;

class _myworld
{
    private $users;
    private $sessions;
    private $occasions;


    //  Get Fields
    private $usersFields;
    private $sessionsFields;
    private $occasionsFields;

    public function __construct(array $inArray)
    {
        if (is_array($inArray)) {
            $loop = array_keys($inArray);
            foreach ($loop as $key => $value) {
                if (property_exists($this, $value)) {
                    $this->$value = $inArray[$value];
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param mixed $sessions
     */
    public function setSessions($sessions): void
    {
        $this->sessions = $sessions;
    }

    /**
     * @return mixed
     */
    public function getOccasions()
    {
        return $this->occasions;
    }

    /**
     * @param mixed $occasions
     */
    public function setOccasions($occasions): void
    {
        $this->occasions = $occasions;
    }



    /**
     * @return mixed
     */
    public function getUsersFields()
    {
        return new _users(defineMyworld::getFields('users'));
    }

    /**
     * @param mixed $usersFields
     */
    public function setUsersFields($usersFields): void
    {
        $this->usersFields = $usersFields;
    }

    /**
     * @return mixed
     */
    public function getSessionsFields()
    {
        return new _sessions(defineMyworld::getFields('sessions'));
    }

    /**
     * @param mixed $sessionsFields
     */
    public function setSessionsFields($sessionsFields): void
    {
        $this->sessionsFields = $sessionsFields;
    }

    /**
     * @return mixed
     */
    public function getOccasionsFields()
    {
        return new _occasions(defineMyworld::getFields('occasions'));
    }

    /**
     * @param mixed $occasionsFields
     */
    public function setOccasionsFields($occasionsFields): void
    {
        $this->occasionsFields = $occasionsFields;
    }





}