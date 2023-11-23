<?php
// List of Employees

//var_dump($data);
?>

<html>
    <head>
        <title>Employee List</title>
        <style>
            table{
                width:550px;
            }
            th:nth-child(1) {
                width: 30%;
            }
            </style>
    </head>
    <body>
        <table border=1>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <?php
                foreach($data as $row) {
                    echo "<tr><td>" . $row->clientNumber. "</td><td>" 
                        . $row->lastName. ", " . $row->firstName. "</td>";

                        echo "<td><a href='/?controller=client&action=view&id=".$row->clientNumber."'>View</a></td>";
                        echo "<td><a href='/?controller=client&action=update&id=".$row->clientNumber."'>Edit</a></td>";

                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>