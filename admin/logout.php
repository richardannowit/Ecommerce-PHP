<?php
if (session_id() === '')
    session_start();
unset($_SESSION['msnv']);
unset($_SESSION['tennv']);
header("location:login.php");
