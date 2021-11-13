<?php
require('../database/connect.php');
require('../database/repository.php');
if (isset($_POST['add'])) {
    $mskh = $_POST['mskh'];
    $diachi = $_POST['address'];
    $insert_sql = "INSERT INTO diachikh (MSKH, DiaChi) VALUES ('$mskh','$diachi')";
    if (db_insert($conn, $insert_sql)) {
        echo '1';
    } else {
        echo '0';
    }
}
