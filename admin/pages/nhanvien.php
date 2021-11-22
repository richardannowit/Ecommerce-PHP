<?php
$nhanvien_query = "SELECT * FROM nhanvien";
$nhanvien_list = getList($conn, $nhanvien_query);


?>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách nhân viên</p>
          <a href="add_nhanvien.php" class="btn btn-primary btn-block">
            <i class="ti-plus mr-4"></i>
            &nbsp;&nbsp;Thêm nhân viên
          </a>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-sm-12">
                <table id="orders-table" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 25px;">Mã nhân viên</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 103px;">Họ và tên</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 111px;">Chức vụ</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 132px;">Địa chỉ</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 119px;">Số điện thoại</th>
                      <th style="width: 100px;">Công cụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($nhanvien_list as $row) {
                      ?>
                      <tr>
                        <td>#<?php echo $row['MSNV']; ?></td>
                        <td><?php echo $row['HoTenNV']; ?></td>
                        <td><?php echo $row['ChucVu']; ?></td>
                        <td><?php echo $row['DiaChi']; ?></td>
                        <td><?php echo $row['SoDienThoai']; ?></td>
                        <td>
                          <a href="edit_nhanvien.php?id=<?php echo $row['MSNV']; ?>">
                            <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                              <i class="ti-pencil-alt mx-0"></i>
                            </button>
                          </a>
                          <button type="button" delete_id="<?php echo $row["MSNV"]; ?>" class="btn btn-danger btn-rounded btn-icon px-0 delete" style="color: white; margin-left: 10px;">
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
  function delete_nhanvien(id) {
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
          url: "delete_nhanvien.php",
          data: {
            nhanvien_id: id,
            delete: "Click",
          },
          success: function(result) {
            if (result === '1') {
              Swal.fire(
                'Thành công!',
                'Đã xoá nhân viên thành công.',
                'success'
              ).then((res) => {
                location.reload(true);
              });
            } else {
              Swal.fire(
                'Thất bại!',
                'Xoá nhân viên thất bại, do nhân viên này có đơn hàng xử lý.',
                'error'
              );
            }

          },
          error: function(result) {
            Swal.fire(
              'Thất bại!',
              'Xoá nhân viên thất bại.',
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
      delete_nhanvien(id);
    });
  });
</script>