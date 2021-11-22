<?php
require('../database/connect.php');
require('../database/repository.php');
if (isset($_POST['action'])) {
    $id = $_POST['order_id'];
    $action = $_POST['action'];
    $msnv = $_POST['msnv'];
    if ($action == 'xuly') {
        $update_sql = "UPDATE dathang SET TrangThaiDH = 1, MSNV =" . (int) $msnv . " WHERE SoDonDH=" . $id;
        if (db_update($conn, $update_sql)) {
            echo 'Xử lý đơn hàng thành công';
        } else {
            echo 'Xử lý đơn hàng thất bại';
        }
    } else {
        $update_sql = "UPDATE dathang SET NgayGH = now() WHERE SoDonDH=" . $id;
        if (db_update($conn, $update_sql)) {
            echo 'Giao hàng thành công';
        } else {
            echo 'Giao hàng thất bại';
        }
    }
}
