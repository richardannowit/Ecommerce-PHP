<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  $title = "Trang chủ";
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
                  <form action="" method="GET">
                    <div class="row">
                      <!-- Họ tên -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="name">Họ và tên (*)</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Nhập họ và tên"
                          value="" onblur="CheckName()">
                      </div>
                      <div class="col-lg-12 form-group">
                        <span class="text-danger" id="mess_name">Vui lòng nhập thông tin</span>
                      </div>
                    </div>
                    <div class="row">
                      <!-- Số điện thoại -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="phone">Số điện thoại (*)</label>
                        <input class="form-control" name="phone" id="phone" type="tel" placeholder="Nhập số điện thoại"
                          value="" onblur="CheckPhone()">
                      </div>
                      <div class="col-lg-12 form-group">
                        <span class="text-danger" id="mess_phone">Vui lòng nhập số điện thoại</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="address">Địa chỉ nhận hàng (*)</label>
                        <input class="form-control" id="address" name="address" type="text"
                          placeholder="số nhà, đường, xã/phường, quận/huyện, tỉnh/TP" onblur="CheckAddress()">
                      </div>
                      <div class="col-lg-12 form-group">
                        <span class="text-danger" id="mess_address">Vui lòng nhập thông tin</span>
                      </div>
                    </div>
                    <div class="row">
                      <!-- Email -->
                      <div class="col-lg-12 form-group">
                        <label class="text-small " for="email">Email address </label>
                        <input class="form-control" name="email" type="email" placeholder="Nhập địa chỉ email" value="">
                      </div>
                    </div>
                    <!-- Địa chỉ nhận hàng -->

                    <div class="row">
                      <div class="col-lg-12 form-group">
                        <span class="text-danger" id="messenger_all">Vui lòng nhập thông tin hợp lệ</span>
                      </div>
                    </div>
                    <div class="row justify-content-between">
                      <div class="col-lg-4">
                        <a href="<?php echo $host; ?>checkout.php">
                          <button type="button" class="btn medium-secondary-btn btn-block">Quay lại</button>
                        </a>
                      </div>
                      <div class="col-lg-4">
                        <a href="<?php echo $host; ?>checkout.php">
                          <button type="button" class="btn medium-primary-btn btn-block">Đặt hàng</button>
                        </a>
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
                  <p class="card-text text-muted mt-md-4 mb-2 space">Giỏ hàng <span
                      class=" small text-muted ml-2 cursor-pointer">(2 sản phẩm)</span> </p>
                  <hr class="my-2">
                </div>
                <div class="card-body pt-3">

                  <div class="row justify-content-between">
                    <div class="col-auto col-md-7">
                      <div class="media flex-column flex-sm-row"> <img class=" img-fluid mr-3"
                          src="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" width="62" height="62">
                        <div class="media-body my-auto">
                          <div class="row ">
                            <div class="col">
                              <p class="mb-0"><b>Apple Watch S6 LTE 44mm</b></p><small class="text-muted">Đồng hồ thông
                                minh</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="pl-0 flex-sm-col col-auto my-auto">
                      <p class="boxed">3</p>
                    </div>
                    <div class="pl-0 flex-sm-col col-auto my-auto">
                      <p><b>18.691.000 VNĐ</b></p>
                    </div>
                  </div>
                  <hr class="my-2">
                  <div class="row justify-content-between">
                    <div class="col-auto col-md-7">
                      <div class="media flex-column flex-sm-row"> <img class=" img-fluid mr-3"
                          src="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" width="62" height="62">
                        <div class="media-body my-auto">
                          <div class="row ">
                            <div class="col">
                              <p class="mb-0"><b>Apple Watch S6 LTE 44mm</b></p><small class="text-muted">Đồng hồ thông
                                minh</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="pl-0 flex-sm-col col-auto my-auto">
                      <p class="boxed">3</p>
                    </div>
                    <div class="pl-0 flex-sm-col col-auto my-auto">
                      <p><b>18.691.000 VNĐ</b></p>
                    </div>
                  </div>
                  <hr class="my-2">
                  <div class="row ">
                    <div class="col">
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <p class="mb-1">Giá tạm tính</p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p class="mb-1">18.691.000 VNĐ</p>
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
                          <p style="color: var(--primary-color)" class="mb-1"><b>18.691.000 VNĐ</b></p>
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