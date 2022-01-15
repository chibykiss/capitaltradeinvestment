<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->lockadmin383();
$classObj->deleteadmin();
?>
