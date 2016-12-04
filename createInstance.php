<?php

include 'handleDataBase.php';

$createDataBaseInstance = new handleDataBase('localhost', 'root', 'root', 'food', 'deserts');

$createDataBaseInstance->createDataBase();

$createDataBaseInstance->connectToDataBase();

$createDataBaseInstance->createDataBaseTable();

$createDataBaseInstance->postData();
