<?php
if (session_id() === '')
  session_start();
if (!isset($_SESSION['mskh'])) {
  header('location:index.php');
  exit;
}
require('../database/connect.php');
require('../database/repository.php');

$message_error = "";
$login_sql = "SELECT * FROM khachhang WHERE MSKH=" . $_SESSION['mskh'];
$user = getList($conn, $login_sql)[0];
$address_sql = "SELECT * FROM diachikh WHERE MSKH=" . $_SESSION['mskh'];
$address = getList($conn, $address_sql);


if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $company = $_POST['company'];
  $fax = $_POST['fax'];
  $update_query = "UPDATE khachhang SET HoTenKH='$name', SoDienThoai='$phone', TenCongTy='$company', Email='$email' , fax='$fax' WHERE MSKH=" . $_SESSION['mskh'];
  $update_success = db_update($conn, $update_query);
  if (!$update_success) {
    $message_error = "<div class='alert alert-danger' role='alert'>
      Thất bại! Số điện thoại đã có người sử dụng.</div>";
  } else {
    $message_error = '<div class="alert alert-success" role="alert">
    Cập nhật thông tin thành công.
  </div>';

    $user['HoTenKH'] = $name;
    $user['SoDienThoai'] = $phone;
    $user['TenCongTy'] = $company;
    $user['Email'] = $email;
    $user['fax'] = $fax;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  $title = "Đặt hàng";
  include_once('components/import_header.php');

  ?>
</head>

<body class="d-flex flex-column">
  <?php include_once('components/header.php');  ?>

  <div class="flex-grow-1 flex-shrink-0">
    <section class="mt-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row justify-content-around">
              <div class="col-lg-5 mb-5">
                <div class="row mb-5">
                  <div class="col-12">
                    <h4 class="text-uppercase mb-4">Thông tin của bạn</h4>
                    <p class="card-description">
                      <?php echo $message_error; ?>
                    </p>
                  </div>
                  <div class="col-lg-12">
                    <form action="" method="POST">
                      <input type="hidden" name="mskh" id="mskh" value="<?php echo $user['MSKH']; ?>" />
                      <div class="row">
                        <!-- Họ tên -->
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="name">Họ và tên</label>
                          <input required class="form-control" id="name" name="name" type="text" value="<?php echo $user['HoTenKH']; ?>">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="phone">Số điện thoại</label>
                          <input class="form-control" name="phone" id="phone" type="tel" value="<?php echo $user['SoDienThoai']; ?>">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <div class="row justify-content-between">
                            <div class="col-lg-4 d-flex align-items-center">
                              <label class="text-small " for="address">Địa chỉ nhận hàng</label>
                            </div>
                            <div class=" mb-1 col-lg-4 d-flex align-items-start justify-content-end ">
                              <button type="button" id="add_address" class="btn btn-primary btn-sm ">Thêm địa chỉ</button>
                            </div>
                          </div>

                          <select class="form-control" name="address" id="address">
                            <?php
                            foreach ($address as $row) {
                              ?>
                              <option value="<?php echo $row["MaDC"]; ?>"><?php echo $row["DiaChi"]; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="email">Email</label>
                          <input class="form-control" name="email" id="email" type="email" value="<?php echo $user['Email']; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="company">Tên công ty</label>
                          <input class="form-control" id="company" name="company" type="text" value="<?php echo $user['TenCongTy']; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="fax">Số FAX</label>
                          <input class="form-control " pattern="[0-9]+" name="fax" id="fax" type="tel" value="<?php echo $user['fax']; ?>">
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col-lg-4">
                          <a href="index.php">
                            <button type="button" class="btn medium-secondary-btn btn-block">Quay lại</button>
                          </a>
                        </div>
                        <div class="col-lg-4">
                          <button type="submit" name="update" class="btn medium-primary-btn btn-block">Cập nhật</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>
      </div>
    </section>
  </div>


  <?php include_once('components/import_footer.php');  ?>
  <?php include_once('components/footer.php');  ?>

  <script>
    const add_new_address = async (mskh) => {
      const {
        value: address
      } = await Swal.fire({
        title: 'Thêm địa chỉ mới',
        input: 'text',
        inputPlaceholder: 'Nhập địa chỉ mới của bạn',
        inputAttributes: {
          autocapitalize: 'off'
        },
        inputValidator: (value) => {
          if (!value) {
            return 'Địa chỉ không được trống!'
          }
        },
        showCancelButton: true,
        confirmButtonText: 'Thêm',
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading()
      });
      if (address) {
        // Swal.fire(`Entered address: ${address}`)
        $.ajax({
          type: "POST",
          url: "add_address.php",
          data: {
            mskh: mskh,
            address: address,
            add: "Click",
          },
          success: function(result) {
            if (result === '1') {
              Swal.fire(
                'Thành công!',
                'Địa chỉ của bạn đã được thêm.',
                'success'
              ).then((res) => {
                location.reload(true);
              });
            } else {
              Swal.fire(
                'Thất bại!',
                'Thêm địa chỉ thất bại.',
                'error'
              ).then((res) => {
                location.reload(true);
              });
            }

          },
          error: function(result) {
            Swal.fire(
              'Thất bại!',
              'Thêm địa chỉ thất bại.',
              'error'
            );
          }
        });
      }

    }
    $(document).ready(function() {
      $("#add_address").click(function(e) {
        var mskh = $("#mskh").val();
        add_new_address(mskh);
      });
    });
  </script>
</body>

</html>