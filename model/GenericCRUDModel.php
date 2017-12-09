<?php
namespace model;


ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

class GenericCRUDModel
{
    var $tableName;
    var $columnNames;

    public function __construct()
    {
        echo("GenericCRUDModel");
        $this->tableName = 'accounts';
        $this->columnNames = array("email", "fname", "lname", "phone", "birthday", "gender", "password");
        echo("1 test values for columnNames = " . $this->columnNames . "<br>");
    }

    public function save($id, $columnValues, $database)
    {
        //$database = dbConnection::getConnection();
        if ($id == '') {
            $sql = $this->insert($columnValues);
            $database->beginTransaction();
            $statement = $database->prepare($sql);
            echo("sql=" . $sql . "<br>");
            $statement->execute();
            $last_id = $database->lastInsertId();
            $database->commit();
            echo("last_id = " . $last_id . "<br>");
            return $last_id;
        } else {
            $database->beginTransaction();
            $sql = $this->updateAll($id, $columnValues);
            $statement = $database->prepare($sql);
            $database->exec($statement);
            //$statement->execute();
            $database->commit();
        }
    }

    public function insert($columnValues)
    {
        echo("columnName in insert = " . $this->columnNames[0] . "<br>");
        $insertSql = "INSERT INTO " . $this->tableName . " (";
        for ($index = 0; $index < sizeof($this->columnNames); $index = $index + 1) {
            $columnName = $this->columnNames[$index];
            if ($index == 0)
                $insertSql = $insertSql . $columnName;
            else
                $insertSql = $insertSql . "," . $columnName;
        }
        $insertSql = $insertSql . ") values (";
        for ($index = 0; $index < sizeof($columnValues); $index = $index + 1) {
            $columnValue = "'" . $columnValues[$index] . "'";
            if ($index == 0)
                $insertSql = $insertSql . $columnValue;
            else
                $insertSql = $insertSql . "," . $columnValue;
        }
        $insertSql = $insertSql . ")";
        echo("insertSql 4" . $insertSql . "<br>");
        return $insertSql;
    }

    public function updateAll($id, $columnValues)
    {
        echo("columnName in updateAll = " . $this->columnNames[0] . "<br>");
        $this->update($id, $this->columnNames, $columnValues);
    }

    public function update($id, $columnNames, $columnValues)
    {
        $updateSql = "Update " . $this->tableName . " set ";
        echo("update SQL1 = " . $updateSql);
        for ($index = 0; $index < sizeof($columnValues); $index = $index + 1) {
            echo("index = " . $index . "<br>");
            echo("columnName = " . $columnNames[$index] . "<br>");
            echo("columnValue = " . $columnValues[$index] . "<br>");
            if (!is_null($columnValues[$index]) && !empty($columnValues[$index])) {
                if ($index == 0) {
                    $updateSql = $updateSql . $columnNames[$index] . " = '" . $columnValues[$index] . "'";
                } else {
                    $updateSql = $updateSql . "," . $columnNames[$index] . " = '" . $columnValues[$index] . "'";
                }
            }
        }
        $updateSql = $updateSql . " where id = " . $id;
        echo("update SQL2 = " . $updateSql);
        //return $updateSql;
    }

    public function delete($id, $database)
    {
        //$database = dbConnection::getConnection();
        $sql = "DELETE FROM " . $this->tableName . " where id= " . $id;
        echo 'Record deleted successfully from accounts table.' . "<br>";
    }
}

?>
