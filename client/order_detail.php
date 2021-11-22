<?php

if (session_id() === '')
  session_start();
if (!isset($_SESSION['mskh'])) {
  header('location:index.php');
  exit;
}
$mskh = $_SESSION['mskh'];
if (!isset($_GET['id'])) {
  header('location:order_history.php');
  exit;
}
require('../database/connect.php');
require('../database/repository.php');

$order_id = $_GET['id'];
$total_price = 0;

$order_sql = "SELECT * FROM dathang WHERE SoDonDH=" . $order_id . " AND MSKH=" . $mskh;
$orders = getList($conn, $order_sql);

if (count($orders) == 0) {
  header('location:order_history.php');
  exit;
}
$order_detail = $orders[0];
$ngaydat = date_create($order_detail["NgayDH"]);
// $ngaydat = date_format($ngaydat, 'd/m/Y | H:i:s');


$ngaygiao = "";
if ($order_detail['NgayGH'] != null) {
  $ngaygiao_tmp = date_create($order_detail["NgayGH"]);
  $ngaygiao = date_format($ngaygiao_tmp, 'd/m/Y | H:i:s');
}

$product_sql = "SELECT * FROM chitietdathang c JOIN hanghoa h ON c.MSHH=h.MSHH WHERE SoDonDH=" . $order_id;
$products = getList($conn, $product_sql);

?>
<!DOCTYPE html>
<html lang="en">

<?php

$title = "Chi tiết đơn hàng";
include_once('components/import_header.php');

?>

<body>
  <?php include_once('components/header.php');  ?>
  <div class="container pt-2 mt-5">

    <!-- Thông tin đơn hàng  -->
    <div class="row mb-4">
      <div class="col-lg-8 col-md-12">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
          <div class="card-body">
            <h5 class="text-uppercase mb-4"><strong>Đơn hàng </strong> #<?php echo $order_detail['SoDonDH']; ?></h5>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4">
                <strong class="text-uppercase small font-weight-bold">Ngày đặt hàng</strong>
                <span class="total-cart"><?php echo date_format($ngaydat, 'd/m/Y | H:i:s'); ?></span>
              </li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between mb-4">
                <strong class="text-uppercase small font-weight-bold">Ngày giao hàng</strong>
                <span class="total-cart"><?php echo $ngaygiao == "" ? 'Chưa giao hàng' : $ngaygiao; ?></span>
              </li>
              <li class="border-bottom my-2"></li>
              <li class="d-flex align-items-center justify-content-between">
                <strong class="text-uppercase small font-weight-bold">Tình trạng</strong>
                <span class="total-cart"><?php echo $order_detail['TrangThaiDH'] == 0 ? 'Chưa xử lý' : ($order_detail['NgayGH'] == null ? "Đã xử lý" : "Đã giao"); ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Thông tin đơn hàng  -->



    <!-- Danh sách hàng hoá  -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card border-0 ">
          <div class="card-header card-2">
            <div class="row justify-content-between">

              <div class="col-lg-8 ">
                <div class="d-flex justify-content-between ">
                  <h5 class="card-title d-flex align-items-center mb-2 mt-2"><b>Danh sách hàng hoá</b></h5>
                </div>
              </div>
              <!-- <div class="col-lg-4 d-flex align-items-end justify-content-end ">
                <a href="cart.php" class="float-right">
                  <button type="button" class="btn btn-primary ">Chỉnh sửa</button>
                </a>
              </div> -->
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="table-responsive">
              <table class="table">
                <thead class="bg-light">
                  <tr>
                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Mã sản phẩm</strong></th>
                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Sản phẩm</strong></th>
                    <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Giá mua</strong></th>
                    <th class="border-0 text-right" scope="col"> <strong class="text-small text-uppercase ">Số lượng</strong></th>
                    <th class="border-0 text-right" scope="col"> <strong class="text-small text-uppercase">Thành tiền</strong></th>
                  </tr>
                </thead>
                <tbody class="list-cart">
                  <?php
                  foreach ($products as $product) {
                    $total_price_item = $product['GiaDatHang'] * $product['SoLuong'];
                    $total_price += $total_price_item;
                    $image_query = "SELECT * FROM hinhhanghoa WHERE MSHH=" . $product['MSHH'];
                    $image = getList($conn, $image_query)[0];
                    ?>
                    <tr class="row-cart">
                      <td class="align-middle border-0">
                        <a class="reset-anchor animsition-link" href="detail_product.php?id=<?php echo $product['MSHH']; ?>">
                          <p class="price-cart mb-0  ">#<?php echo $product['MSHH']; ?></p>
                        </a>
                      </td>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <a class="reset-anchor d-block animsition-link" href="detail_product.php?id=<?php echo $product['MSHH']; ?>">
                            <img src="../assets/images/products/<?php echo $image['TenHinh']; ?>" alt="Ảnh minh họa" width="70">
                          </a>
                          <div class="media-body ml-3">
                            <strong class="h6">
                              <a class="reset-anchor animsition-link" href="detail_product.php?id=<?php echo $product['MSHH']; ?>">
                                <?php echo $product['TenHH']; ?>
                              </a>
                            </strong>
                          </div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0  "><?php echo number_format($product['GiaDatHang']); ?> VNĐ</p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="total-item-cart mb-0 text-right">3</p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="total-item-cart mb-0 text-right "><strong><?php echo number_format($total_price_item); ?> VNĐ </strong></p>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <hr class="my-2">
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
    </div>
    <!-- Danh sách hàng hoá  -->

  </div>

  <?php include_once('components/import_footer.php');  ?>
</body>

</html>