<?php
namespace {
    function __autoload($class_name)
    {
        //class directories
        $directorys = array(
            'classes/'
        );
        //for each directory
        foreach ($directorys as $directory) {
            //see if the file exsists
            if (file_exists($directory . $class_name . '.php')) {
                require_once($directory . $class_name . '.php');
                //only require the class once, so quit after to save effort (if you got more, then name them something else
                return;
            }
        }
    }
    include "model/AccountCRUDModel.php";
    include "model/AccountQueryModel.php";
    include "collection/Map.php";
    include "db/Connection.php";
    include "display/TableFormatter.php";

    echo '<h1>Insert into Accounts Table</h1>';
    $accountCRUDModel = new model\AccountCRUDModel();
    $account1ColumnValues = array ("peter@njit.com","Peterxx","Smith","212-555-1212","03-MAY-10","Male","abc123");
    $database = db\dbConnection::getConnection();
    $id1 = $accountCRUDModel->save("", $account1ColumnValues, $database);
    print("id1 = ".$id1."<br>");
    $account1ColumnValues = array ("sam@njit.com","Sam","Jung","609-555-1212","03-APR-12","Male","pqr345");
    $id2 = $accountCRUDModel->save("",$account1ColumnValues, $database);
    print("id2 = ".$id2."<br>");
    $account1ColumnValues = array ("carol@njit.com","Carol","Barley","212-555-1212","03-DEC-11","Female","aaa123");
    $id3 = $accountCRUDModel->save("",$account1ColumnValues, $database);
    print("id3 = ".$id3."<br>");
    $account1ColumnValues = array ("param@njit.com","Param","Singh","212-555-3333","03-JAN-10","Male","aaabb123");
    $id4 = $accountCRUDModel->save("",$account1ColumnValues, $database);
    print("id4 = ".$id4."<br>");
    echo '<h1>Update record (all columns) in Accounts Table</h1>';
    $account1ColumnValues = array ("peter1@njit.com","Petery","Smith1","212-555-1111","03-MAY-10","Male","abc123");
    $accountCRUDModel->save(20, $account1ColumnValues, $database);
    echo '<h1>Update record (custom columns) in Accounts Table</h1>';
    $account1ColumnNames = array ("email","fname","lname","phone");
    $account1ColumnValues = array ("sam1@njit.com","Sam1","Jung1","212-555-2222");
    $accountCRUDModel->update($id2, $account1ColumnNames, $account1ColumnValues, $database);
    echo '<h1>Delete record  in Accounts Table</h1>';
    $accountCRUDModel->delete($id3);


    $accountQueryModel = new model\AccountQueryModel();
    $accountsMap = new collection\Map($accountQueryModel);

    $records = $accountsMap->findAll($database);
    echo '<h1>Select all the Records in Accounts Table</h1>';
    $htmlTable = new display\HTMLTable();
    $htmlTable->format($records);
    echo '<br>';
    echo '<br>';
    $records = $accountsMap->findOne(20, $database);
    echo '<h1>Select One Record from Accounts Table</h1>';
    echo '<h2>Select Record Id : 1</h2>';
    $htmlTable->format($records);
    echo '<br>';

}
?>
