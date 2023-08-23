<?php
include('configuration.php');
//connect to db

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//check connection
if (!$conn) {
    echo 'connection error:' . mysqli_connect_error();
}

?>