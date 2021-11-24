<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  if (session_id() === '')
    session_start();

  $title = "Chi tiết hàng hoá";
  require('../database/connect.php');
  require('../database/repository.php');
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



  if (isset($_POST['add_to_cart'])) {
    $id = $_POST["product_id"];
    $name = $_POST["product_name"];
    $quantity = (int) $_POST["quantity"];
    $price = $_POST["price"];
    $img = $_POST["image"];
    $category = $_POST["category"];
    $conlai = $_POST["conlai"];
    if ($quantity == '' || $quantity < 1 || $quantity > $conlai) {
      echo '
        <div class="row pb-3">
          <div class="col-12 text-center">
            <span class="text-danger" ><strong> Vui lòng chọn số lượng hợp lệ</strong></span>
          </div>
        </div> ';
    } else {

      //unset($_SESSION['cart']);
      if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['pd_quantity'] += $quantity;
      } else {
        $product = array(
          'pd_id' => $id,
          'pd_name' => $name,
          'pd_quantity' => $quantity,
          'pd_price' => $price,
          'pd_img' => $img,
          'pd_stored' => $conlai,
          'pd_category' => $category,
        );
        $_SESSION['cart'][$id] = $product;
      }
      // var_dump($_SESSION['cart']);
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }

  ?>
</head>

<body class="d-flex flex-column">
  <?php include_once('components/header.php');  ?>

  <div class="flex-grow-1 flex-shrink-0">
    <section>
      <input type="hidden" id="product_id" value="<?php echo $product_detail['MSHH']; ?>" />
      <div class="container mt-5">
        <div class="row mb-5">
          <!-- PRODUCT SLIDER-->
          <div class="col-lg-5 mb-5">
            <div class="row m-sm-0">
              <div class="col-sm-12 order-1 order-sm-2">
                <div class="owl-carousel product-slider owl-loaded owl-drag" data-slider-id="1">

                  <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 415px;">
                      <div class="owl-item active" style="width: 414.995px;">
                        <div id="carouselExampleIndicators" class="carousel slide d-block" data-ride="carousel">
                          <ol class="carousel-indicators" style="color: black;">
                            <?php
                            $image_query = "SELECT * FROM hinhhanghoa WHERE MSHH=" . $product_detail['MSHH'];
                            $images = getList($conn, $image_query);
                            for ($i = 0; $i < count($images); $i++) {
                              ?>
                              <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? "active" : ""; ?>"></li>
                            <?php } ?>
                          </ol>
                          <div class="carousel-inner">
                            <?php
                            for ($i = 0; $i < count($images); $i++) {
                              ?>
                              <div class="carousel-item <?php echo $i == 0 ? "active" : ""; ?>">
                                <img class="d-block w-100" src="<?php echo $host; ?>assets/images/products/<?php echo $images[$i]["TenHinh"]; ?>" alt="First slide" height="400">
                              </div>
                            <?php } ?>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i style="font-size: 30px; color: black;" class="bi bi-arrow-left-circle-fill"></i>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i style="font-size: 30px; color: black;" class="bi bi-arrow-right-circle-fill"></i>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- PRODUCT DETAILS-->
          <div class="col-lg-7">
            <h1 id="name-product"><?php echo $product_detail['TenHH']; ?></h1>
            <p class="text-muted lead " id="price-product"><?php echo number_format($product_detail['Gia']); ?> VNĐ</p>
            <p class="text-small mb-4"><?php echo $product_detail['QuyCach']; ?></p>
            <!-- Form add to cart-->
            <form action="" method="post">
              <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_detail['MSHH']; ?>" />
              <input type="hidden" id="product_name" name="product_name" value="<?php echo $product_detail['TenHH']; ?>" />
              <input type="hidden" id="category" name="category" value="<?php echo $product_detail['TenLoaiHang']; ?>" />
              <input type="hidden" id="conlai" name="conlai" value="<?php echo $product_detail['SoLuongHang']; ?>" />
              <input type="hidden" id="image" name="image" value="<?php echo $images[0]["TenHinh"]; ?>" />
              <input type="hidden" id="price" name="price" value="<?php echo $product_detail['Gia']; ?>" />
              <div class="row align-items-center mb-2 align-content-center">
                <div class="col-lg-3 col-md-3 col-sm-3 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                    <span class="small text-uppercase text-gray mr-2 no-select"><strong>Số lượng</strong></span>

                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 pr-sm-0 mr-3">
                  <div class="row w-100 justify-content-center">
                    <div class="input-group my-2">
                      <button type="button" class="btn btn-default border rounded-0 mb-2" onclick="document.getElementById('quantity').stepDown()">-</button>
                      <input class="form-control rounded-0 quantity-input" name="quantity" id="quantity" type="number" value="1" min="1" max="<?php echo $product_detail['SoLuongHang']; ?>" />
                      <button type="button" class="btn btn-default border rounded-0 mb-2" onclick="
                            document.getElementById('quantity').stepUp()">+</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-5 pl-sm-0">
                  <!-- <button name="add-to-cart" type="submit"
                  class=" btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                  id="add-cart-btn">Thêm vào giỏ hàng
                </button> -->
                  <button type="submit" id="add_to_cart" name="add_to_cart" class=" py-2 btn medium-secondary-btn active ">Thêm
                    vào giỏ hàng</button>
                </div>
              </div>
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
            <div class="col-md-6 col-sm-6 mb-3 mb-md-0 text-md-left">
              <a class="btn btn-link p-0 text-dark btn-sm" href="index.php">
                <i class="fas fa-long-arrow-alt-left mr-2"> </i>
                Tiếp tục mua sắm
              </a>
            </div>
            <div class="col-md-6 col-sm-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="cart.php">Đi đến
                giỏ hàng<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
          </div>
        </div>
      </div>
    </section>
  </div>



  <?php include_once('components/import_footer.php');  ?>
  <?php include_once('components/footer.php');  ?>

  <script>
    $(document).ready(function() {
      $("#add_to_cart").click(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "add_to_cart.php",
          data: {
            product_id: $("#product_id").val(),
            quantity: $("#quantity").val(),
            image: $("#image").val(),
            conlai: $("#conlai").val(),
            add_to_cart: "Click",
          },
          success: function(result) {
            if (result == "-1") {
              Snackbar.show({
                text: "Số lượng bạn đặt quá số lượng trong kho"
              });
              return;
            }
            if (result == "0") {
              Snackbar.show({
                text: "Mặt hàng này đã hết hàng"
              });
              return;
            }

            $("#cart-count").text(result);
            Snackbar.show({
              text: "Thêm vào giỏ hàng thành công"
            });


          },
          error: function(result) {
            Snackbar.show({
              text: 'Thêm vào giỏ hàng thất bại.'
            });
          }
        });
      });
    });
  </script>
</body>

</html>