<?php

use Oop\Project\Book;

$books = [];
switch ($_GET['category']) {
  case "all":
    $books = Book::getAll($db);
    break;
  case "arabic":
    $books = Book::getBooksByCategory($db, "كتاب بالغه العربيه");
    break;
  case "english":
    $books = Book::getBooksByCategory($db, "كتاب بالغه الانجليزيه");
    break;
}

$books_count = count($books);
?>


<main>
  <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>المتجر</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">المتجر</span>
      </div>
    </div>
  </div>

  <div class="section-container d-block d-lg-flex gap-5 shop mt-5 pt-5">
    <!-- <div class="shop__filter mb-4"> -->
    <!-- <div class="mb-4">
            <h6 class="shop__filter-title">بتدور علي ايه؟</h6>
            <form action="">
              <div class="filter__search position-relative">
                <input
                  class="w-100 py-1 ps-2"
                  type="text"
                  placeholder="بتدور علي ايه؟"
                />
                <div
                  class="filter__search-icon position-absolute h-100 top-0 end-0 p-2 d-flex justify-content-center align-items-center"
                >
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </form>
          </div> -->
    <div class="shop__products col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="m-0"><?php "عرض 1 - 40 من أصل" . $books_count . "نتيجة" ?></p>
    </div>
    <?php foreach($books as $book):?>
    <div class="row products__list">
      <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
        <div class="product__header mb-3">
          <a href="index.php?page=single_product&id=<?= $book->getId(); ?>">
            <div class="product__img-cont">
              <img class="product__img w-100 h-100 object-fit-cover" src="<?php echo "public/uploads/".$book->getImage();?>"
                data-id="white" />
            </div>
          </a>
          <?php if($book->getDiscount()>0):?>
          <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
            وفر 10%
          </div>
          <?php endif;?>
          <a href="index.php?page=favourite-control&action=store&bookId=<?= $book->getId(); ?>" class="text-decoration-none">
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </a>
        </div>
        <div class="product__title text-center">
          <a class="text-black text-decoration-none" href="index.php?page=single_product&id=<?= $book->getId(); ?>">
            <?= $book->getName(); ?>
          </a>
        </div>
        <div class="product__author text-center">            <?php
            foreach ($book->getAuthors($db) as $author) {
              echo $author['name'];
            }
            ?></div>
        <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
          <?php if($book->getDiscount()>0):?>
          <span class="product__price product__price--old">
            <?php echo $book->getPrice();?>
          </span>
          <span class="product__price"> <?php echo $book->getPriceAfterDiscount();?> </span>
          <?php else:?>
           <span class="product__price"> <?php echo $book->getPrice();?> </span>
           <?php endif;?>
        </div>
      </div>
    </div>
    <?php endforeach;?>

  </div>
  </div>
</main>