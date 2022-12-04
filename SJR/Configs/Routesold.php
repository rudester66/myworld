<?php

namespace SJR\Configs;

use SJR\Controllers\RenderViews;
use SJR\Database\sqlRun;
use SJR\Models\sjr;

class Routesold
{

    private $requests;
    private $URI;
    private $pageName;
    private $className;

    private $controllers;
    private $controller = false;
    private $mode = false;
    private $error = '';
    private $checkMembers;
    private $sessionCheck;


    public function __construct()
    {
        $this->requests = $_REQUEST; //Get the request variables
        $this->URI = $_SERVER['REQUEST_URI'];
    }

    public function getRoute()
    {
        self::sortURI();            //Getting pageName
        self::checkNOMembers();
        if ($this->checkMembers === true) {
            self::sessionCheck();       //  Checks the session variable, see if logged in and how overdue
            self::controllerCheck();    //  Checks if the controller and mode is valid
            self::forwardController();  //  If need redirecting to another
        } else {
            include VIEW_PATH . '/Member/Pages/newMainMember.php';
        }
    }

    private function checkNOMembers()
    {
//        TODO sort out the member class, to check
        $this->checkMembers = true;

//        $count = Member::countMembers();
//        if ($count > 0 || (array_key_exists('mode', $this->requests) && $this->requests['mode'] == 'insertMember')) {
//            $this->checkMembers = true;
//        } else {
//            if ($this->pageName == '/Member?mode=insertMember') {   //  Ignore inserting a new member
//                $this->checkMembers = true;
//            } else {
//                $this->checkMembers = false;
//            }
//        }
    }

    private function forwardController()
    {
        $this->requests['pageName'] = $this->pageName;
        $this->controllers = new $this->className($this->requests);
        $this->controllers->main();
    }


    /**
     *  Checks the following:
     *     1)  if there is a session ID variable, meaning user logged in and last update is within the last 30 minutes
     *     2)  if controller is the login page
     */
    private function sessionCheck()
    {
        $this->sessionCheck = true; //TODO sort out SessionCheck
//
//       // 2)  if controller is the login page
//        if ($this->pageName == 'login' || $this->pageName == '') {pageN
//            $this->sessionCheck = true;
//        } else if (($_SESSION['userID'] > 0)) {
//        // 1)  if there is a session ID variable, means user logged in
//            //lastUpdate is within 30 mins
//            if ($_SESSION['lastUpdate'] > date("Y-m-d H:i:s", strtotime(' -30 minutes'))) {
//                $this->sessionCheck = true;
//            } else {
//                $this->sessionCheck = true;
//                $this->error = 'YOU HAVE BEEN LOGGED OUT DUE TO INACTIVITY';
//            }
//        }
    }

    /**
     * Checks the following:
     *   1) Page is login
     *   2)
     */
    private function controllerCheck()
    {

        //User not logged in, or logged out due to inactivity
        if ($this->sessionCheck === false) {
            //Redirect to Login Page
            header('Location: login' . ($this->error == '' ? '' : '&error=' . $this->error));
        } else {
            if ($this->className == 'Controllers') {
                //If home page then true
                $this->controller = true;
            } else if (is_file('App/Controllers/' . $this->className . '.php')) {
                //Do not need to do anything as routes will automatically send to required controller
                $this->controller = true;
            } else {
                //Controller class does not exist
                $this->error = 'THE PAGE YOU ARE TRYING TO GET TO DOES NOT EXIST';
            }
            //If controller class exists and mode variable passed
            if ($this->controller === true && array_key_exists('mode', $this->requests)) {
                //check mode/function exists
                if (method_exists($this->controllers, $this->requests['mode'])) {
                    $this->mode = true;
                } else {
                    //Mode does not exists for this controller class
                    $this->error = 'YOU ARE ON A PAGE THAT DOES NOT HAVE THE ABILITY TO ' . STRTOUPPER($this->mode);
                }
            } else {
                $this->mode = true;
            }
        }
//        var_dump($this); exit;
    }


    /**
     * Extracts the pageName from the URI, the part from the first forward slash to the question mark
     */
    private function sortURI()
    {
        $pos = strpos($this->URI, "?");
        $this->pageName = substr($this->URI, 1, ($pos > -1 ? ($pos - 1) : strlen($this->URI)));
        //  If no pagename is passed then goto Organisers
        if($this->pageName == ''){ $this->pageName = 'Homes'; }
        if($this->pageName == 'Homes'){
            $this->className = "\SJR\Controllers\\$this->pageName";
        } else {
            $this->className = "\App\Controllers\\$this->pageName";
        }

    }


}