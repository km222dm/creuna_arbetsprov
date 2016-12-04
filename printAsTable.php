<?php
include 'handleDataBase.php';


class printAsTable {

    function deleteTableRow() {

        $deleteInstance = new handleDataBase();

        if ($deleteInstance->connectToDataBase() === false) {

            die("<p>" . "ERROR: Could not connect. " . mysqli_connect_error() . "</p>");
        }


        if (isset($_POST['delete'])) {

            if ($deleteInstance->deleteTables()) {

                echo "<p>" . "Records were deleted successfully." . "</p>";

            } else {

                echo "<p>" . "ERROR: Could not able to execute delete. " . "</p>";

            }
        }
    }


    function printTable() {

        if (isset($_POST['delete'])) {

            $this->deleteTableRow();
        }

        $createDataBaseInstance = new handleDataBase();

        $result = $createDataBaseInstance->getTables();

        if (mysqli_num_rows($result) > 0) {

            echo "<table>";

            echo "<tr>";

            echo "<th>Date</th>";

            echo "<th>Name</th>";

            echo "<th>Preamle</th>";

            echo "<th>Type</th>";

            echo "<th>Price</th>";

            echo "<th>Calories</th>";

            echo "<th>Url</th>";

            echo "<th>Select</th>";

            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {

                echo "<tr>";

                echo "<td>" . $row['desert_date'] . "</td>";

                echo "<td>" . $row['desert_name'] . "</td>";

                echo "<td>" . $row['desert_preamble'] . "</td>";

                echo "<td>" . $row['desert_type'] . "</td>";

                echo "<td>" . abs($row['desert_price']) . "</td>";

                echo "<td>" . $row['desert_calories'] . "</td>";

                echo "<td>" . $row['desert_url'] . "</td>";

                echo "<td>" . '<form action="" method="post"><input type="hidden" name="delete" value="' . $row['desert_name'] . '"><input name="deleteButton" value="Delete row" type="submit"></form>' . "</td>";

                echo "</tr>";

            }

            echo "</table>";

            mysqli_free_result($result);


        } else {

            echo "<p>" . "No records matching your query were found." . "</p>";
        }
    }
}

$printAsTableInstance = new printAsTable();

$printAsTableInstance->printTable();

?>

<p><a href="/frontpage.html">Go to start page</a></p>
<p><a href="/printAsXml.php">Present as XML</a></p>
