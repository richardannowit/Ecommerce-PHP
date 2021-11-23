<?php
$khachhang_query = "SELECT * FROM khachhang";
$khachhang_list = getList($conn, $khachhang_query);


?>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách khách hàng</p>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-sm-12">
                <table id="orders-table" class="table dataTable no-footer expandable-table table-hover" style="width: 100%;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 25px;">Mã khách hàng</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: 103px;">Họ và tên</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 111px;">Số điện thoại</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 132px;">Email</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 119px;">Tên công ty</th>
                      <th tabindex="0" aria-controls="orders-table" rowspan="1" colspan="1" style="width: 119px;">Số FAX</th>
                      <th style="width: 40px;">Công cụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($khachhang_list as $row) {
                      ?>
                      <tr>
                        <td><a href="customer_detail.php?id=<?php echo $row['MSKH']; ?>">#<?php echo $row['MSKH']; ?></a></td>
                        <td><?php echo $row['HoTenKH']; ?></td>
                        <td><?php echo $row['SoDienThoai']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['TenCongTy']; ?></td>
                        <td><?php echo $row['fax']; ?></td>
                        <td>
                          <a href="customer_detail.php?id=<?php echo $row['MSKH']; ?>">
                            <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                              <i class="ti-pencil-alt mx-0"></i>
                            </button>
                          </a>
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