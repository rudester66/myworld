<?php

namespace SJR\Database;

use SJR\Database\Singleton;

class sqlRun
{
    public function __construct()
    {
    }

    /**
     * @param string $sql
     * @param string $table
     * @param array $array
     * @param string $conn
     * @param boolean $fetch
     * @return array|false|string|void
     */
    public static function sqlRun($sql, $table, $array, $conn, $fetch = true)
    {
        //  Connection object
        $singleton = Singleton::getInstance($conn);;
        try {
            //  Format sql
            $formatSQL = static::formatSQL($sql, $table, $array, $fetch);
            $sql = $formatSQL['sql'];
            $array = $formatSQL['array'];
            $fetch = $formatSQL['fetch'] == null ? $fetch : $formatSQL['fetch'];

            $sth = $singleton->prepare($sql);
            $sth->execute($array);
            if ($fetch == true) {
                return $sth->fetchAll( \PDO::FETCH_ASSOC);
            } else {
                $lastInsertID = $singleton->lastInsertId();
                return $lastInsertID;
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage() . "| " . $sql, E_USER_ERROR);
        }
    }


    private static function formatSQL($inSQL, $table, $array, $fetch)
    {
        switch ($inSQL) {

            case "insert":
                $sql = "INSERT INTO " . $table . "
                        ( ";
                $x = 0;
                foreach ($array as $key => $value) {
                    if ($x > 0) {
                        $sql .= " , ";
                    }
                    $sql .= "`" . str_replace(":", "", $key) . "`";
                    $x++;
                }

                $sql .= " )
                VALUES
             ( ";
                $x = 0;
                foreach ($array as $key => $value) {
                    if ($x > 0) {
                        $sql .= " , ";
                    }
                    $sql .= $key;
                    $x++;
                }
                $sql .= " )";

                break;

            case "update":
                $array2 = array();

                $sql = "UPDATE " . $table . "
                        SET ";
                $x = 0;
                foreach ($array['SET'] as $key => $value) {
                    if ($x > 0) {
                        $sql .= " , ";
                    }
                    $array2[$key] = $value;
                    $sql .= str_replace(":", "", $key) . " = " . $key;
                    $x++;
                }

                $sql .= " WHERE 1 ";
                $x = 0;
                foreach ($array['WHERE'] as $key => $value) {
                    $array2[$key] = $value;
                    $sql .= " AND " . str_replace(":", "", $key) . " = " . $key;
                    $x++;
                }
                $array = $array2;
                $fetch = false;
                break;

            default:
                $sql = $inSQL;
                $fetch = null;
        }

        return [
            'sql' => $sql,
            'array' => $array,
            'fetch' => $fetch,
        ];
    }


    /**
     * Creates an array from a recordset
     * @param recordset $rs
     * @return array
     */
    private static function RecordsetToArray($rs)
    {
        $rsArray = array();
        $rowCount = 0;
        while (odbc_fetch_row($rs)) {
            for ($j = 1; $j <= odbc_num_fields($rs); $j++) {
                $rsArray[$rowCount][odbc_field_name($rs, $j)] = odbc_result($rs, $j);
            }
            $rowCount++;
        }
//        smiArraySort($rsArray);
        return $rsArray;
    }


}