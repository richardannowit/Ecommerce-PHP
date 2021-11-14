<?php
if (session_id() === '')
    session_start();
require('../database/connect.php');
require('../database/repository.php');

$cart = null;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

if (count($cart) == 0) {
    header('location:order_fail.php');
}

$mskh = "";
$address_id = "";
if (isset($_SESSION['mskh'])) {
    $mskh = $_SESSION['mskh'];

    if (isset($_POST['address'])) {
        $address_id = $_POST['address'];
    }
} else {
    $name = "";
    $phone = "";
    $email = "";
    $address = "";
    $company = "";
    $fax = "";

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['company'])) {
        $company = $_POST['company'];
    }
    if (isset($_POST['fax'])) {
        $fax = $_POST['fax'];
    }

    $addUser_sql = "INSERT INTO khachhang (HoTenKH,TenCongTy,SoDienThoai,Email,fax) VALUES ('$name','$company','$phone','$email','$fax')";
    $mskh = db_insert($conn, $addUser_sql);
    if (!$mskh) {
        header('location:order_fail.php');
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        $add_address_sql = "INSERT INTO diachikh (MSKH, DiaChi) VALUES ('$mskh','$address')";
        $address_id = db_insert($conn, $add_address_sql);
    }
}


if (!$mskh && !$address_id) {
    header('location:order_fail.php');
}


/* Tien hanh dat hang */

// Tao don hang
$order_sql = "INSERT INTO dathang (MSKH,NgayDH,TrangThaiDH,MaDC) VALUES ('$mskh',now(),0,'$address_id')";
$order_id = db_insert($conn, $order_sql);

if (!$order_id) {
    header('location:order_fail.php');
}

foreach ($cart as $key => $item) {
    $item_sql = "SELECT * FROM hanghoa h  WHERE MSHH=" . $item["pd_id"];
    $product = getList($conn, $item_sql)[0];
    $quantity = $item["pd_quantity"];
    $mshh = $product["MSHH"];
    $price = $product["Gia"];

    $order_item_sql = "INSERT INTO chitietdathang (SoDonDH,MSHH,SoLuong,GiaDatHang) VALUES ('$order_id','$mshh','$quantity','$price')";
    $success = db_insert($conn, $order_item_sql);
}



unset($_SESSION['cart']);
header('location:order_successful.php');
