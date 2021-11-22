<?php
if (session_id() === '')
  session_start();

if (!isset($_SESSION['msnv'])) {
  header('location:login.php');
  exit;
}
$msnv = $_SESSION['msnv'];
$message_error = "";
$order_id = $_GET['id'];

$total_price = 0;

$order_sql = "SELECT * FROM dathang WHERE SoDonDH=" . $order_id;
$orders = getList($conn, $order_sql);

if (count($orders) == 0) {
  header('location:orders.php');
  exit;
}
$order_detail = $orders[0];

$ngaydat = "";
$ngaydattmp = date_create($order_detail["NgayDH"]);
$ngaydat = date_format($ngaydattmp, 'd/m/Y | H:i:s');


$ngaygiao = "";
if ($order_detail['NgayGH'] != null) {
  $ngaygiao_tmp = date_create($order_detail["NgayGH"]);
  $ngaygiao = date_format($ngaygiao_tmp, 'd/m/Y | H:i:s');
}


$product_sql = "SELECT * FROM chitietdathang c JOIN hanghoa h ON c.MSHH=h.MSHH WHERE SoDonDH=" . $order_id;
$products = getList($conn, $product_sql);

$customer_sql = "SELECT * FROM khachhang WHERE MSKH=" . $order_detail["MSKH"];
$customer = getList($conn, $customer_sql)[0];

$nhanvienxuly = "";
if ($order_detail["MSNV"] != null) {
  $nhanvien_sql = "SELECT * FROM nhanvien WHERE MSNV=" . (int) $order_detail["MSNV"];
  $nhanvienxuly = getList($conn, $nhanvien_sql)[0]['HoTenNV'];
}

$address_sql = "SELECT * FROM diachikh WHERE MaDC=" . $order_detail["MaDC"];
$address = getList($conn, $address_sql)[0]["DiaChi"];

foreach ($products as $product) {
  $total_price_item = $product['GiaDatHang'] * $product['SoLuong'];
  $total_price += $total_price_item;
}

?>

<!-- Thông tin đơn hàng  -->
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
                <label class="form-control-label" for="order_id"><strong>Mã đơn hàng: </strong></label>
                <input disabled value="#<?php echo $order_detail['SoDonDH']; ?>" type="text" min="0" name="order_id" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="ngaydh"><strong>Ngày đặt hàng: </strong></label>
                <input disabled value="<?php echo $ngaydat; ?>" type="text" name="ngaydh" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="customer_id"><strong>Mã khách hàng: </strong></label>
                <input disabled value="#<?php echo $order_detail['MSKH']; ?>" type="text" name="customer_id" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="customer_name"><strong>Tên khách hàng: </strong></label>
                <input disabled value="<?php echo $customer['HoTenKH']; ?>" type="text" name="customer_name" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="customer_phone"><strong> Số điện thoại: </strong></label>
                <input disabled value="<?php echo $customer['SoDienThoai']; ?>" type="text" name="customer_phone" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="status"><strong>Tình trạng: </strong></label>
                <input disabled value="<?php echo $order_detail['TrangThaiDH'] == 1 ? 'Đã xử lý' : 'Đang xử lý'; ?>" type="text" name="status" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="nhanvienxuly"><strong>Nhân viên xử lý đơn hàng: </strong></label>
                <input disabled value="<?php echo $nhanvienxuly != "" ? $nhanvienxuly : 'Đơn hàng chưa được xử lý'; ?>" type="text" name="nhanvienxuly" class="form-control">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="ngaygh"><strong>Ngày giao hàng: </strong></label>
                <input disabled value="<?php echo $ngaygiao == '' ? 'Chưa giao' : $ngaygiao; ?>" type="text" name="ngaygh" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label" for="address"><strong>Địa chỉ giao hàng: </strong></label>
                <textarea disabled name="address" rows="4" id="address" class="form-control"><?php echo $address; ?>
                </textarea>
              </div>
            </div>
          </div>
        </div>
        <?php
        if ($order_detail['TrangThaiDH'] == 1) {
          if ($order_detail['NgayGH'] != null) {
            echo '';
          } else {
            echo '<button type="button" order_id="' . $order_detail['SoDonDH'] . '" action="giaohang" name="giaohang" class="btn btn-primary update">
                    Giao hàng
                  </button>';
          }
        } else {
          echo '<button type="button" order_id="' . $order_detail['SoDonDH'] . '" action="xuly" name="xuly" class="btn btn-primary update">
                  Xử lý đơn hàng
                </button>';
        }
        ?>
        <a href="orders.php" class="btn" style="color: white; background-color: #848484;">Trở lại</a>
      </form>
    </div>
  </div>
</div>

<!-- Thông tin đơn hàng  -->

<!-- Danh sách hàng hoá -->
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between mb-3">
        <h4 class="card-title my-auto">Danh sách hàng hoá</h4>
        <h4>
          <strong>Tổng thanh toán: </strong> <?php echo number_format($total_price); ?> VNĐ
        </h4>
      </div>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>

      <table id="orderTable" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
        <thead>
          <tr role="row">
            <th class="sorting_asc" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 25px;">Mã hàng hoá</th>
            <th class="sorting_asc" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 103px;">Tên hàng hoá</th>
            <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 111px;">Đơn giá (VNĐ)</th>
            <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 132px;">Số lượng</th>
            <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 119px;">Thành tiền (VNĐ)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($products as $product) {
            $total_price_item = $product['GiaDatHang'] * $product['SoLuong'];
            ?>
            <tr>
              <td>#<?php echo $product['MSHH']; ?></td>
              <td><?php echo $product['TenHH']; ?></td>
              <td><?php echo number_format($product['GiaDatHang']); ?> VNĐ</td>
              <td><?php echo $product['SoLuong']; ?></td>
              <td><?php echo number_format($total_price_item); ?> VNĐ</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Danh sách hàng hoá -->


<script>
  $(document).ready(function() {
    $('#orderTable').DataTable({
      searching: false,
      paging: false,
      info: false,
    });


    function update_order(id, action, msnv) {
      $.ajax({
        type: "POST",
        url: "order_update.php",
        data: {
          order_id: id,
          msnv: msnv,
          action: action,
        },
        success: function(result) {
          Swal.fire(
            'Thông báo!',
            result,
            'success'
          ).then((res) => {
            location.reload(true);
          });
        },
        error: function(result) {
          Swal.fire(
            'Thông báo!',
            'Cập nhật đơn hàng thất bại.',
            'error'
          );
        }
      });
    }


    $(".update").click(function(e) {
      var id = $(this).attr("order_id");
      var action = $(this).attr("action");
      var msnv = $("#msnv").val();
      // console.log(msnv);
      update_order(id, action, msnv);
    });
  });
</script>