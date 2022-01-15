<?php
ob_start();
session_start();
if ( !isset($_SESSION["admin_name"]) && !isset($_SESSION["admin_id"]) ) {
     header("location: ../");
 }
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->addadmin();
?>

