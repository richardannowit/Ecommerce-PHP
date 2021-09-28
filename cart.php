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
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-8">
          <div class="card wish-list mb-4">
            <div class="card-body">
              <h5 class="mb-4">Giỏ hàng (<span>2</span> Sản phẩm)</h5>
              <!-- Sản phẩm -->
              <div class="row mb-4">
                <div class="col-md-5 col-lg-3 col-xl-3">
                  <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                    <img class="img-fluid w-100" src="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" alt="Sample">
                  </div>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                  <div class="row justify-content-between">
                    <div class="col-lg-8">
                      <h5 class="mb-3">Apple Watch S6 LTE 44mm</h5>
                      <p class="mb-2 text-muted small"><strong>LOẠI: </strong> Đồng hồ thông minh</p>
                      <p class="mb-2 text-muted small"><strong>KHO: </strong> 93 sản phẩm</p>
                      <p class="mb-3 text-muted small"><strong>Tình trạng: </strong> Còn hàng</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="row w-100 justify-content-center">
                        <div class="input-group my-2">
                          <button class="btn btn-default border rounded-0 mb-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                          <input class="form-control rounded-0 quantity-input" type="number" value="1" min="0" />
                          <button class="btn btn-default border rounded-0 mb-2" onclick="
                            this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <a href="#!" type="button" class="card-link-secondary small text-uppercase mr-3">
                        <i class="bi bi-trash-fill"></i> Xoá khỏi giỏ hàng </a>
                    </div>
                    <p class="mb-0"><span><strong>18.691.000 đ</strong></span></p>
                  </div>
                </div>
              </div>
              <hr class="mb-4">
              <!-- Sản phẩm -->
            </div>
          </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body">

              <h5 class="mb-3">THANH TOÁN</h5>

              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Giá tạm tính
                  <span>18.691.000 đ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Phí vận chuyển
                  <span>Miễn phí</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Tổng cộng</strong>
                  </div>
                  <span><strong>18.691.000 đ</strong></span>
                </li>
              </ul>

              <div class="row mt-2">
                <div class="col-lg-12">
                  <button type="button" class="btn medium-primary-btn btn-block">Đặt hàng</button>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
    </div>
  </section>





  <?php include_once('components/import_footer.php');  ?>

</body>

</html>