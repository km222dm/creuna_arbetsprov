<?php
include 'desertXml.php';

class printAsXmlClass {

    function printXml() {

        $username = "root";
        $password = "root";
        $database = "food";
        $hostname = "localhost";
        $connect = mysqli_connect($hostname, $username, $password, $database);

        if($connect === false){

            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        global $xmlString;

        $food = new SimpleXMLElement($xmlString);


        $sql_select_deserts = "SELECT * FROM deserts";

        if($result = mysqli_query($connect, $sql_select_deserts)) {

            if(mysqli_num_rows($result) > 0) {

                while($row = mysqli_fetch_array($result)) {

                    $desert = $food->addChild('desert');
                    $desert->addChild('date', $row['desert_date']);
                    $desert->addChild('name', $row['desert_name']);
                    $desert->addChild('preamble', $row['desert_preamble']);
                    $desert->addChild('type', $row['desert_type']);
                    $desert->addChild('price', $row['desert_price']);
                    $desert->addChild('calories', $row['desert_calories']);
                    $desert->addChild('url', $row['desert_url']);
                }

                mysqli_free_result($result);

            } else{

                echo "<p>" ."No records matching your query were found." . "</p>";
            }

        } else{

            echo "<p>" ."ERROR: Could not able to execute $sql_select_deserts. " . mysqli_error($connect). "</p>";
        }

        echo $food->asXML();

    }
}

$printAsXmlInstance = new printAsXmlClass();

$printAsXmlInstance->printXml();

?>