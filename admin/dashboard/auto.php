<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
//$classObj->blockk();
$classObj->auto();
ob_end_flush();
?>
