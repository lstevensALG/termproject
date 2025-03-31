<?php
    $sqlDBCreate = "CREATE DATABASE IF NOT EXISTS user";

    $servername = "localhost";  	// Server name or IP address
    $username = "root";     		// MySQL username
    $password = "";     			// MySQL password

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    //create database
    mysqli_query($conn, $sqlDBCreate);
?>