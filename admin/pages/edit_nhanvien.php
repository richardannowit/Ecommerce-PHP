<?php
$message_error = "";
$nhanvien_id = $_GET['id'];

$nhanvien_query = "SELECT * FROM nhanvien WHERE MSNV=" . $nhanvien_id;
$nhanvien = getList($conn, $nhanvien_query)[0];
if (isset($_POST['update'])) {
  $tennv = $_POST['tennv'];
  $chucvu = $_POST['chucvu'];
  $sdt = $_POST['sdt'];
  $diachi = $_POST['diachi'];
  $update_query = "UPDATE nhanvien SET HoTenNV='$tennv', ChucVu='$chucvu', DiaChi='$diachi', SoDienThoai='$sdt' WHERE MSNV=" . $nhanvien_id;
  $update_success = db_update($conn, $update_query);

  if (!$update_success) {
    $message_error = "<div class='alert alert-danger' role='alert'>
      Cập nhật nhân viên thất bại.</div>";
  } else {
    $message_error = '<div class="alert alert-success" role="alert">
    Cập nhật nhân viên mới thành công.
  </div>';

    $nhanvien['HoTenNV'] = $tennv;
    $nhanvien['ChucVu'] = $chucvu;
    $nhanvien['DiaChi'] = $diachi;
    $nhanvien['SoDienThoai'] = $sdt;
  }
}


?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Cập nhật thông tin nhân viên</h4>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>
      <form action="" method="POST">
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="tennv">Tên nhân viên </label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input type="text" class="form-control" name="tennv" id="tennv" value="<?php echo $nhanvien['HoTenNV']; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="chucvu">Chức vụ</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input type="text" name="chucvu" class="form-control" value="<?php echo $nhanvien['ChucVu']; ?>">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="sdt">Số điện thoại</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input type="text" name="sdt" class="form-control" value="<?php echo $nhanvien['SoDienThoai']; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label" for="diachi">Địa chỉ</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input type="text" class="form-control" name="diachi" id="diachi" value="<?php echo $nhanvien['DiaChi']; ?>">
              </div>
            </div>
          </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
        <a href="nhanvien.php" class="btn btn-light">Huỷ bỏ</a>
      </form>
    </div>
  </div>
</div>