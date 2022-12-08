<?php

namespace SJR\Entity;

use SJR\Configs\cipher;
use SJR\Models\User;

class usersPage
{
    private $CurrentUser;
    private $AllUsers;


    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
        self::setCurrentUser();
        self::setAllUsers();
    }

    /**
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->CurrentUser;
    }

    /**
     * @param mixed $CurrentUser
     */
    public function setCurrentUser(): void
    {
        $user = User::getUser(cipher::uncipher($_COOKIE['userID']));
        $this->CurrentUser = new _user($user);
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->AllUsers;
    }

    /**
     * @param mixed $AllUsers
     */
    public function setAllUsers(): void
    {
        $users = User::getUsers();
        $usersArray = [];
        foreach($users AS $key=>$value){
            $usersArray[$key] = new _user($value);
        }
        $this->AllUsers = $usersArray;
    }



    

}