<?php
include("connection.php");
$_SESSION = array();
session_destroy();
header("Location: Start.html");
?>