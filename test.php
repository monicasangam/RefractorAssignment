<?php

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

use classes\model\AccountCRUDModel;
use classes\model\TodoCRUDModel;
use classes\model\GenericCRUDModel;
//use classes\dbConnection;

require 'classes/model/AccountCRUDModel.php';
require 'classes/model/TodoCRUDModel.php';
require 'classes/model/GenericCRUDModel.php';
//require 'classes/dbConnection.php';

$genericCRUDModel = new genericCRUDModel();


// Accounts table implementation
$accountCRUDModel = new accountCRUDModel();

$columnNames = array ("email","fname","lname","phone","birthday","gender","password");
$columnValues= array ("lisadong.edu","Lisa","Dong","898-452-5242","05-APR-20","female","kitten123");

$genericCRUDModel->insert();
$genericCRUDModel->save(50,$columnValues);



$columnNames = array ("email","fname","lname","phone","birthday","gender","password");
$columnValues= array ("patricia@njit.edu","Lisa","Dong","898-452-5242","05-APR-20","female","kitten123");

$genericCRUDModel->update($id,$columnNames,$columnValues);

$genericCRUDModel->delete();


//Todo table implementation

$todoCRUDModel = new todoCRUDModel();

$toDoColumnNames = array ("ownerEmail","ownerId","createdDate","dueDate","message");
$toDoColumnValues = array ("patricia@njit.com","5","09-MAY-19","10-MAY-19","practice123");
$genericCRUDModel->insert();
$id1 = $genericCRUDModel->save(4, $toDoColumnValues);
print("id1 = ".$id1."<br>");


$toDoColumnNames = array ("ownerEmail","ownerId","createdDate","dueDate","message");
$toDoColumnValues = array ("foo@njit.com","3","07-SEP-22","04-JUN-09","practice2");
$genericCRUDModel->update(6, $toDoColumnNames, $toDoColumnValues);
print "<br>";
$genericCRUDModel->delete(6);
?>
