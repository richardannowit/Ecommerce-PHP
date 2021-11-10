<?php
$message_error = "";
$product_id = $_GET['id'];
$product_query = "SELECT * FROM hanghoa WHERE MSHH=" . $product_id;
$product = getList($conn, $product_query)[0];
$category_query = "SELECT * FROM loaihanghoa";
$category_list = getList($conn, $category_query);



if (isset($_POST['update'])) {
  $product_name = $_POST['product_name'];
  $category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $description = $_POST['description'] ?? "";

  $edit_sql = "UPDATE hanghoa SET TenHH='$product_name', QuyCach='$description', Gia='$price', SoLuongHang='$quantity', MaLoaiHang='$category_id' WHERE MSHH=" . $product_id;
  $edit_success = db_update($conn, $edit_sql);
  if (!$edit_success) {
    $message_error = "<div class='alert alert-danger' role='alert'>
      Cập nhật hàng hoá thất bại.</div>";
  } else {
    $message_error = '<div class="alert alert-success" role="alert">
      Cập nhật hàng hoá thành công.
    </div>';
    $product["TenHH"] = $product_name;
    $product["QuyCach"] = $description;
    $product["Gia"] = $price;
    $product["SoLuongHang"] = $quantity;
    $product["MaLoaiHang"] = $category_id;
  }
}

?>




<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Chỉnh sửa hàng hoá</h4>
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
                <input required type="text" value="<?php echo $product["TenHH"]; ?>" name="product_name" class="form-control" id="tenHH" placeholder="Tên hàng hoá">
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
                    <option <?php echo $product['MaLoaiHang'] == $row["MaLoaiHang"] ? "selected" : ""; ?> value="<?php echo $row["MaLoaiHang"]; ?>"><?php echo $row["TenLoaiHang"]; ?></option>
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
                <input required value="<?php echo $product["Gia"]; ?>" type="number" min="0" name="price" class="form-control" placeholder="VND">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="quantity">Số lượng</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <input required value="<?php echo $product["SoLuongHang"]; ?>" type="number" min="0" name="quantity" class="form-control" placeholder="Số lượng" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label" for="description">Quy cách</label>
                <textarea name="description" rows="4" id="description" class="form-control" placeholder="Mô tả chi tiết sản phẩm"><?php echo $product["QuyCach"]; ?>
                </textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Thêm hình ảnh</label>
                <span class="text-warning" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                <div class="custom-file">
                  <input multiple type="file" class="form-control" name="images[]">
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
        <a href="products.php" class="btn btn-light">Huỷ bỏ</a>
      </form>
    </div>
  </div>
</div>