<?php
if (session_id() === '')
  session_start();
require('../database/connect.php');
require('../database/repository.php');

$cart = null;
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
}



$total_price = 0;

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


  <section class="mt-5 mb-4">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="row justify-content-around">
            <!-- Thông tin đặt hàng -->
            <div class="col-lg-5 mb-5">
              <div class="row mb-5">
                <div class="col-12">
                  <h4 class="text-uppercase mb-4">Thông tin giao hàng</h4>
                </div>
                <div class="col-lg-12 form-group">
                  <p class="">(*) Thông tin bắt buộc nhập</p>
                </div>
                <div class="col-lg-12">
                  <form action="" method="POST">
                    <div class="row">
                      <!-- Họ tên -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="name">Họ và tên (*)</label>
                        <input required class="form-control" id="name" name="name" type="text" placeholder="Nhập họ và tên" value="">
                      </div>
                    </div>
                    <div class="row">
                      <!-- Số điện thoại -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="phone">Số điện thoại (*)</label>
                        <input required class="form-control" pattern="[0-9]+" name="phone" id="phone" type="tel" placeholder="Nhập số điện thoại">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="address">Địa chỉ nhận hàng (*)</label>
                        <input required class="form-control" id="address" name="address" type="text" placeholder="số nhà, đường, xã/phường, quận/huyện, tỉnh/TP">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="company">Tên công ty (*)</label>
                        <input required class="form-control" id="company" name="company" type="text" placeholder="số nhà, đường, xã/phường, quận/huyện, tỉnh/TP">
                      </div>
                    </div>
                    <div class="row">
                      <!-- Số điện thoại -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="fax">Số FAX (*)</label>
                        <input required class="form-control " pattern="[0-9]+" name="fax" id="fax" type="tel" placeholder="Nhập số điện thoại">
                      </div>
                    </div>
                    <!-- Địa chỉ nhận hàng -->

                    <div class="row justify-content-between">
                      <div class="col-lg-4">
                        <a href="cart.php">
                          <button type="button" class="btn medium-secondary-btn btn-block">Quay lại</button>
                        </a>
                      </div>
                      <div class="col-lg-4">
                        <button type="submit" class="btn medium-primary-btn btn-block">Đặt hàng</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Thông tin đặt hàng -->



            <!-- Giỏ hàng  -->
            <div class="col-lg-5">
              <div class="card border-0 ">
                <div class="card-header card-2">
                  <p class="card-text text-muted mt-md-4 mb-2 space">
                    Giỏ hàng <span class=" small text-muted ml-2 cursor-pointer">(<?php echo count($cart); ?> sản phẩm)</span>
                  </p>
                  <hr class="my-2">
                </div>
                <div class="card-body pt-3">
                  <?php
                  foreach ($cart as $key => $item) {
                    $item_sql = "SELECT * FROM hanghoa h JOIN loaihanghoa l ON l.MaLoaiHang=h.MaLoaiHang WHERE MSHH=" . $item["pd_id"];
                    $product = getList($conn, $item_sql)[0];
                    $total_price += ($product["Gia"] * $item["pd_quantity"]);
                    ?>
                    <div class="row justify-content-between">
                      <div class="col-auto col-md-7">
                        <div class="media flex-column flex-sm-row">
                          <img class=" img-fluid mr-3" src="<?php echo $host; ?>assets/images/products/<?php echo $item["pd_img"]; ?>" width="62" height="62">
                          <div class="media-body my-auto">
                            <div class="row ">
                              <div class="col">
                                <p class="mb-0"><b><?php echo $product["TenHH"]; ?></b></p>
                                <small class="text-muted"><?php echo $product["TenLoaiHang"]; ?></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pl-0 flex-sm-col col-auto my-auto">
                        <p class="boxed"><?php echo $item["pd_quantity"]; ?></p>
                      </div>
                      <div class="pl-0 flex-sm-col col-auto my-auto">
                        <p><b><?php echo number_format($product["Gia"] * $item["pd_quantity"]); ?> VNĐ</b></p>
                      </div>
                    </div>
                    <hr class="my-2">
                  <?php } ?>
                  <div class="row ">
                    <div class="col">
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <p class="mb-1">Giá tạm tính</p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p class="mb-1"><?php echo number_format($total_price); ?> VNĐ</p>
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col">
                          <p class="mb-1">Phí vận chuyển</p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p class="mb-1">Miễn phí</p>
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <p><b>Tổng cộng</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p style="color: var(--primary-color)" class="mb-1"><b><?php echo number_format($total_price); ?> VNĐ</b></p>
                        </div>
                      </div>
                      <hr class="my-0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Giỏ hàng  -->




          </div>
        </div>

      </div>
    </div>
  </section>



  <?php include_once('components/import_footer.php');  ?>

</body>

</html>