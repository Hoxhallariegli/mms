<?php
session_start();

session_destroy();
header("location: ../mms/login.php");
?>