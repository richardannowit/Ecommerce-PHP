<?php
if (session_id() === '')
  session_start();
if (!isset($_SESSION['mskh'])) {
  header('location:index.php');
  exit;
}
$mskh = $_SESSION['mskh'];
?>
<!DOCTYPE html>
<html lang="en">

<?php

$title = "Lịch sử mua hàng";
require('../database/connect.php');
require('../database/repository.php');
include_once('components/import_header.php');

$active_order_sql = "SELECT * FROM dathang h JOIN diachikh d ON d.MaDC=h.MaDC WHERE h.MSKH=" . $mskh . " AND (TrangThaiDH=1 AND h.NgayGH IS NULL) ORDER BY h.NgayDH DESC";
$active_order = getList($conn, $active_order_sql);
$non_active_order_sql = "SELECT * FROM dathang h JOIN diachikh d ON d.MaDC=h.MaDC WHERE h.MSKH=" . $mskh . " AND h.TrangThaiDH=0 ORDER BY h.NgayDH DESC";
$non_active_order = getList($conn, $non_active_order_sql);
$shiped_order_sql = "SELECT * FROM dathang h JOIN diachikh d ON d.MaDC=h.MaDC WHERE h.MSKH=" . $mskh . " AND h.NgayGH IS NOT NULL ORDER BY h.NgayDH DESC";
$shiped_order = getList($conn, $shiped_order_sql);

?>

<body class="d-flex flex-column">
  <?php include_once('components/header.php');  ?>

  <div class="flex-grow-1 flex-shrink-0">
    <div class="container mb-5">
      <div class="container-fluid pt-2 mt-5">

        <?php
        if (count($non_active_order) > 0) {
          ?>
          <div class="row mb-4">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title"><b>Đơn hàng đang xử lý</b></p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Mã đơn hàng</th>
                          <th>Ngày đặt hàng </th>
                          <th> Địa chỉ </th>
                          <th> Tổng tiền (VNĐ) </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($non_active_order as $order) {
                            $ngaydat = date_create($order["NgayDH"]);
                            $order_id = $order["SoDonDH"];
                            $total_price_sql = "SELECT SUM((c.GiaDatHang*c.SoLuong)) AS total FROM chitietdathang c WHERE SoDonDH=" . $order_id;
                            $total_price = (int) getList($conn, $total_price_sql)[0]["total"];
                            $address = $order['DiaChi'];
                            $address = strlen($address) > 95 ? substr($address, 0, 95) . "..." : $address;
                            ?>
                          <tr>
                            <td>
                              <a class="reset-anchor d-block animsition-link" href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>">
                                #<?php echo $order['SoDonDH']; ?>
                              </a>
                            </td>
                            <td><?php echo date_format($ngaydat, 'd/m/Y | H:i:s'); ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo number_format($total_price); ?></td>
                          </tr>
                        <?php  } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>
        <?php
        }
        ?>

        <?php
        if (count($active_order) > 0) {
          ?>
          <div class="row mb-4">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title"><b>Đơn hàng đã được xử lý</b></p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Mã đơn hàng</th>
                          <th>Ngày đặt hàng </th>
                          <th> Địa chỉ </th>
                          <th> Tổng tiền (VNĐ) </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($active_order as $order) {
                            $ngaydat = date_create($order["NgayDH"]);
                            $order_id = $order["SoDonDH"];
                            $total_price_sql = "SELECT SUM((c.GiaDatHang*c.SoLuong)) AS total FROM chitietdathang c WHERE SoDonDH=" . $order_id;
                            $total_price = (int) getList($conn, $total_price_sql)[0]["total"];
                            $address = $order['DiaChi'];
                            $address = strlen($address) > 95 ? substr($address, 0, 95) . "..." : $address;
                            ?>
                          <tr>
                            <td><a class="reset-anchor d-block animsition-link" href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>">
                                #<?php echo $order['SoDonDH']; ?>
                              </a>
                            </td>
                            <td><?php echo date_format($ngaydat, 'd/m/Y | H:i:s'); ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo number_format($total_price); ?></td>
                          </tr>
                        <?php  } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>

        <?php
        if (count($shiped_order) > 0) {
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title"><b>Đơn hàng đã được giao</b></p>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Mã đơn hàng</th>
                          <th>Ngày đặt hàng </th>
                          <th> Địa chỉ </th>
                          <th> Tổng tiền (VNĐ) </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($shiped_order as $order) {
                            $ngaydat = date_create($order["NgayDH"]);
                            $order_id = $order["SoDonDH"];
                            $total_price_sql = "SELECT SUM((c.GiaDatHang*c.SoLuong)) AS total FROM chitietdathang c WHERE SoDonDH=" . $order_id;
                            $total_price = (int) getList($conn, $total_price_sql)[0]["total"];
                            $address = $order['DiaChi'];
                            $address = strlen($address) > 95 ? substr($address, 0, 95) . "..." : $address;
                            ?>
                          <tr>
                            <td><a class="reset-anchor d-block animsition-link" href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>">
                                #<?php echo $order['SoDonDH']; ?>
                              </a>
                            </td>
                            <td><?php echo date_format($ngaydat, 'd/m/Y | H:i:s'); ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo number_format($total_price); ?></td>
                          </tr>
                        <?php  } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <?php
      if (count($non_active_order) == 0 && count($shiped_order) == 0 && count($active_order) == 0) {
        ?>
        <div class="container-fluid">
          <div class="row d-flex align-item-center justify-content-center">
            <div class="col-md-8">
              <div class="pt-3 text-center">
                <i class="bi bi-check-circle text-primary" style="font-size: 100px;"></i>
                <h1 class=" font-weight-bold">Bạn chưa có đơn hàng nào 😥</h1>
              </div>

              <div class="bg-white rounded p-3 mt-3 text-center">
                <p class="text-muted mb-5">Hãy đến trang chủ và thêm các món đồ bạn thích vào giỏ hàng thôi nào!</p>
                <a href="index.php" class="btn rounded medium-primary-btn btn-lg btn-block mt-3">Mua sắm thôi nào!</a>
              </div>
            </div>
          </div>
        </div>


      <?php } ?>
    </div>



  </div>




  <?php include_once('components/import_footer.php');  ?>
  <?php include_once('components/footer.php');  ?>
</body>

</html>