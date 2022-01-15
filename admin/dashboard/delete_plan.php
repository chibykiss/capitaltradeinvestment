<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->block_plan();
$classObj->deleteplan();
ob_end_flush();
?>