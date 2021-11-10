<?php
if (session_id() === '')
  session_start();

if (!isset($_SESSION['msnv'])) {
  header('location:login.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once('components/import_header.php');
?>

<body data-new-gr-c-s-check-loaded="14.1034.0" data-gr-ext-installed>
  <div class="container-fluid w-100 px-0">
    <?php include_once('components/navbar.php'); ?>
    <div class="container-fluid page-body-wrapper pt-2 mt-5">
      <?php include_once('components/sidebar.php'); ?>
      <div class="main-panel">
        <!-- Main content  -->
        <div class="content-wrapper">
          <?php include_once('pages/add_nhanvien.php'); ?>
        </div>
        <!-- End Main content  -->
        <!-- Footer -->
        <?php include_once('components/footer.php'); ?>
        <!-- End Footer -->
      </div>
    </div>
  </div>


</body>

</html>