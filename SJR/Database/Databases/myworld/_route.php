<?php

namespace SJR\Database\Databases\myworld;

use SJR\Configs\cipher;
use SJR\Configs\Routes;
use SJR\Models\Session;
use SJR\Models\User;

class _route
{
    private $requests;
    private $URI;
    private $pageName;
    private $className;
    private $mode;
    private $userID;
    private $session;
    private $tableExists;
    private $loggedIn;
    private $controllerCheck;

    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            //  checks if property of this class
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
        self::routing();
    }


    private function routing()
    {
        //  Check if the userTable Exists, if false then add table and default Admin User;   Goto Login Page
        self::userTableExists();

        //  If Table Exists
        if ($this->tableExists) {
            self::setClassName();
            self::setPageName();
            //  If ClassName is Logins, not need to check if logged in; check if mode exists
            if ($this->className == 'Logins') {
                self::setControllerCheck();
            } else {
                //  Check if user is logged in, i.e. has a cookie set
                self::setLoggedIn();
                if ($this->loggedIn) {
                    // Check session is valid, last login within 30 minutes
                    self::setSession();
                    if($this->session->getLastLogin() > date("Y-m-d H:i:s", strtotime('-30 minutes'))){
                        self::setControllerCheck();
                        if($this->controllerCheck){
                            //  Valid Controller and Mode, update Session
                            Session::modifySession(cipher::cipher($this->userID));
                        }
                    } else {
                        $this->loggedIn = false;
                        self::gotoLogin('You have been logged out due to being active!');
                    }

                }
            }
        }
    }

    private function userTableExists()
    {
        $tableExists = User::tableExists();
        if (!$tableExists) {
            //  If false then a table is created and a default admin user added
            self::setTableExists(false);
            //  Set PageName, ClassName and Mode to Login
            self::gotoLogin('LOG IN USING THE DEFAULT DETAILS');
        } else {
            self::setTableExists(true);
        }
    }

    private function gotoLogin(string $error)
    {
        header("location: /Logins?error=" .$error);
//        self::setURI('/Logins');
//        self::setClassName();
//        self::setPageName();
//        $requests = self::getRequests();
//        $requests['error'] = $error;
//        $requests['mode'] = '';
//        self::setRequests($requests);
    }

    /**
     * @return mixed
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param mixed $requests
     */
    public function setRequests($requests): void
    {
        $this->requests = $requests;
    }


    /**
     * @return mixed
     */
    public function getURI()
    {
        return $this->URI;
    }

    /**
     * @param mixed $URI
     */
    public function setURI($URI): void
    {
        $this->URI = $URI;
    }

    /**
     * @return mixed
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param mixed $pageName
     */
    public function setPageName(): void
    {
        $this->pageName = Routes::classPath($this->className);
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName(): void
    {
        $this->className = Routes::sortURI(str_replace("/public/", "", $this->URI));
        $requests = $this->getRequests();
        $requests['pageName'] = $this->className;
        $this->setRequests($requests);
    }


    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession(): void
    {
        $this->session = ($this->userID != null ? new _sessions(Session::getSession(cipher::cipher($this->userID))) : null);
    }


    /**
     * @return mixed
     */
    public function getLoggedIn()
    {
        return $this->loggedIn;
    }

    /**
     * @param mixed $loggedIn
     */
    public function setLoggedIn(): void
    {
        if (isset($_COOKIE['userID'])) {
            $this->loggedIn = true;
        } else {
            $this->loggedIn = false;
            self::gotoLogin('You need to log in!');
        }
    }


    /**
     * @return mixed
     */
    public function getTableExists()
    {
        return $this->tableExists;
    }

    /**
     * @param mixed $tableExists
     */
    public function setTableExists($tableExists): void
    {
        $this->tableExists = $tableExists;
    }


    /**
     * @return mixed
     */
    public function getControllerCheck()
    {
        return $this->controllerCheck;
    }

    /**
     * @param mixed $controllerCheck
     */
    public function setControllerCheck()
    {
        //  Check if the controller is a real file; exists
        $pageName = ROOT_PATH . "/" . $this->getPageName() . ".php";
        try {
            is_file($pageName);
            $this->controllerCheck = true;
        } catch (Error $e) {
            $this->controllerCheck = false;
//            echo 'Caught exception: ',  $e->getMessage(), "\n";
//            die();
        }
    }

    private function setError($error)
    {
        //  Send to main page with error
        $this->setURI('/Homes');
        self::setClassName();
        self::setPageName();
        self::setMode('Error');
        $requests = $this->getRequests();
        $requests['error'] = $error;
        $requests['mode'] = 'Error';
        self::setRequests($requests);
        $this->controllerCheck = false;
    }


}