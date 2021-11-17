<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../client/css/sweetalert2.min.css">
  <link rel="stylesheet" href="../client/css/snackbar.css" />
  <link rel="stylesheet" href="../client/css/index.css" />
  <title>Lịch sử đặt hàng</title>

</head>

<body>
  <?php include_once('components/header.php');  ?>
  <div class="container-fluid w-100">
    <div class="container-fluid pt-2 mt-5">
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <p class="card-title"><b>Đơn hàng đang xử lý</b></p>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Ngày đặt hàng </th>
                      <th> Địa chỉ </th>
                      <th> Tổng tiền (VNĐ) </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>101</td>
                      <td>18/11/2021 | 23:00</td>
                      <td> Khóm 2 Thị trấn Đầm Dơi </td>
                      <td>23.000.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <p class="card-title"><b>Đơn hàng đã được xử lý</b></p>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Ngày đặt hàng </th>
                      <th> Địa chỉ </th>
                      <th> Tổng tiền (VNĐ) </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>101</td>
                      <td>18/11/2021 | 23:00</td>
                      <td> Khóm 2 Thị trấn Đầm Dơi </td>
                      <td>23.000.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>