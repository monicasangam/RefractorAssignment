<?php

namespace classes\model;


class accountCRUDModel
{
    public function __construct()
    {
        print '<br>Initialize Account CRUD model<br>';
        $this->tableName = 'accounts';
        $this->columnNames = array("email", "fname", "lname", "phone", "birthday", "gender", "password");
    }
}


?>