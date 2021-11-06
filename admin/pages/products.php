<?php
$product_query = "SELECT * FROM hanghoa AS h LEFT JOIN loaihanghoa AS c ON c.MaLoaiHang=h.MaLoaiHang";
$product_list = getList($conn, $product_query);


?>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách hàng hoá</p>
          <a href="add_product.php">
            <button type="button" class="btn btn-primary btn-block">
              <i class="ti-plus mr-4"></i>
              &nbsp;&nbsp;Thêm hàng hoá
            </button>
          </a>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-sm-12">
                <table id="orders-table" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 25px;">Mã hàng hoá</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 103px;">Tên hàng hoá</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 111px;">Loại hàng hoá</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 132px;">Số lượng hàng</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 119px;">Giá</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 90px;">Tình trạng</th>
                      <th style="width: 100px;">Công cụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($product_list as $row) {
                      ?>
                      <tr>
                        <td><?php echo $row["MSHH"]; ?></td>
                        <td><?php echo $row["TenHH"]; ?></td>
                        <td><?php echo $row["TenLoaiHang"]; ?></td>
                        <td><?php echo $row["SoLuongHang"]; ?></td>
                        <td><?php echo number_format($row["Gia"]); ?> VNĐ</td>
                        <td><?php echo $row["SoLuongHang"] > 0 ? "Đang bán" : "Hết hàng"; ?></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                            <i class="ti-pencil-alt mx-0"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-rounded btn-icon px-0" style="color: white; margin-left: 10px;">
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