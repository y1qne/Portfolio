<?php
session_start();
$_SESSION = array();
session_destroy();
session_start();
$_SESSION['loggedin'] = false;
header("Location: index.php");
