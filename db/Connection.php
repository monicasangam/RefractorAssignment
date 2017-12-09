<?php
namespace db;

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');
use \PDO;
class dbConnection
{
    protected static $database;
    private function __construct()
    {
        try
        {

            self::$database = new PDO('mysql:host=' . CONNECTION . ';dbName=' . DATABASE, USERNAME, PASSWORD);
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
}A
?>
