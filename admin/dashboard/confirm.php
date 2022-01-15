<?php
ob_start();
session_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->gig();
ob_end_flush();
?>
