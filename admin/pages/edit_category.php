<?php
$message_error = "";
$category_id = $_GET['id'];
$category_query = "SELECT * FROM loaihanghoa WHERE MaLoaiHang=" . $category_id;
$category = getList($conn, $category_query)[0];
if (isset($_POST['update'])) {
    $new_category = $_POST['category_name'];
    $edit_sql = "UPDATE loaihanghoa SET TenLoaiHang='$new_category' WHERE MaLoaiHang=" . $category_id;
    $edit_success = db_update($conn, $edit_sql);
    if (!$edit_success) {
        $message_error = "<div class='alert alert-danger' role='alert'>
        Cập nhật loại hàng thất bại.</div>";
    } else {
        $message_error = '<div class="alert alert-success" role="alert">
        Cập nhật loại hàng thành công.
      </div>';
        $category["TenLoaiHang"] = $new_category;
    }
}


?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Cập nhật loại hàng</h4>
            <p class="card-description">
                <?php echo $message_error; ?>
            </p>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="category_name">Tên loại hàng</label>
                    <input required type="text" class="form-control" value="<?php echo $category["TenLoaiHang"]; ?>" name="category_name" id="category_name" placeholder="Hãy nhập tên loại hàng">
                </div>
                <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                <a href="categories.php" class="btn btn-light">Huỷ bỏ</a>
            </form>
        </div>
    </div>
</div>