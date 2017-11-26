<?php


namespace classes\model;



class todoCRUDModel

{
    public function __construct()
    {
        print'<br>Initialize Todo CRUD model<br>';
        $this->tableName = 'todos';
        $this->columnNames = array ("ownerEmail","ownerId","createdDate","dueDate","message");
    }
}


?>