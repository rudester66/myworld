<?php

namespace SJR\Database;

use SJR\lib\PDODatabase;

include "definedConnections.php";

class Singleton
{

    // declare two private variables
    private static $instance = null;

    // Since it's constructor method is private it prevents objects from being created from outside of the class
    private function __construct(){  }

    /**
     * Retrieves the connection objects, creating a new instance if required
     * @param $conn
     * @return mixed|PDODatabase|void
     */
    public static function getInstance($conn)
    {
        if (self::$instance == null || !array_key_exists($conn, self::$instance)) {
            try {
                self::$instance[$conn] = static::getConnection($conn);
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance[$conn];
    }

    /**
     * Returns the connection object
     * @param $conn
     * @return PDODatabase|void
     */
    private static function getConnection($conn)
    {
        $connection = unserialize(CONNECTIONS)[$conn];
        try {
                $singleton = new PDODatabase($connection['connection'] . "," . $connection['username'] . "," . $connection['password']);
                $singleton->conn = $conn;
            //  Added connection name to identify the connection in the object
            return $singleton;
        } catch (PDOException $e) {
            trigger_error($e->getMessage() .'boo', E_USER_ERROR);
        }
    }




}