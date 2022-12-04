<?php

namespace SJR\Database;

use SJR\Database\Databases\myworld\_myworld;

class _databases
{
    private $MYWORLD;

    public function __construct()
    {
        $database = definedDB::databases();
        foreach ($database as $key => $value) {
            //  checks if property of this class
            if (property_exists($this, $value)) {
                $this->$value = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMYWORLD()
    {
        return new _myworld(definedDB::MYWORLD());
    }

    /**
     * @param mixed $MYWORLD
     */
    public function setMYWORLD($MYWORLD): void
    {
        $this->MYWORLD = $MYWORLD;
    }



}