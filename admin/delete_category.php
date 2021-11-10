<?php
require('../database/connect.php');
require('../database/repository.php');
if (isset($_POST['delete'])) {
    $id = $_POST['category_id'];
    $delete_sql = "DELETE FROM loaihanghoa WHERE MaLoaiHang=" . $id;
    if (db_delete($conn, $delete_sql)) {
        echo '1';
    } else {
        echo '0';
    }
}
