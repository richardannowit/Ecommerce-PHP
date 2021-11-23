<?php
if (session_id() === '')
  session_start();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  $title = "Thông tin tác giả";
  include_once('components/import_header.php');

  ?>


</head>

<body class="d-flex flex-column">
  <?php include_once('components/header.php');  ?>
  <?php include_once('components/import_footer.php');  ?>
  <div class="flex-grow-1 flex-shrink-0">
    <section class="mt-5 mb-4">
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-6">
            <div class="img-border">
              <img src="../assets/avatar.jpg" alt="" class="avatar img-fluid">
            </div>
          </div>
          <div class="col-md-6">
            <div class="pt-3">
              <i class="bi bi-emoji-wink" style="font-size: 100px; color: var(--primary-color);"></i>
              <h1 class=" font-weight-bold">Trần Đăng Khoa</h1>
            </div>
            <h5 class="mb-2"><strong style="color: var(--primary-color);">MSSV: </strong>B1805879</h5>
            <h5 class="mb-2"><strong style="color: var(--primary-color);">LỚP: </strong>DI1896A2</h5>
            <div class="bg-white rounded pl-2 pt-1">
              <i class="bi bi-envelope-fill" style="color: var(--primary-color);"></i>
              <span class="menu-title">khoab1805879@student.ctu.edu.vn</span>
            </div>
            <div class="bg-white rounded pl-2 pt-1">
              <i class="bi bi-telephone-fill" style="color: var(--primary-color);"></i>
              <span class="menu-title">+84 947685343</span>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
  <?php include_once('components/footer.php');  ?>
</body>

</html>