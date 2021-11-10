<?php
require('../connect.php');
require('../repository.php');
if (isset($_POST['delete'])) {
    $id = $_POST['product_id'];
    $delete_sql = "DELETE FROM hanghoa WHERE MSHH=" . $id;
    $delete_img_sql = "DELETE FROM hinhhanghoa WHERE MSHH=" . $id;
    db_delete($conn, $delete_img_sql);
    if (db_delete($conn, $delete_sql)) {
        echo "Thanh cong";
    } else {
        echo "That bai";
    }
}
