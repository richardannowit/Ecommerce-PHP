<?php
if (session_id() === '')
  session_start();
if (isset($_SESSION['mskh'])) {
  header('location:index.php');
  exit;
}
$message = "";
require('../database/connect.php');
require('../database/repository.php');


if (isset($_POST['signup'])) {
  echo "SUBMIT";
  $name = "";
  $phone = "";
  $password = "";

  if (isset($_POST['name'])) {
    $name = $_POST['name'];
  }
  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
  }
  if (isset($_POST['password'])) {
    $password = $_POST['password'];
  }
  $addUser_sql = "INSERT INTO khachhang (HoTenKH,SoDienThoai,KHPass) VALUES ('$name','$phone','$password')";
  $mskh = db_insert($conn, $addUser_sql);
  if (!$mskh) {
    $message = "<div class='alert alert-danger' role='alert'>
    Số điện thoại đã tồn tại.</div>";;
  } else {
    if (isset($_POST['address'])) {
      $address = $_POST['address'];
      $add_address_sql = "INSERT INTO diachikh (MSKH, DiaChi) VALUES ('$mskh','$address')";
      db_insert($conn, $add_address_sql);
    }

    header('location:login.php?signup=1');
  }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
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
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="../assets/E-KHOA-2.svg" style="height:100%; width: 500px; margin-left: -50px;">
                </div>
                <h3>ĐĂNG KÝ TÀI KHOẢN</h3>
                <h6 class="font-weight-light mb-3">Hãy đăng ký tài khoản để lưu thông tin các đơn hàng.</h6>
                <p class="card-description">
                  <?php echo $message; ?>
                </p>
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="name"><b>Họ và tên: </b></label>
                    <input required type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Nhập tên của bạn">
                  </div>
                  <div class="form-group">
                    <label for="phone"><b>Số điện thoại: </b></label>
                    <input required class="form-control" name="phone" id="phone" type="tel" placeholder="Nhập số điện thoại">
                  </div>
                  <!-- pattern="[0-9]+" -->
                  <div class="form-group">
                    <label for="address"><b>Địa chỉ: </b></label>
                    <input required class="form-control" name="address" id="address" type="text" placeholder="Nhập địa chỉ của bạn">
                  </div>
                  <div class="form-group">
                    <label for="password"><b>Mật khẩu: </b></label>
                    <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Nhập mật khẩu">
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="index.php" class="text-primary">Về trang chủ</a>
                    <button type="submit" name="signup" class="btn btn-primary font-weight-medium">ĐĂNG KÝ</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Bạn đã có tài khoản? <a href="login.php" class="text-primary">Đăng nhập</a>
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