<?php
$message_error = "";
if (isset($_POST['category_name'])) {
  $category_name = $_POST['category_name'];
  $insert_query = "INSERT INTO loaihanghoa (TenLoaiHang) VALUES ('$category_name')";
  $insert_success = db_insert($conn, $insert_query);

  if (!$insert_success) {
    $message_error = "<div class='alert alert-danger' role='alert'>
      Thêm loại hàng thất bại.</div>";
  } else {
    $message_error = '<div class="alert alert-success" role="alert">
    Thêm loại hàng mới thành công.
  </div>';
  }
}


?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Thêm mới loại hàng</h4>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>
      <form action="" method="POST">
        <div class="form-group">
          <label for="category_name">Tên loại hàng</label>
          <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Hãy nhập tên loại hàng">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="categories.php" class="btn btn-light">Huỷ bỏ</a>
      </form>
    </div>
  </div>
</div>