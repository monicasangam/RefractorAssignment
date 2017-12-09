<?php
namespace model;

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

include "model/GenericQueryModel.php";

class AccountQueryModel extends GenericQueryModel
{
    public $id;
    public $ownerEmail;
    public $ownerId;
    public $createdDate;
    public $dueDate;
    public $message;
    public function __construct()
    {
        $this->tableName = 'todos';
    }
}

?>
