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

        include "model/ToDoCRUDModel.php";
        include "model/ToDoQueryModel.php";
        include "collection/Map.php";
        include "db/Connection.php";
        include "display/TableFormatter.php";

    //("ownerEmail","ownerId","createdDate","dueDate","message")
        echo '<h1>Insert into ToDo Table</h1>';
        $toDoCRUDModel = new model\ToDoCRUDModel();
        $toDoColumnValues = array("peter@njit.com", "1", "03-MAY-10", "03-MAY-10", "test1");
        $database = db\dbConnection::getConnection();
        $id1 = $toDoCRUDModel->save("", $toDoColumnValues, $database);
        print("id1 = " . $id1 . "<br>");
        $toDoColumnValues = array("carol@njit.com", "1", "03-MAY-10", "03-MAY-10", "test1");
        $id2 = $toDoCRUDModel->save("", $toDoColumnValues, $database);
        print("id2 = " . $id2 . "<br>");
        $toDoColumnValues = array("sam@njit.com", "1", "03-MAY-10", "03-MAY-10", "test1");
        $id3 = $toDoCRUDModel->save("", $toDoColumnValues, $database);
        print("id3 = " . $id3 . "<br>");
        $toDoColumnValues = array("sim@njit.com", "1", "03-MAY-10", "03-MAY-10", "test1");
        $id4 = $toDoCRUDModel->save("", $toDoColumnValues, $database);
        print("id4 = " . $id4 . "<br>");
        echo '<h1>Update record (all columns) in ToDo Table</h1>';
        $toDoColumnValues = array("peter1@njit.com", "Petery", "212-555-1111", "03-MAY-10", "Male", "abc123");
        $toDoCRUDModel->save(20, $toDoColumnValues, $database);
        echo '<h1>Update record (custom columns) in ToDo Table</h1>';
        $toDoColumnNames = array("ownerEmail", "ownerId", "createdDate", "dueDate", "message");
        $toDoColumnValues = array("sim@njit.com", "1", "03-MAY-10", "03-MAY-10", "test1");
        $toDoCRUDModel->update($id2, $toDoColumnNames, $toDoColumnValues, $database);
        echo '<h1>Delete record  in ToDo Table</h1>';
        $toDoCRUDModel->delete($id3);


        $toDoQueryModel = new model\ToDoQueryModel();
        $toDosMap = new collection\Map($toDoQueryModel);

        echo '<br>';
        $records = $toDosMap->findAll($database);
        echo '<h1>Select all the Records in Todos Table</h1>';
        $htmlTable = new display\HTMLTable();
        $htmlTable->format($records);
        echo '<br>';
        echo '<br>';
        $records = $toDosMap->findOne(1, $database);
        echo '<h1>Select One Record from Todos Table</h1>';
        echo '<h2>Select Record Id : 1</h2>';
        $htmlTable->format($records);
        echo '<br>';
        echo '<br>';
}
?>
