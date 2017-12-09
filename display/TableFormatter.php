<?php

namespace display;

ini_set('display_errors', on);
error_reporting(E_ALL);
define('DATABASE','ms792' );
define('USERNAME', 'ms792');
define('PASSWORD', 'bSzrOJUh');
define('CONNECTION', 'sql1.njit.edu');

class HTMLTable
{
    public function format($data)
    {
        echo '<table>';
        foreach ($data as $rowData)
        {
            //echo($rowData);
            echo "<tr>";
            foreach ($rowData as $key=>$value) {
               echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

?>
