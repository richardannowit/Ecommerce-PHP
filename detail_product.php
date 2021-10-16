<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  $title = "Trang chủ";
  require('connect.php');
  require('repository.php');
  include_once('components/import_header.php');

  $id = -1;
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  if ($id == -1) {
    header('Location: index.php');
  }

  $detail_query = "SELECT * FROM hanghoa JOIN loaihanghoa ON hanghoa.MaLoaiHang=loaihanghoa.MaLoaiHang WHERE hanghoa.MSHH=" . $id;
  $product_details = getList($conn, $detail_query);
  if (count($product_details) == 0) {
    header('Location: index.php');
  }

  $product_detail = $product_details[0];

  ?>
</head>

<body>
  <?php include_once('components/header.php');  ?>


  <section>
    <div class="container mt-5">
      <div class="row mb-5">
        <!-- PRODUCT SLIDER-->
        <div class="col-lg-5 mb-5">
          <div class="row m-sm-0">
            <div class="col-sm-12 order-1 order-sm-2">
              <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1">

                <div class="owl-stage-outer">
                  <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 415px;">
                    <div class="owl-item active" style="width: 414.995px;"><a class="d-block" href="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" data-lightbox="product" title="BIG NORON">
                        <img class="img-fluid" id="anhminhhoa" src="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" alt="anhsanpham"></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- PRODUCT DETAILS-->
        <div class="col-lg-7">
          <h1 id="name-product"><?php echo $product_detail['TenHH']; ?></h1>
          <p class="text-muted lead " id="price-product"><?php echo $product_detail['Gia']; ?></p>
          <p class="text-small mb-4"><?php echo $product_detail['QuyCach']; ?></p>
          <!-- Form add to cart-->
          <form action="" method="post">
            <div class="row align-items-center mb-2 align-content-center">
              <div class="col-lg-3 col-md-3 col-sm-3 pr-sm-0">
                <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                  <span class="small text-uppercase text-gray mr-2 no-select"><strong>Số lượng</strong></span>

                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 pr-sm-0 mr-3">
                <div class="row w-100 justify-content-center">
                  <div class="input-group my-2">
                    <button class="btn btn-default border rounded-0 mb-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                    <input class="form-control rounded-0 quantity-input" type="number" value="1" min="0" />
                    <button class="btn btn-default border rounded-0 mb-2" onclick="
                            this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-5 pl-sm-0">
                <!-- <button name="add-to-cart" type="submit"
                  class=" btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                  id="add-cart-btn">Thêm vào giỏ hàng
                </button> -->
                <button type="button" class=" py-2 btn medium-secondary-btn active ">Thêm
                  vào giỏ hàng</button>
              </div>
            </div>
            <input type="text" name="id" value="100000" hidden="">
            <input type="text" name="name" value="BIG NORON" hidden="">
            <input type="text" name="img" value="img/big-noron.jpg" hidden="">
            <input type="text" name="price" value="430000" hidden="">
            <input type="text" name="stored" value="93" hidden="">
          </form>
          <ul class="list-unstyled small d-inline-block">
            <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">LOẠI SẢN
                PHẨM:</strong><span class="reset-anchor ml-2" href="#"><?php echo $product_detail['TenLoaiHang']; ?></span></li>
            <li class="px-3 py-2 mb-1 bg-white">
              <strong class="text-uppercase">CÒN LẠI:</strong>
              <span class="ml-2 text-muted">
                <strong>
                  <?php echo $product_detail['SoLuongHang']; ?> sản phẩm
                </strong>
              </span>
            </li>
            <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">TÌNH TRẠNG:</strong>
              <span class="reset-anchor ml-2" href="#">
                <?php echo $product_detail['SoLuongHang'] > 0 ? "Còn hàng" : "Hết hàng"; ?>
              </span>
            </li>
          </ul>
        </div>

      </div>
      <div class="bg-light px-4 py-3">
        <div class="row align-items-center text-center">
          <div class="col-md-6 col-sm-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="<?php echo $host; ?>index.html"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua sắm</a></div>
          <div class="col-md-6 col-sm-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="<?php echo $host; ?>cart.php">Đi đến
              giỏ hàng<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
        </div>
      </div>
    </div>
  </section>





  <?php include_once('components/import_footer.php');  ?>
</body>

</html>