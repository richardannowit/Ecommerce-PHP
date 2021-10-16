<!DOCTYPE html>
<html lang="en">

<?php

$title = "Trang chủ";
require('connect.php');
require('repository.php');
include_once('components/import_header.php');


$category_params = array();
$sort_type = "price_asc";
$search = "";
if (isset($_GET['category'])) {
  $category_params = $_GET['category'];
}
if (isset($_GET['sort'])) {
  $sort_type = $_GET['sort'];
}
if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

$product_query = "SELECT * FROM hanghoa";
if (count($category_params) > 0) {
  for ($i = 0; $i < count($category_params); $i++) {
    if ($i != 0) {
      $product_query = $product_query . " OR ";
    } else {
      $product_query = $product_query . " WHERE (";
    }
    $product_query = $product_query . "MaLoaiHang = " . strval($category_params[$i]);
    if ($i == count($category_params) - 1) {
      $product_query = $product_query . ")";
    }
  }
}

if ($search != "") {
  if (count($category_params) == 0) {
    $product_query = $product_query . " WHERE ";
  } else {
    $product_query = $product_query . " AND ";
  }
  $product_query = $product_query . " TenHH LIKE '%" . $search . "%'";
}

if ($sort_type == 'price_desc') {
  $product_query = $product_query . " ORDER BY Gia DESC";
} else {
  $product_query = $product_query . " ORDER BY Gia ASC";
}
$product_list = getList($conn, $product_query);

$category_query = "SELECT * FROM loaihanghoa";
$category_list = getList($conn, $category_query);



?>

<body>
  <?php include_once('components/header.php');  ?>
  <section>
    <form action="index.php" method="GET" name="index-form">
      <div class="container-fluid px-2">
        <div class="row">
          <div class="col-lg-2 border-right  pt-2">
            <div class="row border-bottom pl-0">
              <div class="col-md-6 col-lg-12 py-3 pl-5">
                <strong class="mb-5">Loại sản phẩm</strong>

                <?php
                foreach ($category_list as $row) {
                  ?>
                  <div class="custom-control custom-checkbox mt-2 mb-3">
                    <input type="checkbox" <?php echo in_array($row["MaLoaiHang"], $category_params) ? "checked" : "" ?> class="custom-control-input" id="category_<?php echo $row["MaLoaiHang"]; ?>" name="category[]" value="<?php echo $row["MaLoaiHang"]; ?>" />
                    <label class="custom-control-label" for="category_<?php echo $row["MaLoaiHang"]; ?>">
                      <?php echo $row["TenLoaiHang"]; ?>
                    </label>
                  </div>
                <?php } ?>

                <div class="row mt-4">
                  <div class="col-lg-12">
                    <button type="submit" class="btn medium-primary-btn btn-block">Áp dụng</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- <div class="row border-bottom pl-0">
              <div class="col-md-6 col-lg-12 py-3 pl-5 pr-5">
                <strong class="mb-5">Khoảng giá</strong>
                <div class="mt-3">
                  <div class="form-row">
                    <div class="col mr-3 ">
                      <div class="input-group">
                        <input type="text" class="form-control input-rounded" placeholder="Min">
                      </div>

                    </div>
                    <div class="col">
                      <input type="text" class="form-control input-rounded" placeholder="Max">
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-12">
                    <button type="button" class="btn medium-primary-btn btn-block">Áp dụng</button>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
          <!-- main content -->
          <div class="col-lg-9 mx-5">
            <!-- Search input -->
            <div class="row px-4 pb-2">
              <div class="col-md-6 col-lg-12 py-3 px-4">
                <div class="mt-3">
                  <div class="form-row">
                    <div class="col-lg-7 mr-3 ">
                      <div class="input-group search-group">
                        <span class="input-group-append prefix-search-icon" style="background-color: var(--secondary-color);">
                          <div class="input-group-text bg-transparent border-0  pl-4 py-2">
                            <i class="bi bi-search"></i>
                          </div>
                        </span>

                        <input name="search" value="<?php echo $search; ?>" class="form-control py-2 border-0 shadow-none input-search py-4" type="text" placeholder="Search..." id="search" />
                        <span onclick="document.getElementById('search').value = ''; document.forms['index-form'].submit()" class="input-group-append suffix-search-icon" style="background-color: var(--secondary-color);">
                          <div class="input-group-text bg-transparent border-0  px-4 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                              </path>
                            </svg>
                          </div>
                        </span>
                        <button type="submit" class="btn medium-secondary-btn ml-4" style="background-color: var(--primary-color) !important; color: white">
                          Tìm kiếm
                        </button>
                      </div>


                    </div>
                  </div>
                </div>

              </div>
            </div>
            <?php if ($search != '') { ?>
              <div class="row px-4">
                <div class="col-md-6 col-lg-12  px-4">
                  Kết quả tìm kiếm cho: <strong><?php echo $search; ?></strong>
                </div>

              </div>
            <?php
            }
            ?>
            <!-- End Search input -->

            <!-- Sort type  -->
            <div class="row px-4 pb-4">
              <div class="d-flex flex-row px-4">
                <div class="py-3 pr-4">Sắp xếp theo: </div>
                <div class="mt-2">
                  <div class="col-lg-12">
                    <button type="submit" name="sort" value="price_asc" class="btn medium-secondary-btn <?php echo $sort_type == 'price_asc' ? 'active' : '' ?>">Giá tăng dần</button>
                  </div>
                </div>
                <div class="mt-2">
                  <div class="col-lg-12">
                    <button type="submit" name="sort" value="price_desc" class="btn medium-secondary-btn <?php echo $sort_type == 'price_desc' ? 'active' : '' ?>">Giá giảm dần</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- End sort type  -->

            <!-- Show products  -->
            <div class="row row-col-4 px-4 pt-2">
              <?php
              if (count($product_list) == 0) {
                ?>
                <div class="col-lg-3 col-md-12 mb-4">
                  Không tìm thấy sản phẩm
                </div>
              <?php
              }
              foreach ($product_list as $row) {
                ?>
                <div class="col-lg-3 col-md-12 mb-4">
                  <div class="card card-ecommerce">
                    <div class="view overlay">
                      <img src="<?php echo $host; ?>assets/images/products/product-detail-1.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title mb-1">
                        <strong>
                          <a href="<?php echo $host; ?>detail_product.php?id=<?php echo $row['MSHH']; ?>" class="dark-grey-text">
                            <?php echo $row["TenHH"]; ?>
                          </a>
                        </strong>
                      </h5>
                      <span class="badge badge-danger mb-2">bestseller</span>
                      <!-- Rating -->
                      <!-- <ul class="rating">
                                        <li><i class="fas fa-star blue-text"></i></li>
                                        <li><i class="fas fa-star blue-text"></i></li>
                                        <li><i class="fas fa-star blue-text"></i></li>
                                        <li><i class="fas fa-star blue-text"></i></li>
                                        <li><i class="fas fa-star blue-text"></i></li>
                                    </ul> -->
                      <div class="card-footer pb-0">
                        <div class="d-flex align-items-center justify-content-around row mb-0">
                          <strong><?php echo number_format($row["Gia"]); ?> VNĐ</strong>
                          <button type="button" class="btn medium-secondary-btn" style="background-color: var(--primary-color) !important; color: white">
                            Add to cart
                          </button>

                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              <?php } ?>
            </div>
            <!-- End Show products  -->

            <div class="row justify-content-center mb-4">
              <!--Pagination -->
              <nav class="mb-4">
                <ul class="pagination pagination-circle pg-blue mb-0">

                  <!--First-->
                  <li class="page-item disabled clearfix d-none d-md-block"><a class="page-link waves-effect waves-effect">First</a></li>

                  <!--Arrow left-->
                  <li class="page-item disabled">
                    <a class="page-link waves-effect waves-effect" aria-label="Previous">
                      <span aria-hidden="true">«</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>

                  <!--Numbers-->
                  <li class="page-item active"><a class="page-link waves-effect ">1</a></li>
                  <li class="page-item "><a class="page-link  waves-effect">2</a></li>
                  <li class="page-item"><a class="page-link waves-effect ">3</a></li>
                  <li class="page-item"><a class="page-link waves-effect ">4</a></li>
                  <li class="page-item"><a class="page-link waves-effect ">5</a></li>

                  <!--Arrow right-->
                  <li class="page-item">
                    <a class="page-link waves-effect waves-effect" aria-label="Next">
                      <span aria-hidden="true">»</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>

                  <!--First-->
                  <li class="page-item clearfix d-none d-md-block"><a class="page-link waves-effect waves-effect">Last</a></li>

                </ul>
              </nav>
              <!--/Pagination -->

            </div>

          </div>
          <!-- main content -->
        </div>
      </div>
    </form>
  </section>







  <?php include_once('components/import_footer.php');  ?>
</body>

</html>