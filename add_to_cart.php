<?php
if (session_id() === '')
    session_start();
if (isset($_POST['add_to_cart'])) {
    $id = $_POST["product_id"];
    $quantity = (int) $_POST["quantity"];
    $img = $_POST["image"];
    $conlai = $_POST["conlai"];
    if ($quantity == '' || $quantity < 1 || $quantity > $conlai) {
        echo '0';
        // echo 'Mặt hàng này đã hết hàng';
    } else {

        //unset($_SESSION['cart']);
        if (isset($_SESSION['cart'][$id])) {
            $actual_quantity = $_SESSION['cart'][$id]['pd_quantity'] + $quantity;
            if ($actual_quantity > $conlai) {
                // echo "Số lượng bạn đặt quá số lượng trong kho";
                echo "-1";
            } else {
                $_SESSION['cart'][$id]['pd_quantity'] += $quantity;
                echo count($_SESSION['cart']);
            }
        } else {
            $product = array(
                'pd_id' => $id,
                'pd_quantity' => $quantity,
                'pd_img' => $img,
            );
            $_SESSION['cart'][$id] = $product;
            echo count($_SESSION['cart']);
        }
    }
}


if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    unset($_SESSION['cart'][$id]);
    header('Location: cart.php');
}
if (isset($_POST["update"])) {
    $quantity = (int) $_POST["quantity"];
    $id = $_POST["id"];
    $conlai = $_POST["conlai"];
    if ($quantity <= 0 || $quantity == '') {
        $_SESSION['cart'][$id]['pd_quantity'] = 1;
    } else {
        if ($quantity > $conlai) {
            $_SESSION['cart'][$id]['pd_quantity'] = $quantity;
            echo '<div class="row align-items-center pb-5">
            <div class="col-md-12 col-sm-12 text-md-right">
              <span class="text-danger" > Số lượng hàng' . $name . 'hiện có là' . $conlai . ' </span>
            </div>
          </div>';
        } else {
            $_SESSION['cart'][$id]['pd_quantity'] = $quantity;
        }
    }
    header('Location: cart.php');
}
