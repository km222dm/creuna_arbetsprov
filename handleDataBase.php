<?php

class handleDataBase {

    function __construct() {

        $this->hostname = 'localhost';
        $this->username = 'root';
        $this->password = 'root';
        $this->database = 'food';
        $this->table    = 'deserts';
        $this->desertName = 'desert_name';
        $this->connect = mysqli_connect($this->hostname, $this->username, $this->password);
    }


    function createDataBase() {

        $createDatabase = new mysqli($this->hostname, $this->username, $this->password);

        $sql = "CREATE DATABASE IF NOT EXISTS $this->database";

        $createDatabase->query($sql);


        if ($createDatabase->query($sql) === TRUE) {

            echo "<p>". "Database created successfully " . "</p>";

        } else {

          echo "<p>". "Error creating database: " . $createDatabase->error . "</p>";
         }
    }


    function connectToDataBase() {

        mysqli_select_db($this->connect, $this->database);

        if ($this->connect === false) {

            die("<p>" . "ERROR: Could not connect. " . mysqli_connect_error() . "</p>");
        }

    }


    function createDataBaseTable() {

        $sql = "CREATE TABLE IF NOT EXISTS $this->table(desert_name CHAR(100) PRIMARY KEY, desert_preamble CHAR(100), desert_type CHAR(100),
                desert_price FLOAT, desert_calories INT(100), desert_url CHAR(100), desert_date CHAR(30))";

        if (mysqli_query($this->connect, $sql)) {

            echo "<p>" . "Table created successfully" . "</p>";

        } else {

            echo "<p>" . "ERROR: 1 Not able to execute $sql. " . mysqli_error($this->connect) . "</p>";
        }
    }


    function postData() {

        if (isset($_POST['submitAsTable'])) {

            $desert_name = mysqli_real_escape_string($this->connect, $_POST['name']);

            $desert_preamble = mysqli_real_escape_string($this->connect, $_POST['preamble']);

            $desert_type = mysqli_real_escape_string($this->connect, $_POST['type']);

            $desert_price = mysqli_real_escape_string($this->connect, $_POST['price']);

            $desert_calories = mysqli_real_escape_string($this->connect, $_POST['calories']);

            $desert_url = mysqli_real_escape_string($this->connect, $_POST['url']);

            $desert_date = mysqli_real_escape_string($this->connect, $_POST["date"]);

            $sql_insert_deserts = "INSERT INTO $this->table (desert_name, desert_preamble, desert_type, desert_price, desert_calories, desert_url, desert_date)
            VALUES ('$desert_name', '$desert_preamble', '$desert_type', '$desert_price', '$desert_calories', '$desert_url', '$desert_date')";

            if (mysqli_query($this->connect, $sql_insert_deserts)) {

                echo "<p>" . "Records added successfully." . "</p>";

                echo "<p><a href=\"/frontpage.html\">" . "Go to start page" . "</a></p>";
                echo "<p><a href=\"/printAsTable.php\">" . "Print as Table" . "</a></p>";
                echo "<p><a href=\"/printAsXml.php\">" . "Print as XML" . "</a></p>";

            } else {

                echo "<p>" . "ERROR: Could not able to execute $sql_insert_deserts. " . mysqli_error($this->connect) . "</p>";
            }
        }
    }


    function getTables() {

        $sql_select_deserts = "SELECT * FROM $this->table";

        $connect = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        if($result = mysqli_query($connect, $sql_select_deserts));

        return $result;

    }


    function deleteTables() {

        $sql = "DELETE FROM $this->table WHERE desert_name =" . "'" . $_POST['delete'] . "'";

        $connect = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);

        $deleteQuery = mysqli_query($connect, $sql);

        return $deleteQuery;
    }

}

?>




