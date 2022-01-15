<?php
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
//$classObj->blockeded();
$classObj->sendmess();

ob_end_flush();
?>
