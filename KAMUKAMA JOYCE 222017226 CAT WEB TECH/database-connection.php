<?php
    // Connection details
    $hostname = "localhost";
    $user = "Kamukama";
    $pass = "Kamukama$08";
    $database = "payment_billing_product";


    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>