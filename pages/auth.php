<?php
session_start();
if((!isset($_SESSION["adname"]))&&(!isset($_SESSION["ademail"]))&&(!isset($_SESSION["adpass"])) ){
    header("Location: ./login.php");
    exit(); }
?>