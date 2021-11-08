<?php
if (session_id() === '')
  session_start();
require('connect.php');
require('repository.php');

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

  $title = "Giỏ hàng";
  include_once('components/import_header.php');

  ?>
</head>

<body>
  <?php include_once('components/header.php');  ?>
  <?php include_once('components/import_footer.php');  ?>
  <section class="mt-5 mb-4">
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-8">
          <div class="card wish-list mb-4">
            <div class="card-body">
              <h5 class="mb-4">Giỏ hàng (<span><?php echo $cart == null ? "0" : count($cart); ?></span> Sản phẩm)</h5>
              <!-- Sản phẩm -->
              <?php
              if ($cart == null) {
                ?>
                <div class="row mb-4">
                  <div class="col-md-12 d-flex justify-content-center">
                    Không có mặt hàng nào trong giỏ hàng của bạn
                  </div>
                </div>

                <?php
                } else {

                  foreach ($cart as $key => $item) {
                    $item_sql = "SELECT * FROM hanghoa h JOIN loaihanghoa l ON l.MaLoaiHang=h.MaLoaiHang WHERE MSHH=" . $item["pd_id"];
                    $product = getList($conn, $item_sql)[0];
                    $total_price += ($product["Gia"] * $item["pd_quantity"]);
                    ?>
                  <form action="add_to_cart.php" method="post">
                    <div class="row mb-4">

                      <input type="hidden" name="id" value="<?php echo $product["MSHH"]; ?>" />
                      <input type="hidden" name="conlai" value="<?php echo $product["SoLuongHang"]; ?>" />

                      <div class="col-md-5 col-lg-3 col-xl-3">
                        <a target="_blank" href="detail_product.php?id=<?php echo $product["MSHH"]; ?>">
                          <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                            <img style="cursor: pointer" class="img-fluid w-100" src="<?php echo $host; ?>assets/images/products/<?php echo $item["pd_img"]; ?>" alt="Sample">
                          </div>
                        </a>
                      </div>
                      <div class="col-md-7 col-lg-9 col-xl-9">
                        <div class="row justify-content-between">
                          <div class="col-lg-8">
                            <a target="_blank" href="detail_product.php?id=<?php echo $product["MSHH"]; ?>">
                              <h5 class="mb-3"><?php echo $product["TenHH"]; ?></h5>
                            </a>
                            <p class="mb-2 text-muted small"><strong>LOẠI: </strong> <?php echo $product["TenLoaiHang"]; ?></p>
                            <p class="mb-2 text-muted small"><strong>KHO: </strong> <?php echo $product["SoLuongHang"]; ?> sản phẩm</p>
                            <p class="mb-3 text-muted small"><strong>Tình trạng: </strong> <?php echo $product["SoLuongHang"] ? "Còn hàng" : "Hết hàng"; ?></p>
                          </div>
                          <div class="col-lg-4">
                            <div class="row w-100 justify-content-center">
                              <div class="input-group my-2">
                                <button type="button" class="btn btn-default border rounded-0 mb-2" onclick="document.getElementById('quantity_<?php echo $product["MSHH"]; ?>').stepDown()">-</button>
                                <input class="form-control rounded-0 quantity-input" type="number" id="quantity_<?php echo $product["MSHH"]; ?>" name="quantity" value="<?php echo $item["pd_quantity"]; ?>" min="1" max="<?php echo $product["SoLuongHang"]; ?>" />
                                <button type="button" class="btn btn-default border rounded-0 mb-2" onclick="
                            document.getElementById('quantity_<?php echo $product["MSHH"]; ?>').stepUp()">+</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <button type="submit" name="delete" class="btn small-third-btn mr-3">
                              <i class="bi bi-trash-fill"></i> Xoá khỏi giỏ hàng</button>
                          </div>
                          <div>
                            <button type="submit" name="update" class="btn small-primary-btn mr-3">
                              <i class="bi bi-stack"></i> Cập nhật </button>
                          </div>
                          <p class="mb-0"><span><strong><?php echo number_format($product["Gia"] * $item["pd_quantity"]); ?> VNĐ</strong></span></p>
                        </div>
                      </div>

                    </div>
                  </form>
                  <hr class="mb-4">



              <?php
                }
              }
              ?>
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
                  <span><?php echo number_format($total_price); ?> VNĐ</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Phí vận chuyển
                  <span>Miễn phí</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Tổng cộng</strong>
                  </div>
                  <span><strong><?php echo number_format($total_price); ?> VNĐ</strong></span>
                </li>
              </ul>

              <div class="row mt-2">
                <div class="col-lg-12">
                  <a href="<?php echo $host; ?>checkout.php">
                    <button type="button" class="btn medium-primary-btn btn-block">Đặt hàng</button>
                  </a>
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






</body>

</html>