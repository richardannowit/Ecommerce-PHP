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
                        <i class="bi bi-x-circle text-danger" style="font-size: 100px;"></i>
                        <h1 class=" font-weight-bold">ĐẶT HÀNG THẤT BẠI 😥</h1>
                    </div>

                    <div class="bg-white rounded p-3 mt-3 text-center">
                        <h5 class="font-weight-bold mb-2">Có lỗi trong việc đặt hàng</h5>
                        <p class="text-muted mb-5">Vui lòng kiểm tra lại giỏ hàng và thông tin đặt hàng của bạn</p>
                        <a href="checkout.php" class="btn rounded medium-primary-btn btn-lg btn-block mt-3" style="background-color: var(--active-color) !important; color: white !important;">
                            Xem lại thông tin đặt hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>