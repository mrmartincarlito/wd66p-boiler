<?php
include "env.php";
include "dbhelper/MysqliDb.php";
include "dbhelper/dbObject.php";

session_start();

/**
 * Connection string
 */

 $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 $database = new MysqliDb($connection);
 dbObject::autoload("models");

 if ($connection->connect_errno) {
    echo "<h3>Cannot connect to database please contact your administrator</h3>";
    return;
 }