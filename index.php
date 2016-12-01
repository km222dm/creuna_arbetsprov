<?php
$username = "root";
$password = "root";
$hostname = "localhost";
$database = "food";
$createDatabase = new mysqli($hostname, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS $database";


if ($createDatabase->query($sql) === TRUE) {

    echo "<p>". "Database created successfully" . "</p>";

} else {

    echo "<p>". "Error creating database: " . $createDatabase->error . "</p>";
}

$connect = mysqli_connect($hostname, $username, $password, $database);


if($connect === false) {

    die("<p>" . "ERROR: Could not connect. " . mysqli_connect_error(). "</p>");

}


$sql = "CREATE TABLE IF NOT EXISTS deserts(desert_name CHAR(100) PRIMARY KEY, desert_preamble CHAR(100), desert_type CHAR(100), desert_price FLOAT, desert_calories INT(100), desert_url CHAR(100), desert_date CHAR(30))";

if (mysqli_query($connect, $sql)){

    echo "<p>" . "Table desert created successfully" . "</p>";

} else {

    echo "<p>" . "ERROR: 1 Not able to execute $sql. " . mysqli_error($connect) . "</p>";

}

if(isset($_POST['submitAsTable'])) {

    $desert_name = mysqli_real_escape_string($connect, $_POST['name']);

    $desert_preamble = mysqli_real_escape_string($connect, $_POST['preamble']);

    $desert_type = mysqli_real_escape_string($connect, $_POST['type']);

    $desert_price = mysqli_real_escape_string($connect, $_POST['price']);

    $desert_calories = mysqli_real_escape_string($connect, $_POST['calories']);

    $desert_url = mysqli_real_escape_string($connect, $_POST['url']);

    $desert_date = mysqli_real_escape_string($connect, $_POST["date"]);

    $sql_insert_deserts = "INSERT INTO deserts (desert_name, desert_preamble, desert_type, desert_price, desert_calories, desert_url, desert_date)
            VALUES ('$desert_name', '$desert_preamble', '$desert_type', '$desert_price', '$desert_calories', '$desert_url', '$desert_date')";

    if(mysqli_query($connect, $sql_insert_deserts)){

        echo "<p>" . "Records added successfully." . "</p>";

    } else{

        echo "<p>" . "ERROR: Could not able to execute $sql_insert_deserts. " . mysqli_error($connect) . "</p>";
    }
}

mysqli_close($connect);

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Deserts</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        $( function() {
            $( "#datePicker" ).datepicker();
        } );
    </script>

</head>

<body>



<h1>Desert generator</h1>

<form action="index.php" method="post">
    Date:     <input type="text" name="date" id="datePicker"><br />
    Name:     <input type="text" name="name" /><br />
    Preamble: <input type="text" name="preamble" /><br />
    Type:     <input type="text" name="type" /><br />
    Price:    <input type="number" min="0" step="any" name="price" /><br />
    Calories: <input type="number" min="0" name="calories" /><br />
    Url:      <input type="url" name="url" /><br />

    <input type="submit" name="submitAsTable" value="Submit" />
</form>



<p><a href="/printAsTable.php">Present result as Table</a></p>
<p><a href="/printAsXml.php">Present result as XML</a></p>

</body>
</html>





