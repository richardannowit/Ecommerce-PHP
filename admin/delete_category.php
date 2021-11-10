<?php
require('../connect.php');
require('../repository.php');
if (isset($_POST['delete'])) {
    $id = $_POST['category_id'];
    echo $id;
    $delete_sql = "DELETE FROM loaihanghoa WHERE MaLoaiHang=" . $id;
    if (db_delete($conn, $delete_sql)) {
        echo '1';
    } else {
        echo '0';
    }
}
