<?php
$username = "root";
$password = "root";
$database = "food";
$hostname = "localhost";
$connect = mysqli_connect($hostname, $username, $password, $database);


if($connect === false){

    die("<p>" . "ERROR: Could not connect. " . mysqli_connect_error(). "</p>");

}

if(isset($_POST['delete'])){

    $sql = "DELETE FROM deserts WHERE desert_name =" . "'" . $_POST['delete'] . "'";


    if(mysqli_query($connect, $sql)){

        echo "<p>" . "Records were deleted successfully." . "</p>";

    } else{

        echo "<p>" . "ERROR: Could not able to execute $sql. " . mysqli_error($connect) . "</p>";

    }
}

?>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Table</title>

</head>

<body>


<?php

$sql_select_deserts = "SELECT * FROM deserts";

if($result = mysqli_query($connect, $sql_select_deserts)){

    if(mysqli_num_rows($result) > 0){

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

        while($row = mysqli_fetch_array($result)){

            echo "<tr>";

            echo "<td>" . $row['desert_date'] . "</td>";

            echo "<td>" . $row['desert_name'] . "</td>";

            echo "<td>" . $row['desert_preamble'] . "</td>";

            echo "<td>" . $row['desert_type'] . "</td>";

            echo "<td>" . abs($row['desert_price']) . "</td>";

            echo "<td>" . $row['desert_calories'] . "</td>";

            echo "<td>" . $row['desert_url'] . "</td>";

            echo "<td>" . '<form action="" method="post"><input type="hidden" name="delete" value="'. $row['desert_name'] .'"><input name="deleteButton" value="Delete row" type="submit"></form>' . "</td>";

            echo "</tr>";

        }

        echo "</table>";


        mysqli_free_result($result);



    } else{

        echo "<p>" . "No records matching your query were found.". "</p>";

    }

} else{

    echo "<p>" ."ERROR: Could not able to execute $sql_select_deserts. " . mysqli_error($connect). "</p>";

}


mysqli_close($connect);

?>


<p><a href="/index.php">Go to start page</a></p>
<p><a href="/printAsXml.php">Present as XML</a></p>

</body>
</html>