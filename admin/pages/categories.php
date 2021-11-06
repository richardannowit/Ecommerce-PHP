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
                        <td><?php echo $row["MaLoaiHang"]; ?></td>
                        <td><?php echo $row["TenLoaiHang"]; ?></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-icon btn-rounded px-0">
                            <i class="ti-pencil-alt mx-0"></i>
                          </button>
                          <button type="button" onclick="delete_category();" class="btn btn-danger btn-rounded btn-icon px-0" style="color: white; margin-left: 10px;">
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
  function delete_category() {
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
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        ).then((res) => {
          console.log("Da xoa");
        })
      }
    })
  }
</script>