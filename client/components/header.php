<?php
if (session_id() === '')
    session_start();

$cart = null;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

?>

<header class="bs4header bg-primary " style="box-shadow: 0px 5px 21px -5px #cdd1e1;">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php">
                <img src="../assets/E-KHOA.svg" width="250" height="50" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs4navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_me.php">Tác giả</a>
                    </li>
                    <li class="nav-item px-3 text-uppercase mb-0 position-relative d-lg-flex">
                        <div id="cart" class="d-none">

                        </div>
                        <a href="cart.php" class="cart position-relative d-inline-flex" aria-label="View your shopping cart">
                            <i class="bi bi-cart-fill" style="font-size:25px; vertical-align: middle;"></i>
                            <span id="cart-count" class="cart-basket d-flex align-items-center justify-content-center">
                                <?php echo $cart == null ? "0" : count($cart); ?>
                            </span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <?php if (isset($_SESSION['mskh'])) { ?>
                            <button class="btn btn-warning dropdown-toggle ml-lg-5" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['tenkh']; ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="order_history.php">Đơn hàng của tôi</a>
                                <a class="dropdown-item" href="user_info.php">Tài khoản của tôi</a>
                                <a class="dropdown-item" href="logout.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>">Đăng xuất</a>
                            </div>
                        <?php } else { ?>
                            <a class="btn btn-warning ml-lg-5" href="login.php?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>">Đăng nhập</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>