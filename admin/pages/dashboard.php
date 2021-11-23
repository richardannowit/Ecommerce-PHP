<?php
$category_query = "SELECT * FROM loaihanghoa";
$category_list = getList($conn, $category_query);
$customer_query = "SELECT * FROM khachhang ORDER BY MSKH DESC LIMIT 6";
$customer_list = getList($conn, $customer_query);
$product_query = "SELECT * FROM hanghoa ORDER BY MSHH DESC LIMIT 7";
$product_list = getList($conn, $product_query);
$order_sql = "SELECT * FROM dathang";
$order_list = getList($conn, $order_sql);
$non_active_order_sql = "SELECT * FROM dathang h WHERE h.TrangThaiDH=0";
$non_active_order = getList($conn, $non_active_order_sql);


$price_sql = "SELECT SUM((GiaDatHang * SoLuong)) AS PRICE FROM chitietdathang";
$total_price = getList($conn, $price_sql)[0]["PRICE"];


$today = date_create();
$today = date_format($today, 'd/m/Y');
?>



<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Chào bạn <?php echo $_SESSION['tennv']; ?></h3>
          <h6 class="font-weight-normal mb-0">Bạn có
            <a href="orders.php" style="text-decoration: none;" class="text-primary"><?php echo count($non_active_order); ?> đơn hàng chưa được xử lý!</a>
          </h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="mdi mdi-calendar"></i> Hôm nay (<?php echo $today; ?>)
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 border-right">
      <div class="table-responsive mb-3 mb-md-0 mt-3">
        <table class="table table-borderless report-table">
          <tbody>
            <?php
            for ($i = 0; $i < count($category_list); $i++) {
              $product_query = "SELECT * FROM hanghoa WHERE MaLoaiHang=" . $category_list[$i]['MaLoaiHang'];
              $product_total_query = "SELECT * FROM hanghoa";
              $product_count = count(getList($conn, $product_query));
              $total_product_count = count(getList($conn, $product_total_query));
              $percent = ($product_count / $total_product_count) * 100;
              $color = array("bg-warning", "bg-danger", "bg-info");
              ?>
              <tr>
                <td class="text-muted"><?php echo $category_list[$i]["TenLoaiHang"]; ?></td>
                <td class="w-100 px-0">
                  <div class="progress progress-md mx-4">
                    <div style="width: <?php echo $percent; ?>%" class="progress-bar <?php echo $color[$i % 3]; ?>" role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </td>
                <td>
                  <h5 class="font-weight-bold mb-0"><?php echo $product_count; ?>/<?php echo $total_product_count; ?></h5>
                </td>
              </tr>
            <?php } ?>
            <!-- bg-warning bg-danger bg-info -->
          </tbody>
        </table>
      </div>
    </div>


    <?php


    ?>
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale bg-primary">
            <div class="card-body">
              <p class="mb-4">Tổng thu nhập</p>
              <p class="fs-30 mb-2"><?php echo number_format($total_price); ?> VNĐ</p>
              <p>10.12% (30 ngày)</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue bg-warning">
            <div class="card-body">
              <p class="mb-4">Tổng số đơn hàng</p>
              <p class="fs-30 mb-2"><?php echo count($order_list); ?></p>
              <p>22.12% (30 ngày)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue bg-success">
            <div class="card-body">
              <p class="mb-4">Số lượng hàng hoá</p>
              <p class="fs-30 mb-2"><?php echo count($product_list); ?></p>
              <p>2.00% (30 ngày)</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">Số người dùng đã mua hàng</p>
              <p class="fs-30 mb-2"><?php echo count($customer_list); ?></p>
              <p>0.22% (30 ngày)</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="d-flex justify-content-between">
            <h4 class="card-title">Người dùng mới nhất</h4>
            <a href="customer.php" class="text-info">Xem thêm</a>
          </div>
          <?php
          foreach ($customer_list as $customer) {
            $address_sql = "SELECT * FROM diachikh WHERE MSKH=" . $customer['MSKH'];
            $address = getList($conn, $address_sql)[0]['DiaChi'];
            ?>
            <div class="d-flex align-items-center pb-3 mb-4 border-bottom">
              <a href="customer_detail.php?id=<?php echo $customer['MSKH']; ?>">
                <img class="img-sm rounded-circle" src="assets/images/face28.jpg" alt="profile">
              </a>
              <div class="ms-3">
                <h6 class="mb-1">
                  <a href="customer_detail.php?id=<?php echo $customer['MSKH']; ?>" style="text-decoration: none; color: black;">
                    <?php echo $customer['HoTenKH']; ?>
                  </a>
                </h6>
                <small class="text-muted mb-0">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <?php echo $address; ?>
                </small>
              </div>
              <i class="ti-check font-weight-bold ms-auto px-1 py-1 text-info mdi-24px"></i>
            </div>
          <?php  } ?>
        </div>
      </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <p class="card-title">Sản phẩm mới nhất</p>
            <a href="products.php" class="text-info">Xem thêm</a>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>Mã sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Tình trạng</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($product_list as $row) {
                  ?>
                  <tr>
                    <td>
                      <a href="edit_product.php?id=<?php echo $row['MSHH']; ?>">#<?php echo $row["MSHH"]; ?></a>
                    </td>
                    <td><?php echo $row["TenHH"]; ?></td>
                    <td class="font-weight-bold"><?php echo $row["Gia"]; ?> VNĐ</td>
                    <td><?php echo $row["SoLuongHang"]; ?> sản phẩm</td>

                    <td class="font-weight-medium">
                      <div class="badge badge-success <?php echo $row["SoLuongHang"] == 0 ? "badge-danger" : "badge-success"; ?>">
                        <?php echo $row["SoLuongHang"] == 0 ? "Hết hàng" : "Còn hàng"; ?>
                      </div>
                    </td>
                  </tr>
                <?php  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <p class="card-title">Đơn hàng mới nhất</p>
            <a href="orders.php" class="text-info">Xem thêm</a>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-sm-12">
                  <table id="example" class="table expandable-table table-hover" style="width: 100%;" role="grid">
                    <thead>
                      <tr role="row">
                        <th class="select-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="Quote#" style="width: 125px;">Mã đơn hàng</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" style="width: 133px;">Tên khách hàng</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 131px;">Số điện thoại</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 132px;">Ngày đặt hàng</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119px;">Tổng tiền (VNĐ)</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119px;">Tình trạng</th>
                        <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 143px;">Địa chỉ</th>
                        <th class="details-control sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 100px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $order_sql = "SELECT * FROM dathang";
                      $order_list = getList($conn, $order_sql);
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
                        <tr class="odd">
                          <td><a href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>" style="text-decoration: none;">#<?php echo $order["SoDonDH"]; ?></a></td>
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
                        </tr>
                      <?php } ?>
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
</div>