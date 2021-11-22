<?php
if (session_id() === '')
    session_start();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    $title = "Đặt hàng";
    include_once('components/import_header.php');

    ?>
</head>

<body>
    <?php include_once('components/header.php');  ?>
    <?php include_once('components/import_footer.php');  ?>
    <section class="mt-5 mb-4">
        <div class="container-fluid">
            <div class="row d-flex align-item-center justify-content-center">
                <div class="col-md-6">
                    <div class="pt-3 text-center">
                        <i class="bi bi-check-circle text-primary" style="font-size: 100px;"></i>
                        <h1 class=" font-weight-bold">ĐẶT HÀNG THÀNH CÔNG 🎉</h1>
                        <?php
                        if (isset($_SESSION['mskh'])) {
                            ?>
                            <p class="">Kiểm tra đơn hàng của bạn trong mục
                                <a href="order_history.php" class="font-weight-bold text-decoration-none">
                                    Đơn hàng của tôi
                                </a>

                            </p>
                        <?php } ?>
                    </div>

                    <div class="bg-white rounded p-3 mt-3 text-center">
                        <h5 class="font-weight-bold mb-2">Đơn hàng đang được xử lý</h5>
                        <p class="text-muted mb-5">Khi đơn hàng được xử lý xong, chúng tôi sẽ liên hệ đến bạn</p>
                        <a href="index.php" class="btn rounded medium-primary-btn btn-lg btn-block mt-3">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>