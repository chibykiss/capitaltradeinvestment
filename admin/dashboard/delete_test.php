<?php
 //print_r($_GET);
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->deletest();
ob_end_flush();
?>
