<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h2>JustBFitness Database</h2>

<?php
 

    if (!empty($tablesData)) {
        foreach ($tablesData as $tableName => $tableData) {
            echo "<h3>$tableName</h3>";
            if (!empty($tableData)) {
                echo "<table border='1'>";
                // Display table headers
                echo "<tr>";
                foreach (array_keys($tableData[0]) as $column) {
                    echo "<th>$column</th>";
                }
                echo "</tr>";

                // Display table data
                foreach ($tableData as $row) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No data found in the '$tableName' table.</p>";
            }
        }
    } else {
        echo "<p>No tables found.</p>";
    }
?>

</body>
</html>
