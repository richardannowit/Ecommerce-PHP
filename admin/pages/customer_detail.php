<?php
if (session_id() === '')
  session_start();

if (!isset($_SESSION['msnv'])) {
  header('location:login.php');
  exit;
}
$msnv = $_SESSION['msnv'];
$message_error = "";
$customer_id = $_GET['id'];
$customer_query = "SELECT * FROM khachhang WHERE MSKH=" . $customer_id;
$customer = getList($conn, $customer_query)[0];

$address_sql = "SELECT * FROM diachikh WHERE MSKH=" . $customer_id;
$address = getList($conn, $address_sql);

$order_sql = "SELECT * FROM dathang h JOIN diachikh d ON d.MaDC=h.MaDC WHERE h.MSKH=" . $customer_id . " ORDER BY h.NgayDH DESC";
$orders = getList($conn, $order_sql);


?>

<!-- Thông tin khách hàng  -->
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Thông tin đơn hàng</h4>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>
      <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="msnv" value="<?php echo $msnv; ?>" />
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="customer_id"><strong>Mã khách hàng: </strong></label>
                <input disabled value="#<?php echo $customer['MSKH']; ?>" type="text" min="0" name="customer_id" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="name"><strong>Họ và tên: </strong></label>
                <input disabled value="<?php echo $customer['HoTenKH']; ?>" type="text" name="name" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="phone"><strong>Số điện thoại: </strong></label>
                <input disabled value="<?php echo $customer['SoDienThoai']; ?>" type="text" name="phone" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="email"><strong>Email: </strong></label>
                <input disabled value="<?php echo $customer['Email']; ?>" type="text" name="email" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="company"><strong> Tên công ty: </strong></label>
                <input disabled value="<?php echo $customer['TenCongTy']; ?>" type="text" name="company" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="fax"><strong>Số FAX: </strong></label>
                <input disabled value="<?php echo $customer['fax']; ?>" type="text" name="fax" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label" for="address"><strong>Địa chỉ: </strong></label>
                <textarea style="line-height: 1.5;" disabled rows="<?php echo count($address); ?>" class="form-control"><?php
                                                                                                                        foreach ($address as $row) {
                                                                                                                          echo '- ' . $row['DiaChi'];
                                                                                                                          echo "\n";
                                                                                                                        }
                                                                                                                        ?>
                </textarea>
              </div>
            </div>
          </div>
        </div>
        <a href="customer.php" class="btn" style="color: white; background-color: #848484;">Trở lại</a>
      </form>
    </div>
  </div>
</div>

<!-- Thông tin đơn hàng  -->

<!-- Danh sách đơn hàng -->
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between mb-3">
        <h4 class="card-title my-auto">Danh sách đơn hàng</h4>
        <h4>
          <strong>Tổng số đơn hàng: </strong> <?php echo number_format(count($orders)); ?> đơn
        </h4>
      </div>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>

      <table id="orderTable" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
        <thead>
          <tr role="row">
            <th class="sorting_asc" aria-sort="ascending" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 25px;">Mã đơn hàng</th>
            <th aria-sort="ascending" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 103px;">Ngày đặt hàng</th>
            <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 111px;">Địa chỉ</th>
            <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 132px;">Tổng tiền (VNĐ)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($orders as $order) {
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
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Danh sách hàng hoá -->


<script>
</script>