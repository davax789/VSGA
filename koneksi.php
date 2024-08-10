<?php
    $servername = "localhost";
    $database = "tsa_web"; // Nama variabel yang benar
    $username = "root";
    $password = "";

    // Create Connection
    $connect = new mysqli($servername, $username, $password, $database);

    // Check Connection
    //if ($connect->connect_error) {
        //die("Connection failed: " . $connect->connect_error);
    //}
    //echo "Connection Successfully";
?>
