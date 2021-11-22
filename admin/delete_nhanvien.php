<?php
require('../database/connect.php');
require('../database/repository.php');
if (isset($_POST['delete'])) {
    $id = $_POST['nhanvien_id'];
    $delete_sql = "DELETE FROM nhanvien WHERE MSNV=" . $id;
    if (db_delete($conn, $delete_sql)) {
        echo '1';
    } else {
        echo '0';
    }
}
