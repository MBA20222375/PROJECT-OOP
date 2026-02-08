<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>

    <link rel="icon" href="App/assets/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="App/assets/css/vendors/all.min.css">
    <link rel="stylesheet" href="App/assets/css/vendors/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="App/assets/css/vendors/owl.carousel.min.css">
    <link rel="stylesheet" href="App/assets/css/vendors/owl.theme.default.min.css">
    <link rel="stylesheet" href="App/assets/css/main.min.css">
</head>

<body>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    ob_start();

    require_once "App/core/functions.php";
    ?>

    <!-- Header Content Start -->
    <div>
        <div class="header-container fixed-top border-bottom">

            <!-- top header -->
            <header>
                <div class="section-container d-flex justify-content-between">
                    <div class="header__email d-flex gap-2 align-items-center">
                        <i class="fa-regular fa-envelope"></i>
                        coding.arabic@gmail.com
                    </div>

                    <div class="header__info d-none d-lg-block">
                        شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
                    </div>

                    <div class="header__branches d-flex gap-2 align-items-center">
                        <a class="text-white text-decoration-none" href="index.php?page=branches">
                            <i class="fa-solid fa-location-dot"></i>
                            فروعنا
                        </a>
                    </div>
                </div>
            </header>
             <?php get_messages(); ?>

            <!-- navbar -->
            <nav class="nav">
                <div class="section-container w-100 d-flex align-items-center gap-4 h-100">

                    <div
                        class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
                        <button class="border-0 bg-transparent" data-bs-toggle="offcanvas"
                            data-bs-target="#nav__categories">
                            <i class="fa-solid fa-align-center fa-rotate-180"></i>
                        </button>
                    </div>

                    <div class="nav__logo">
                        <a href="index.php?page=home">
                            <img class="h-100" src="App/assets/images/logo.png" alt="logo">
                        </a>
                    </div>

                    <form class="nav__search w-100" method="get" action="index.php">
                        <input type="hidden" name="page" value="search">

                        <input class="nav__search-input w-100" type="search" name="q"
                            placeholder="أبحث هنا عن اي شئ تريده..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">

                        <button type="submit" class="nav__search-icon bg-transparent border-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>


                    <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">

                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2" href="index.php?page=account">
                                    تسجيل الدخول
                                    <i class="fa-regular fa-user"></i>
                                </a>
                            </li>
                        <?php 
                            else:
                                if(isset($_SESSION['role'])&&$_SESSION['role']==="admin"): 
                        ?>

                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2" href="index.php?page=create-product">
                                    اضافة منتج
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </li>
                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2" href="index.php?page=admin-add">
                                    اضافة مشرف
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </li>
                            <?php endif;?>

                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2" href="index.php?page=favourites">
                                    المفضلة
                                    <div class="position-relative">
                                        <i class="fa-regular fa-heart"></i>
                                        <div class="nav__link-floating-icon">0</div>
                                    </div>
                                </a>
                            </li>


                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2"
                                    href="index.php?page=cart">
                                    عربة التسوق
                                    <div class="position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <div class="nav__link-floating-icon">0</div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav__link">
                                <a class="d-flex align-items-center gap-2 text-danger" href="index.php?page=logout">
                                    تسجيل الخروج
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>

                <div class="nav-mobile fixed-bottom d-block d-lg-none">
                    <ul class="nav-mobile__list d-flex justify-content-around list-unstyled m-0 border-top">

                        <li class="nav-mobile__link">
                            <a class="d-flex flex-column gap-1 text-decoration-none" href="index.php?page=home">
                                <i class="fa-solid fa-house"></i>
                                الرئيسية
                            </a>
                        </li>

                        <li class="nav-mobile__link d-flex flex-column gap-1" data-bs-toggle="offcanvas"
                            data-bs-target="#nav__categories">
                            <i class="fa-solid fa-align-center fa-rotate-180"></i>
                            الاقسام
                        </li>

                        <li class="nav-mobile__link">
                            <a class="d-flex flex-column gap-1 text-decoration-none" href="index.php?page=profile">
                                <i class="fa-regular fa-user"></i>
                                حسابي
                            </a>
                        </li>

                        <li class="nav-mobile__link">
                            <a class="d-flex flex-column gap-1 text-decoration-none" href="index.php?page=favourites">
                                <i class="fa-regular fa-heart"></i>
                                المفضلة
                            </a>
                        </li>

                        <li class="nav-mobile__link" data-bs-toggle="offcanvas" data-bs-target="#nav__cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            السلة
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="nav__categories offcanvas offcanvas-start px-4 py-2" tabindex="-1" id="nav__categories">
                <div class="offcanvas-header justify-content-end">
                    <button type="button" class="border-0 bg-transparent text-danger" data-bs-dismiss="offcanvas">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>

                <div class="offcanvas-body pt-0">
                    <div class="nav__side-logo mb-2">
                        <img class="w-100" src="App/assets/images/logo.png" alt="">
                    </div>

                    <ul class="nav__list list-unstyled">
                        <li class="nav__side-link"><a href="index.php?page=shop&category=all">جميع المنتجات</a></li>
                        <li class="nav__side-link"><a href="index.php?page=shop&category=arabic">كتب عربية</a></li>
                        <li class="nav__side-link"><a href="index.php?page=shop&category=english">كتب انجليزية</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <section class="sales text-center p-2 d-block d-lg-none">
            شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
        </section>

       
    </div>
    
    <!-- Header Content End -->

