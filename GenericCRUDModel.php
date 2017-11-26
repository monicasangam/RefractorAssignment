<?php

namespace classes\model;

require 'dbConnection.php';


class genericCRUDModel
{
    var $tableName;
    var $columnNames;
    protected $columnValues;
    var $id;

    public function __construct()
    {
        print '<br>Initialize Generic CRUD model<br>';
        $this->tableName = 'accounts';
        $this->columnNames = array ("email","fname","lname","phone","birthday","gender","password");
        $this->columnValues = array ("lisadong@njit.edu","Lisa","Dong","898-452-5242","05-APR-20","female","kitten123");
        print_r($this->columnNames);
        //echo("1 test values for columnNames = " . $this->columnNames."<br>");
    }
    public function save($id, $columnValues)
    {
        $this->id = $id;
        $database = dbConnection::getConnection();

        if($id=='')
        {
            $sql = $this->insert($columnValues);
            $database->beginTransaction();
            $statement = $database->prepare($sql);
            echo("sql=".$sql."<br>");
            $statement->execute();
            $last_id = $database->lastInsertId();
            $database->commit();
            echo("last_id = " .$last_id."<br>");
            return $last_id;
        }
        else
        {
            $database->beginTransaction();
            $sql = $this->updateAll($id,$columnValues);
            $statement = $database->prepare($sql);
            $database->exec($statement);
            //$statement->execute();
            $database->commit();

        }
    }
     function insert()
    {
        echo ("columnName in insert = ".$this->columnNames[0]. "<br>");
        $insertSql = "INSERT INTO ".$this->tableName." (";
        for($index=0 ; $index < sizeof($this->columnNames);$index=$index+1) {
            $columnName=$this->columnNames[$index];
            if($index==0)
                $insertSql = $insertSql . $columnName;
            else
                $insertSql = $insertSql . "," . $columnName;
        }
        $insertSql = $insertSql. ") values (";
        for($i=0 ; $i < sizeof($this->columnValues);$i=$i+1) {
            $columnValue = "'".$this->columnValues[$i]."'";
            if($i==0)
                $insertSql = $insertSql .  $columnValue;
            else
                $insertSql = $insertSql . "," . $columnValue;
        }
        $insertSql = $insertSql . ")";
        echo("insertSql 4".$insertSql."<br>");
        return $insertSql;
    }
     function updateAll($id, $columnValues)
    {
        echo ("columnName in updateAll = ".$this->columnNames[0]. "<br>");
        $this->update($this->id,$this->columnNames, $columnValues);
    }


    public function update($id, $columnNames, $columnValues)
    {
        $this->ColumnValues=$columnValues;
        $updateSql = "Update ".$this->tableName." set ";
        echo ("update SQL1 = ".$updateSql);

        for($index = 0; $index < sizeof($columnValues);$index=$index+1) {
            echo ("index = ".$index. "<br>");
            echo ("columnName = ".$columnNames[$index]. "<br>");
            echo ("columnValue = ".$columnValues[$index]. "<br>");
            if(!is_null($columnValues[$index]) && !empty($columnValues[$index])) {
                if ($index == 0) {
                    $updateSql = $updateSql . $columnNames[$index] . " = '" . $columnValues[$index] . "'";
                } else {
                    $updateSql = $updateSql . "," . $columnNames[$index] . " = '" . $columnValues[$index] . "'";
                }
            }
        }

        $updateSql = $updateSql . " where id = " . $id;

        echo ("update SQL2 = ".$updateSql);
        //return $updateSql;
    }
     function delete($id)
    {
        $database = dbConnection::getConnection();
        $sql = "DELETE FROM ".$this->tableName." where $this->id= ".$id;
        echo 'Record deleted successfully from accounts table.'."<br>";
    }
}

?>