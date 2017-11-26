<?php

namespace classes\model;

use \PDO;

define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

class dbConnection
{
    public static $database;

    public function __construct()
    {
        print '<br>Database Found<br>';
        try
        {
            self::$database = new \PDO('mysql:host=' . CONNECTION . ';dbName=' . DATABASE, USERNAME, PASSWORD);
            self::$database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection error: ". $e->getMessage();
        }
    }

    public static function getConnection()
    {
        if(!self::$database)
        {
            new dbConnection();
        }
        self::$database->query("use ms792");

        return self::$database;
    }
}

?>