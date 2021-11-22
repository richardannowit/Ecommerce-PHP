<?php
require('../database/connect.php');
require('../database/repository.php');
if (isset($_POST['delete'])) {
    $id = $_POST['order_id'];
    $delete_sql = "DELETE FROM dathang WHERE SoDonDH=" . $id;
    $delete_detail_order_sql = "DELETE FROM chitietdathang WHERE SoDonDH=" . $id;
    db_delete($conn, $delete_detail_order_sql);
    if (db_delete($conn, $delete_sql)) {
        echo "Thanh cong";
    } else {
        echo "That bai";
    }
}
