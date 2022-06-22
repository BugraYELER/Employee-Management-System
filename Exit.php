<?php
require_once("Login.php");
session_start();
session_unset();
session_destroy();
go("Login.php");

?>