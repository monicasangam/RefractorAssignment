<?php
namespace collection;

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');
use \PDO;

class Map
{
    public $model;
    public function __construct($modelName)
    {
        $this->model = $modelName;
    }
    public function findAll($database)
    {
        //$database = dbConnection::getConnection();
        $sql = 'SELECT * FROM ' . $this->model->tableName;
        $statement = $database->prepare($sql);
        $statement->execute();
        //echo("model = ".get_class($this->model)."<br>");
        $statement->setFetchMode(PDO::FETCH_CLASS,get_class($this->model));
        $recordsSet = $statement->fetchAll();
        return $recordsSet;
    }
    public function findOne($id, $database)
    {
        //$database = dbConnection::getConnection();
        $sql = 'SELECT * FROM '. $this->model->tableName .' where id= '.$id;
        $statement = $database->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS,get_class($this->model));
        $recordSet = $statement->fetchAll();
        return $recordSet;
    }
}
?>
