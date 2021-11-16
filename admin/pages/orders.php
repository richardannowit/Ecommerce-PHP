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
                <table id="orders-table" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 25px;">Mã đơn hàng</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 103px;">Tên khách hàng</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 111px;">Số điện thoại</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 132px;">Ngày đặt hàng</th>
                      <th itemtype="num" tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 119px;">Tổng tiền (VNĐ)</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 90px;">Tình trạng</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 163px;">Địa chỉ</th>
                      <th style="width: 100px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($order_list as $order) {
                      $ngaygiao = date_create($order["NgayDH"]);
                      $order_id = $order["SoDonDH"];
                      $customer_sql = "SELECT * FROM khachhang WHERE MSKH=" . $order["MSKH"];
                      $customer = getList($conn, $customer_sql)[0];

                      $address_sql = "SELECT * FROM diachikh WHERE MaDC=" . $order["MaDC"];
                      $address = getList($conn, $address_sql)[0]["DiaChi"];
                      $address = strlen($address) > 45 ? substr($address, 0, 45) . "..." : $address;

                      $total_price_sql = "SELECT SUM((c.GiaDatHang*c.SoLuong)) AS total FROM chitietdathang c WHERE SoDonDH=" . $order_id;
                      $total_price = (int) getList($conn, $total_price_sql)[0]["total"];

                      ?>
                      <tr>
                        <td><?php echo $order["SoDonDH"]; ?></td>
                        <td><?php echo $customer["HoTenKH"]; ?></td>
                        <td><?php echo $customer["SoDienThoai"]; ?></td>
                        <td><?php echo date_format($ngaygiao, 'd/m/Y | H:i:s'); ?></td>
                        <td><?php echo number_format($total_price); ?></td>
                        <td><?php echo $order["TrangThaiDH"] == 0 ? "Chưa xử lý" : "Đã xử lý"; ?></td>
                        <td><?php echo $address; ?></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                            <i class="ti-pencil-alt mx-0"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-rounded btn-icon px-0" style="color: white; margin-left: 10px;">
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
  // $('#orderTable').dataTable();
</script>