<?php
if (session_id() === '')
  session_start();
if (isset($_SESSION['mskh'])) {
  header('location:index.php');
  exit;
}
$redirect = "index.php";
if (isset($_GET['redirect'])) {
  $redirect = $_GET['redirect'];
}
$message = "";
require('../database/connect.php');
require('../database/repository.php');
if (isset($_GET['signup'])) {
  $message = '<div class="alert alert-success" role="alert">
    Đăng ký tài khoản thành công. Vui lòng đăng nhập để tiếp tục!
  </div>';
}
if (isset($_POST['login']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $login_sql = "SELECT * FROM khachhang WHERE SoDienThoai='$username' AND KHPass='$password'";
  $user = getList($conn, $login_sql);
  if (count($user) == 0) {
    $message = "<div class='alert alert-danger' role='alert'>
    Tài khoản đăng nhập không đúng.</div>";
  } else {
    $_SESSION['sdt'] = $user[0]['SoDienThoai'];
    $_SESSION['tenkh'] = $user[0]['HoTenKH'];
    $_SESSION['mskh'] = $user[0]['MSKH'];
    header('location:' . $redirect);
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="css/feather.css"> -->
  <link rel="stylesheet" href="css/feather-icons.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <link rel="stylesheet" href="css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script defer src="js/font-awesome.js"></script>
  <script defer src="js/vendor.bundle.base.js"></script>
  <script defer src="js/jquery.dataTables.js"></script>
  <script defer src="js/dataTables.bootstrap4.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column">
  <div class="flex-grow-1 flex-shrink-0">
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="../assets/logo.svg" alt="logo">
                </div>
                <h3>ĐĂNG NHẬP</h3>
                <h6 class="font-weight-light mb-3">Vui lòng đăng nhập để tiếp tuc.</h6>
                <p class="card-description">
                  <?php echo $message; ?>
                </p>
                <form class="" action="" method="POST">
                  <div class="form-group">
                    <label for="username"><b>Số điện thoại: </b></label>
                    <input required type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Nhập số điện thoại">
                  </div>
                  <div class="form-group">
                    <label for="password"><b>Mật khẩu: </b></label>
                    <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Nhập mật khẩu">
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="index.php" name="login" class="text-primary">Về trang chủ</a>
                    <button type="submit" name="login" class="btn btn-primary font-weight-medium">ĐĂNG NHẬP</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Bạn chưa có tài khoản? <a href="signup.php" class="text-primary">Đăng ký</a>
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
  </div>
</body>

</html>