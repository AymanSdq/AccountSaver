<?php
    // Connect to Database
    $dbUser = "root";
    $dbPass = "";



    //Connection to Database

    $conn = new PDO('mysql:host=localhost;dbname=savedacc',$dbUser,$dbPass);

    if (!$conn){
        die("Database Connection Failed");
    }
