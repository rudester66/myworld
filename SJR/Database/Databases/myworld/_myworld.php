<?php

namespace SJR\Database\Databases\myworld;


use App\Entity\_occasions;
use Core\Databases\sjr\_membersFields;
use Core\Databases\sjr\_occasionsFields;
use Core\Databases\sjr\_taglinksFields;

class _myworld
{
    private $users;
    private $sessions;
    private $occasions;
    private $members;
    private $taglinks;


    //  Get Fields
    private $usersFields;
    private $sessionsFields;
    private $occasionsFields;
    private $membersFields;
    private $tagLinksFields;

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
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members): void
    {
        $this->members = $members;
    }



    /**
     * @return mixed
     */
    public function getTaglinks()
    {
        return $this->taglinks;
    }

    /**
     * @param mixed $taglinks
     */
    public function setTaglinks($taglinks): void
    {
        $this->taglinks = $taglinks;
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
        return new _occasionsFields(defineMyworld::getFields('occasions'));
    }

    /**
     * @param mixed $occasionsFields
     */
    public function setOccasionsFields($occasionsFields): void
    {
        $this->occasionsFields = $occasionsFields;
    }

    /**
     * @return mixed
     */
    public function getMembersFields()
    {
        return new _membersFields(defineMyworld::getFields('members'));
    }

    /**
     * @param mixed $membersFields
     */
    public function setMembersFields($membersFields): void
    {
        $this->membersFields = $membersFields;
    }


    /**
     * @return mixed
     */
    public function getTagLinksFields()
    {
        return new _taglinksFields(defineMyworld::getFields('tagLinks'));
    }

    /**
     * @param mixed $tagLinksFields
     */
    public function setTagLinksFields($tagLinksFields): void
    {
        $this->tagLinksFields = $tagLinksFields;
    }





}