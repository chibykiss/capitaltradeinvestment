<?php
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->debitit();
// $classObj->blockk();
ob_end_flush()
?>

