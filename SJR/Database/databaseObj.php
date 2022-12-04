<?php

namespace SJR\Database;

use SJR\Database\_databases;

/**
 * Singleton to ensure only one database object
 */
class databaseObj
{

    // declare two private variables
    private static $databases = null;

    // Since it's constructor method is private it prevents objects from being created from outside of the class
    private function __construct(){  }

    /**
     * Retrieves the connection objects, creating a new instance if required
     * @return mixed|PDODatabase|void
     */
    public static function getDatabaseObj()
    {
        if (self::$databases == null ) {
            try {
                self::$databases = new _databases();
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$databases;
    }

}