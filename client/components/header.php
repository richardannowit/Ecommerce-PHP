<?php
if (session_id() === '')
    session_start();

$cart = null;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

?>

<header class="bs4header bg-primary">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php"><b><i>Khoa Tech</i></b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="bs4navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
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
                        <button class="btn btn-warning dropdown-toggle ml-lg-5" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tài khoản</button>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Trần Đăng Khoa</a>
                            <a class="dropdown-item" href="#">Setting</a>
                            <a class="dropdown-item" href="#">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>