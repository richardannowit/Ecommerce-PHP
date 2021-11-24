<?php
if (session_id() === '')
  session_start();


if (isset($_SESSION['msnv'])) {
  header('location:index.php');
  exit;
}
$title = "Đăng nhập";
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once('components/import_header.php');

$message = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $login_sql = "SELECT * FROM nhanvien WHERE MSNV='$username' AND NVpass='$password'";
  $user = getList($conn, $login_sql);
  if (count($user) == 0) {
    $message = "<div class='alert alert-danger' role='alert'>
    Tài khoản đăng nhập không đúng.</div>";
  } else {
    $_SESSION['msnv'] = $user[0]['MSNV'];
    $_SESSION['tennv'] = $user[0]['HoTenNV'];
    header('location:index.php');
  }
}


?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="assets/images/E-KHOA.svg" style="height:100%; width: 500px; margin-left: -50px;">
              </div>
              <h3>ĐĂNG NHẬP</h3>
              <h6 class="font-weight-light mb-3">Vui lòng đăng nhập để tiếp tuc.</h6>
              <p class="card-description">
                <?php echo $message; ?>
              </p>
              <form action="" method="POST">
                <div class="form-group">
                  <label for="username"><b>Mã nhân viên: </b></label>
                  <input required type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Nhập mã số nhân viên">
                </div>
                <div class="form-group">
                  <label for="password"><b>Mật khẩu: </b></label>
                  <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="mt-3 d-flex justify-content-center">
                  <button type="submit" name="login" class="btn btn-primary font-weight-medium">ĐĂNG NHẬP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


</body>

</html>