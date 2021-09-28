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
          <h1 id="name-product">Apple Watch S6 LTE 44mm</h1>
          <p class="text-muted lead " id="price-product">18.691.000 đ</p>
          <p class="text-small mb-4">Chiếc Apple Watch S6 LTE sở hữu dây đeo sáng bóng, chống gỉ sét tốt, màn hình tràn viền mang lại sự trải nghiệm sắc nét, rõ ràng. Phần thân máy có kết cấu chắc chắn, kính cường lực chống trầy xước tốt, không ngại những va chạm thông thường. Mặt đồng hồ với kích thước 1.78 inch giúp hiển thị thông tin rõ ràng hơn, đem lại cho bạn sự hài lòng khi đeo mẫu đồng hồ phiên bản 2020 này trên tay.</p>
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
                PHẨM:</strong><span class="reset-anchor ml-2" href="#">Đồng hồ thông minh</span></li>
            <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">CÒN LẠI:</strong><span class="ml-2 text-muted"><strong>93 Sản phẩm</strong></span></li>
            <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">TÌNH TRẠNG:</strong>
              <span class="reset-anchor ml-2" href="#">
                Còn hàng </span>
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