<?php
$order_sql = "SELECT * FROM dathang";
$order_list = getList($conn, $order_sql);


?>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách đơn hàng</p>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-sm-12">
                <table id="orderTable" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting_desc" aria-controls="orderTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 25px;">Mã đơn hàng</th>
                      <th class="sorting_asc" aria-controls="orderTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 103px;">Tên khách hàng</th>
                      <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 111px;">Số điện thoại</th>
                      <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 132px;">Ngày đặt hàng</th>
                      <th itemtype="num" tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 119px;">Tổng tiền (VNĐ)</th>
                      <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 90px;">Tình trạng</th>
                      <th tabindex="0" aria-controls="orderTable" rowspan="1" colspan="1" style="width: 163px;">Địa chỉ</th>
                      <th style="width: 100px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($order_list as $order) {
                      $ngaygiao = date_create($order["NgayDH"]);
                      $customer_sql = "SELECT * FROM khachhang WHERE MSKH=" . $order["MSKH"];
                      $customer = getList($conn, $customer_sql)[0];

                      $address_sql = "SELECT * FROM diachikh WHERE MaDC=" . $order["MaDC"];
                      $address = getList($conn, $address_sql)[0]["DiaChi"];
                      $address = strlen($address) > 45 ? substr($address, 0, 45) . "..." : $address;

                      $order_id = $order["SoDonDH"];
                      $total_price_sql = "SELECT SUM((c.GiaDatHang*c.SoLuong)) AS total FROM chitietdathang c WHERE SoDonDH=" . $order_id;
                      $total_price = (int) getList($conn, $total_price_sql)[0]["total"];

                      ?>
                      <tr>
                        <td><a href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>" style="text-decoration: none;"><?php echo $order["SoDonDH"]; ?></a></td>
                        <td><?php echo $customer["HoTenKH"]; ?></td>
                        <td><?php echo $customer["SoDienThoai"]; ?></td>
                        <td><?php echo date_format($ngaygiao, 'd/m/Y | H:i:s'); ?></td>
                        <td><?php echo number_format($total_price); ?></td>
                        <td><?php echo $order["TrangThaiDH"] == 0 ? "Chưa xử lý" : ($order['NgayGH'] == null ? "Đã xử lý" : "Đã giao"); ?></td>
                        <td><?php echo $address; ?></td>
                        <td>
                          <a href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>">
                            <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                              <i class="ti-pencil-alt mx-0"></i>
                            </button>
                          </a>
                          <button type="button" delete_id="<?php echo $order["SoDonDH"]; ?>" class="btn btn-danger btn-rounded btn-icon px-0 delete" style="color: white; margin-left: 10px;">
                            <i class="ti-trash mx-0"></i>
                          </button>
                        </td>

                      <?php  } ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function delete_order(id) {
    Swal.fire({
      title: 'Xác nhận xoá?',
      text: "Bạn có chắc chắn muốn xoá đơn hàng này không!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận',
      cancelButtonText: 'Huỷ'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "delete_order.php",
          data: {
            order_id: id,
            delete: "Click",
          },
          success: function(result) {
            Swal.fire(
              'Thành công!',
              'Đơn hàng đã được xoá thành công.',
              'success'
            ).then((res) => {
              location.reload(true);
            });
          },
          error: function(result) {
            Swal.fire(
              'Thất bại!',
              'Xoá đơn hàng thất bại.',
              'error'
            );
          }
        });
      }
    })
  }
  $(document).ready(function() {
    $('#orderTable').DataTable({
      info: false,
      "bLengthChange": false,
      "order": [
        [0, "desc"]
      ]
    });
    $(".delete").click(function(e) {
      var id = $(this).attr("delete_id");
      delete_order(id);
    });
  });
</script>