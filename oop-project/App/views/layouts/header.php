<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" href="App/assets/images/logo.png" type="image/x-icon"/>
  <link rel="stylesheet" href="App/assets/css/vendors/all.min.css">
  <link rel="stylesheet" href="App/assets/css/vendors/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="App/assets/css/vendors/owl.carousel.min.css">
  <link rel="stylesheet" href="App/assets/css/vendors/owl.theme.default.min.css">
  <link rel="stylesheet" href="App/assets/css/main.min.css">
</head>

<body>
  <?php
    require_once "App/core/functions.php";
    get_messages();
  ?>
  <!-- Header Content Start -->
  <div>
    <div class="header-container fixed-top border-bottom">
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

      <nav class="nav">
        <div class="section-container w-100 d-flex align-items-center gap-4 h-100">

          <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
            <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
              <i class="fa-solid fa-align-center fa-rotate-180"></i>
            </button>
          </div>

          <div class="nav__logo">
            <a href="index.php?page=home">
              <img class="h-100" src="assets/images/logo.png" alt="">
            </a>
          </div>

          <div class="nav__search w-100">
            <input class="nav__search-input w-100" type="search" placeholder="أبحث هنا عن اي شئ تريده...">
            <span class="nav__search-icon">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </div>

          <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">

            <li class="nav__link">
              <a class="d-flex align-items-center gap-2" href="index.php?page=register">
                تسجيل الدخول
                <i class="fa-regular fa-user"></i>
              </a>
            </li>

            <li class="nav__link">
              <a class="d-flex align-items-center gap-2" href="index.php?page=favourites">
                المفضلة
                <div class="position-relative">
                  <i class="fa-regular fa-heart"></i>
                  <div class="nav__link-floating-icon">
                    0
                  </div>
                </div>
              </a>
            </li>

            <li class="nav__link">
              <a class="d-flex align-items-center gap-2" data-bs-toggle="offcanvas" data-bs-target="#nav__cart">
                عربة التسوق
                <div class="position-relative">
                  <i class="fa-solid fa-cart-shopping"></i>
                  <div class="nav__link-floating-icon">
                    0
                  </div>
                </div>
              </a>
            </li>

          </ul>
        </div>

        <div class="nav-mobile fixed-bottom d-block d-lg-none">
          <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled m-0 border-top">

            <li class="nav-mobile__link">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="index.php?page=home">
                <i class="fa-solid fa-house"></i>
                الرئيسية
              </a>
            </li>

            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" 
                data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
              <i class="fa-solid fa-align-center fa-rotate-180"></i>
              الاقسام
            </li>

            <li class="nav-mobile__link">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="index.php?page=profile">
                <i class="fa-regular fa-user"></i>
                حسابي 
              </a>
            </li>

            <li class="nav-mobile__link">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="index.php?page=favourites">
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
        <div class="nav__categories-header offcanvas-header justify-content-end">
          <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
          </button>
        </div>

        <div class="nav__categories-body offcanvas-body pt-0">
          <div class="nav__side-logo mb-2">
            <img class="w-100" src="assets/images/logo.png" alt="">
          </div>

          <ul class="nav__list list-unstyled">
            <li class="nav__link nav__side-link">
              <a href="index.php?page=shop" class="py-3">جميع المنتجات</a>
               <li class="nav__link nav__side-link"><a href="index.php?page=shop" class="py-3">كتب عربيه</a></li>
            <li class="nav__link nav__side-link"><a href="index.php?page=shop" class="py-3">كتب انجليزية</a></li>
            </li>
          </ul>
        </div>
      </div>

    </div>

    <section class="sales text-center p-2 d-block d-lg-none">
      شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
    </section>

  </div>
  <!-- Header Content End -->
