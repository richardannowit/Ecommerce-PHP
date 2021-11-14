<?php
if (session_id() === '')
    session_start();
unset($_SESSION['sdt']);
unset($_SESSION['tenkh']);
unset($_SESSION['mskh']);
$redirect = "index.php";
if (isset($_GET['redirect'])) {
    $redirect = $_GET['redirect'];
}
header("location:" . $redirect);
