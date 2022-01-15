<?php
ob_start();
session_start();
if ( !isset($_SESSION["un"]) && !isset($_SESSION["hash"]) && !isset($_SESSION["id"]) ) {
	header("location: ../");
}
if (!isset($_GET["amount"])) {
	header("location: index.php");
}
require("../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->funding();
ob_end_flush();

?>