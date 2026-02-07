<?php

use Oop\Project\Book;

$books = Book::getAll($db);

$top10 = Book::getTop10Sold($db);

$recentBooks = [];
foreach ($books as $book) {
  if ($book->isRecent()) {
    $recentBooks[] = $book;
  }
}
?>

<!-- Page Content Start -->
<main class="pt-4">
  <!-- Hero Section Start -->
  <section class="section-container hero">
    <div class="owl-carousel hero__carousel owl-theme">
      <div class="hero__item">
        <img class="hero__img" src="App/assets/images/carousel-2.png" alt="">
      </div>
      <div class="hero__item">
        <img class="hero__img" src="App/assets/images/carousel-2.png" alt="">
      </div>
      <div class="hero__item">
        <img class="hero__img" src="App/assets/images/carousel-2.png" alt="">
      </div>
    </div>

  </section>
  <!-- Hero Section End -->

  <!-- Offer Section Start -->
  <section class="section-container mb-5 mt-3">
    <div class="offer d-flex align-items-center justify-content-between rounded-3 p-3 text-white">
      <div class="offer__title fw-bolder">
        عروض اليوم
      </div>
      <div class="offer__time d-flex gap-2 fs-6">
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">06</span>
          <div>ساعات</div>
        </div>:
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">10</span>
          <div>دقائق</div>
        </div>:
        <div class="d-flex flex-column align-items-center">
          <span class="fw-bolder">13</span>
          <div>ثواني</div>
        </div>
      </div>
    </div>
  </section>
  <!-- Offer Section End -->

  <!-- Products Section Start -->
  <section class="section-container mb-4">
    <div class="owl-carousel products__slider owl-theme">
      <?php
      foreach ($books as $book):
        $image = "public/uploads/" . $book->getImage();
        $name = $book->getName();
        $id = $book->getId();
        $discount = $book->getDiscount();
        $price = $book->getPrice();
        $priceAfterDiscount = $book->getPriceAfterDiscount();
        if ($book->isRecent()) {
          $recentBooks[] = $book;
        }

        if ($book->getDiscount() > 0):
          ?>
          <div class="products__item">
            <div class="product__header mb-3">
              <a href="index.php?page=single_product&id=<?= $id; ?>">
                <div class="product__img-cont">
                  <img class="product__img w-100 h-100 object-fit-cover" src="<?= $image; ?>" data-id="white">
                </div>
              </a>
              <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                <?= "وفر" . $discount . "%" ?>
              </div>
              <a href="index.php?page=favourite-control&action=store&bookId=<?= $book->getId(); ?>"
                class="text-decoration-none">
                <div
                  class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                  <i class="fa-regular fa-heart"></i>
                </div>
              </a>
            </div>
            <div class="product__title text-center">
              <a class="text-black text-decoration-none" href="index.php?page=single_product&id=<?= $id; ?>">
                <?= $name; ?>
              </a>
            </div>
            <div class="product__author text-center">
              <?php
              foreach ($book->getAuthors($db) as $author) {
                echo $author['name'];
              }
              ?>
            </div>
            <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
              <span class="product__price product__price--old">
                <?= $price . " جنيه"; ?>
              </span>
              <span class="product__price">
                <?= $priceAfterDiscount . " جنيه"; ?>
              </span>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
  <!-- Products Section End -->

  <!-- Categories Section Start -->
  <section class="section-container mb-5">
    <div class="categories row gx-4">
      <div class="col-md-6 p-2">
        <div class="p-4 border rounded-3">
          <a href="index.php?page=shop&category=arabic">
            <img class="w-100" src="App/assets/images/category-1.png" alt="">
          </a>
        </div>
      </div>
      <div class="col-md-6 p-2">
        <div class="p-4 border rounded-3">
          <a href="index.php?page=shop&category=english">
            <img class="w-100" src="App/assets/images/category-2.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Categories Section End -->

  <!-- Best Sales Section Start -->
  <section class="section-container mb-5">
    <div class="products__header mb-4 d-flex align-items-center justify-content-between">
      <h4 class="m-0">الاكثر مبيعا</h4>
      <a href="index.php?page=shop&category=all"?>
      <button class="products__btn py-2 px-3 rounded-1">تسوق الأن</button>
      </a>
    </div>
    <div class="owl-carousel products__slider owl-theme">
      <?php
      foreach ($books as $book):
        $image = "public/uploads/" . $book->getImage();
        $name = $book->getName();
        $id = $book->getId();
        $discount = $book->getDiscount();
        $price = $book->getPrice();
        $priceAfterDiscount = $book->getPriceAfterDiscount();
        if ($book->isRecent()) {
          $recentBooks[] = $book;
        }
        ?>
        <div class="products__item">
          <div class="product__header mb-3">
            <a href="index.php?page=single_product&id=<?= $id; ?>">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="<?= $image; ?>" data-id="white">
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              <?= "وفر" . $discount . "%" ?>
            </div>
            <a href="index.php?page=favourite-control&action=store&bookId=<?= $book->getId(); ?>"
              class="text-decoration-none">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single_product&id=<?= $id; ?>">
              <?= $name; ?>
            </a>
          </div>
          <div class="product__author text-center">
            <?php
            foreach ($book->getAuthors($db) as $author) {
              echo $author['name'];
            }
            ?>
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              <?= $price . " جنيه"; ?>
            </span>
            <span class="product__price">
              <?= $priceAfterDiscount . " جنيه"; ?>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <!-- Best Sales Section End -->

  <!-- Newest Section Start -->
  <section class="section-container mb-5">
    <div class="products__header mb-4 d-flex align-items-center justify-content-between">
      <h4 class="m-0">وصل حديثا</h4>
      <a href="index.php?page=shop&category=all">
      <button class="products__btn py-2 px-3 rounded-1">تسوق الأن</button>
      </a>
    </div>
    <div class="owl-carousel products__slider owl-theme">
      <?php
      foreach ($recentBooks as $book):
        $image = "public/uploads/" . $book->getImage();
        $name = $book->getName();
        $id = $book->getId();
        $discount = $book->getDiscount();
        $price = $book->getPrice();
        $priceAfterDiscount = $book->getPriceAfterDiscount();
        ?>
        <div class="products__item">
          <div class="product__header mb-3">
            <a href="index.php?page=single_product&id=<?= $id; ?>">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="<?= $image; ?>" data-id="white">
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              <?= "وفر " . $discount . "%"; ?>
            </div>
            <a href="index.php?page=favourite-control&action=store&bookId=<?= $book->getId(); ?>"
              class="text-decoration-none">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single_product&id=<?= $id; ?>">
              <?= $name; ?>
            </a>
          </div>
          <div class="product__author text-center">
            <?php
            foreach ($book->getAuthors($db) as $author) {
              echo $author['name'];
            }
            ?>
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              <?= $price . " جنيه"; ?>
            </span>
            <span class="product__price">
              <?= $priceAfterDiscount . " جنيه"; ?>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <!-- Newest Section End -->
</main>
<!-- Page Content End -->