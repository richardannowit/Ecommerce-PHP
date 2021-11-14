<?php
if (session_id() === '')
  session_start();
require('../database/connect.php');
require('../database/repository.php');

$cart = array();
$count_cart = 0;
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  $count_cart = count($cart);
}


$total_price = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  $title = "Đặt hàng";
  include_once('components/import_header.php');

  ?>
</head>

<body>
  <?php include_once('components/header.php');  ?>


  <section class="mt-5 mb-4">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="row justify-content-around">
            <!-- Thông tin đặt hàng -->
            <div class="col-lg-5 mb-5">
              <div class="row mb-5">
                <div class="col-12">
                  <h4 class="text-uppercase mb-4">Thông tin giao hàng</h4>
                </div>
                <?php if (isset($_SESSION['mskh'])) { ?>

                  <?php
                    $login_sql = "SELECT * FROM khachhang WHERE MSKH=" . $_SESSION['mskh'];
                    $user = getList($conn, $login_sql)[0];
                    $address_sql = "SELECT * FROM diachikh WHERE MSKH=" . $_SESSION['mskh'];
                    $address = getList($conn, $address_sql);
                    ?>

                  <!-- Đã Đăng nhập -->
                  <div class="col-lg-12">
                    <form action="order.php" method="POST">
                      <input type="hidden" name="mskh" id="mskh" value="<?php echo $user['MSKH']; ?>" />
                      <div class="row">
                        <!-- Họ tên -->
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="name">Họ và tên</label>
                          <input required class="form-control" disabled id="name" name="name" type="text" value="<?php echo $user['HoTenKH']; ?>">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="phone">Số điện thoại</label>
                          <input class="form-control" disabled name="phone" id="phone" type="tel" value="<?php echo $user['SoDienThoai']; ?>">
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
                          <input required class="form-control" id="company" name="company" type="text" value="<?php echo $user['TenCongTy']; ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="fax">Số FAX</label>
                          <input required class="form-control " pattern="[0-9]+" name="fax" id="fax" type="tel" value="<?php echo $user['fax']; ?>">
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col-lg-4">
                          <a href="cart.php">
                            <button type="button" class="btn medium-secondary-btn btn-block">Quay lại</button>
                          </a>
                        </div>
                        <div class="col-lg-4">
                          <button type="submit" <?php echo !isset($_SESSION['cart']) || count($_SESSION['cart']) == 0  ? "disabled" : "";  ?> class="btn medium-primary-btn btn-block">Đặt hàng</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- Đã Đăng nhập -->
                <?php } else { ?>
                  <!-- Chưa đăng nhập  -->
                  <div class="col-lg-12 form-group">
                    <p class="">(*) Thông tin bắt buộc nhập</p>
                  </div>
                  <div class="col-lg-12">
                    <form action="order.php" method="POST">
                      <div class="row">
                        <!-- Họ tên -->
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="name">Họ và tên
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                          </label>
                          <input required class="form-control" id="name" name="name" type="text" placeholder="Nhập họ và tên" value="">
                        </div>
                      </div>
                      <div class="row">
                        <!-- Số điện thoại -->
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="phone">Số điện thoại
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                          </label>
                          <input required class="form-control" pattern="[0-9]+" name="phone" id="phone" type="tel" placeholder="Nhập số điện thoại">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="address">Địa chỉ nhận hàng
                            <span class="text-danger" data-toggle="tooltip" data-placement="left" title="" data-original-title="Thông tin bắt buộc nhập">(*)</span>
                          </label>
                          <input required class="form-control" id="address" name="address" type="text" placeholder="Số nhà, đường, xã/phường, quận/huyện, tỉnh/TP">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="email">
                            Email
                          </label>
                          <input class="form-control" name="email" id="email" type="email" placeholder="Nhập địa chỉ email">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="company">Tên công ty</label>
                          <input class="form-control" id="company" name="company" type="text" placeholder="Nhập tên công ty">
                        </div>
                      </div>
                      <div class="row">
                        <!-- Số điện thoại -->
                        <div class="col-lg-12 form-group">
                          <label class="text-small " for="fax">Số FAX</label>
                          <input class="form-control" name="fax" id="fax" type="tel" placeholder="Nhập số fax">
                        </div>
                      </div>
                      <!-- Địa chỉ nhận hàng -->

                      <div class="row justify-content-between">
                        <div class="col-lg-4">
                          <a href="cart.php">
                            <button type="button" class="btn medium-secondary-btn btn-block">Quay lại</button>
                          </a>
                        </div>
                        <div class="col-lg-4">
                          <button type="submit" <?php echo count($_SESSION['cart']) == 0 ? "disabled" : "";  ?> class="btn medium-primary-btn btn-block">Đặt hàng</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- Chưa đăng nhập  -->
                <?php } ?>
              </div>
            </div>
            <!-- Thông tin đặt hàng -->



            <!-- Giỏ hàng  -->
            <div class="col-lg-5">
              <div class="card border-0 ">
                <div class="card-header card-2">
                  <div class="row justify-content-between">

                    <div class="col-lg-8 ">
                      <p class="card-text text-muted mt-md-4 mb-2 space">
                        Giỏ hàng <span class=" small text-muted ml-2 cursor-pointer">(<?php echo $count_cart; ?> sản phẩm)</span>
                      </p>
                    </div>
                    <div class="col-lg-4 d-flex align-items-end justify-content-end ">
                      <a href="cart.php" class="float-right">
                        <button type="button" class="btn btn-primary ">Chỉnh sửa</button>
                      </a>
                    </div>
                  </div>

                  <hr class="my-2">
                </div>
                <div class="card-body pt-3">
                  <?php
                  if ($count_cart != 0) {
                    foreach ($cart as $key => $item) {
                      $item_sql = "SELECT * FROM hanghoa h JOIN loaihanghoa l ON l.MaLoaiHang=h.MaLoaiHang WHERE MSHH=" . $item["pd_id"];
                      $product = getList($conn, $item_sql)[0];
                      if ($item["pd_quantity"] > $product["SoLuongHang"]) {
                        $item["pd_quantity"] = $product["SoLuongHang"];
                        $_SESSION['cart'][$item["pd_id"]]['pd_quantity'] = $product["SoLuongHang"];
                      }
                      if ($item["pd_quantity"] == 0) {
                        unset($_SESSION['cart'][$item["pd_id"]]);
                        break;
                      }
                      $total_price += ($product["Gia"] * $item["pd_quantity"]);
                      ?>
                      <div class="row justify-content-between">
                        <div class="col-auto col-md-7">
                          <div class="media flex-column flex-sm-row">
                            <img class=" img-fluid mr-3" src="<?php echo $host; ?>assets/images/products/<?php echo $item["pd_img"]; ?>" width="62" height="62">
                            <div class="media-body my-auto">
                              <div class="row ">
                                <div class="col">
                                  <p class="mb-0"><b><?php echo $product["TenHH"]; ?></b></p>
                                  <small class="text-muted"><?php echo $product["TenLoaiHang"]; ?></small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="pl-0 flex-sm-col col-auto my-auto">
                          <p class="boxed"><?php echo $item["pd_quantity"]; ?></p>
                        </div>
                        <div class="pl-0 flex-sm-col col-auto my-auto">
                          <p><b><?php echo number_format($product["Gia"] * $item["pd_quantity"]); ?> VNĐ</b></p>
                        </div>
                      </div>
                      <hr class="my-2">
                  <?php }
                  } ?>
                  <div class="row ">
                    <div class="col">
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <p class="mb-1">Giá tạm tính</p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p class="mb-1"><?php echo number_format($total_price); ?> VNĐ</p>
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col">
                          <p class="mb-1">Phí vận chuyển</p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p class="mb-1">Miễn phí</p>
                        </div>
                      </div>
                      <div class="row justify-content-between">
                        <div class="col-4">
                          <p><b>Tổng cộng</b></p>
                        </div>
                        <div class="flex-sm-col col-auto">
                          <p style="color: var(--primary-color)" class="mb-1"><b><?php echo number_format($total_price); ?> VNĐ</b></p>
                        </div>
                      </div>
                      <hr class="my-0">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Giỏ hàng  -->




          </div>
        </div>

      </div>
    </div>
  </section>



  <?php include_once('components/import_footer.php');  ?>


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