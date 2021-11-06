<?php
$category_query = "SELECT * FROM loaihanghoa";
$category_list = getList($conn, $category_query);
$target_dir = "../assets/images/products/";
$message_error = "";
if (isset($_POST['product_name'])) {
  $product_name = $_POST['product_name'];
  $category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'] ?? "";

  $insert_query = "INSERT INTO hanghoa (TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang) VALUES ('$product_name','$description',$price,$quantity,$category_id)";
  $insert_success = false;
  $insert_id = db_insert($conn, $insert_query);

  foreach ($_FILES['images']['name'] as $name => $value) {
    $name_img = date('Y-m-d-H-i-s') . '_' . uniqid() . stripslashes($_FILES['images']['name'][$name]);
    $source_img = $_FILES['images']['tmp_name'][$name];
    $path_img = $target_dir . $name_img;
    move_uploaded_file($source_img, $path_img);


    $insert_images = "INSERT INTO hinhhanghoa (TenHinh, MSHH) VALUES ('$name_img',$insert_id)";
    db_insert($conn, $insert_images);
  }



  if (!$insert_id) {
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
      <h4 class="card-title">Thêm mới hàng hoá</h4>
      <p class="card-description">
        <?php echo $message_error; ?>
      </p>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="product_name">Tên hàng hoá </label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input required type="text" name="product_name" class="form-control" id="tenHH" placeholder="Tên hàng hoá">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="category_id">Loại hàng hoá</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <select class="form-control form-control-sm" name="category_id" id="loaihang">
                  <?php
                  foreach ($category_list as $row) {
                    ?>
                    <option value="<?php echo $row["MaLoaiHang"]; ?>"><?php echo $row["TenLoaiHang"]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="price">Giá</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input required type="number" min="0" name="price" class="form-control" placeholder="VND">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="quantity">Số lượng</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input required type="number" min="0" name="quantity" class="form-control" placeholder="Số lượng" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label" for="description">Quy cách</label>
                <textarea name="description" rows="4" id="description" class="form-control" placeholder="Mô tả chi tiết sản phẩm"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Thêm hình ảnh</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <div class="custom-file">
                  <input required multiple type="file" class="form-control" name="images[]">
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="products.php" class="btn btn-light">Huỷ bỏ</a>
      </form>
    </div>
  </div>
</div>