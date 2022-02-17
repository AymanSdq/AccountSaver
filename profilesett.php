<?php
    include "templates/header.php";

    session_start();

    if(!isset($_SESSION["username_sess"])){
        header("Location: index.php?");
        exit();
    }else{
        
    }












?>