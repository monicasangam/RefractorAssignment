<?php
namespace collection;

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

include "collection/Map.php";

class ToDosMap extends Map
{
    public function __construct($modelName)
    {
        $model = 'todos';
    }
}

?>
