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
                        <td class="font-weight-medium">
                          <div class="badge <?php echo $row["SoLuongHang"] > 0 ? "badge-success" : "badge-danger" ?> ">
                            <?php echo $row["SoLuongHang"] > 0 ? "Đang bán" : "Hết hàng"; ?>
                          </div>
                        </td>
                        <td>
                          <a href="edit_product.php?id=<?php echo $row['MSHH']; ?>">
                            <button href="edit_product.php" class="btn btn-primary btn-icon btn-rounded px-0">
                              <i class="ti-pencil-alt mx-0"></i>
                            </button>
                          </a>
                          <button type="button" delete_id="<?php echo $row["MSHH"]; ?>" class="btn btn-danger btn-rounded btn-icon px-0 delete" style="color: white; margin-left: 10px;">
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



<script>
  function delete_product(id) {
    Swal.fire({
      title: 'Xác nhận xoá?',
      text: "Bạn có chắc chắn muốn xoá sản phẩm này không!",
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
          url: "delete_product.php",
          data: {
            product_id: id,
            delete: "Click",
          },
          success: function(result) {
            Swal.fire(
              'Thành công!',
              'Sản phẩm đã được xoá thành công.',
              'success'
            ).then((res) => {
              location.reload(true);
            });
          },
          error: function(result) {
            Swal.fire(
              'Thất bại!',
              'Xoá sản phẩm thất bại.',
              'error'
            );
          }
        });
      }
    })
  }
  $(document).ready(function() {
    $(".delete").click(function(e) {
      var id = $(this).attr("delete_id");
      delete_product(id);
    });
  });
</script>