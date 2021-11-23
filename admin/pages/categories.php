<?php
$category_query = "SELECT * FROM loaihanghoa";
$category_list = getList($conn, $category_query);


?>


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <p class="card-title my-auto">Danh sách loại hàng</p>
          <a href="add_category.php">
            <button type="button" class="btn btn-primary btn-block">
              <i class="ti-plus mr-4"></i>
              &nbsp;&nbsp;Thêm loại hàng
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
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending"> Mã loại hàng</th>
                      <th class="sorting_asc" aria-controls="orders-table" rowspan="1" colspan="1" aria-sort="ascending">Tên loại hàng</th>
                      <th style="width: 100px;">Công cụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($category_list as $row) {
                      ?>
                      <tr>
                        <td><a href="edit_category.php?id=<?php echo $row["MaLoaiHang"]; ?>"><?php echo $row["MaLoaiHang"]; ?></a></td>
                        <td><?php echo $row["TenLoaiHang"]; ?></td>
                        <td>
                          <a href="edit_category.php?id=<?php echo $row["MaLoaiHang"]; ?>">
                            <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                              <i class="ti-pencil-alt mx-0"></i>
                            </button>
                          </a>
                          <button type="button" delete_id="<?php echo $row["MaLoaiHang"]; ?>" class="btn btn-danger btn-rounded btn-icon px-0 delete" style="color: white; margin-left: 10px;">
                            <i class="ti-trash mx-0"></i>
                          </button>
                        </td>
                      </tr>
                      <input type="hidden" value="<?php echo $row["MaLoaiHang"]; ?>" id="category_id" name="category_id" />
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
  function delete_category(id) {
    Swal.fire({
      title: 'Xác nhận xoá?',
      text: "Bạn có chắc chắn muốn xoá nó không!",
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
          url: "delete_category.php",
          data: {
            category_id: id,
            delete: "Click",
          },
          success: function(result) {
            if (result === '1') {
              Swal.fire(
                'Thành công!',
                'Loại hàng đã được xoá thành công.',
                'success'
              ).then((res) => {
                location.reload(true);
              });
            } else {
              Swal.fire(
                'Thất bại!',
                'Xoá không thành công do có tồn tại sản phẩm thuộc loại hàng này .',
                'error'
              ).then((res) => {
                location.reload(true);
              });
            }

          },
          error: function(result) {
            Swal.fire(
              'Thất bại!',
              'Xoá loại hàng thất bại.',
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
      delete_category(id);
    });
  });
</script>