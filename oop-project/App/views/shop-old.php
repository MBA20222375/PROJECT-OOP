<?php
$books = \Oop\Project\Book::getAll($db);
$cart = new \Oop\Project\Cart();
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
    <div class="shop__products col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="m-0">عرض <?php echo count($books); ?> من أصل <?php echo count($books); ?> نتيجة</p>
        <form action="">
          <div class="filter__search position-relative">
            <input class="w-100 py-1 ps-2" type="text" placeholder="بتدور علي ايه؟" />
            <div
              class="filter__search-icon position-absolute h-100 top-0 end-0 p-2 d-flex justify-content-center align-items-center">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
          </div>
        </form>
      </div>
      <div class="row products__list">
        <?php foreach ($books as $book): ?>
          <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
            <div class="product__header mb-3">
              <a href="index.php?page=single_product&id=<?php echo $book->getId(); ?>">
                <div class="product__img-cont">
                  <?php if ($book->getImage()): ?>
                    <img class="product__img w-100 h-100 object-fit-cover" 
                         src="public/uploads/books/<?php echo htmlspecialchars($book->getImage()); ?>"
                         alt="<?php echo htmlspecialchars($book->getName()); ?>" />
                  <?php else: ?>
                    <img class="product__img w-100 h-100 object-fit-cover" 
                         src="App/assets/images/product-1.webp"
                         alt="<?php echo htmlspecialchars($book->getName()); ?>" />
                  <?php endif; ?>
                </div>
              </a>
              <?php if ($book->getDiscount() > 0): ?>
                <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
                  وفر <?php echo round((($book->getPrice() - $book->getDiscount()) / $book->getPrice()) * 100); ?>%
                </div>
              <?php endif; ?>
              <div
                class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
                <i class="fa-regular fa-heart"></i>
              </div>
            </div>
            <div class="product__title text-center">
              <a class="text-black text-decoration-none" href="index.php?page=single_product&id=<?php echo $book->getId(); ?>">
                <?php echo htmlspecialchars($book->getName()); ?>
              </a>
            </div>
            <div class="product__author text-center">
              <?php echo htmlspecialchars($book->getDescription() ?: 'Unknown Author'); ?>
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Modern Full-Stack Development
            </a>
          </div>
          <div class="product__author text-center">Frank Zammetti</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              450.00 جنيه
            </span>
            <span class="product__price"> 250.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-3.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              C# 10 in a Nutshell
            </a>
          </div>
          <div class="product__author text-center">Joseph Albahari</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              650.00 جنيه
            </span>
            <span class="product__price"> 450.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="APP/assets/images/product-4.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Algorithms عربي
            </a>
          </div>
          <div class="product__author text-center">Aditya Y. Bhargava</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              359.00 جنيه
            </span>
            <span class="product__price"> 249.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="APP/assets/images/product-5.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Head-First Design Patterns
            </a>
          </div>
          <div class="product__author text-center">
            Eric Freeman & Elisabeth Robson
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="APP/assets/images/product-1.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Flutter Apprentice
            </a>
          </div>
          <div class="product__author text-center">Mike Katz</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="APP/assets/images/product-2.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Modern Full-Stack Development
            </a>
          </div>
          <div class="product__author text-center">Frank Zammetti</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              450.00 جنيه
            </span>
            <span class="product__price"> 250.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="APP/assets/images/product-3.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              C# 10 in a Nutshell
            </a>
          </div>
          <div class="product__author text-center">Joseph Albahari</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              650.00 جنيه
            </span>
            <span class="product__price"> 450.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-4.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Algorithms عربي
            </a>
          </div>
          <div class="product__author text-center">Aditya Y. Bhargava</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              359.00 جنيه
            </span>
            <span class="product__price"> 249.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-5.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Head-First Design Patterns
            </a>
          </div>
          <div class="product__author text-center">
            Eric Freeman & Elisabeth Robson
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-1.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Flutter Apprentice
            </a>
          </div>
          <div class="product__author text-center">Mike Katz</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-2.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Modern Full-Stack Development
            </a>
          </div>
          <div class="product__author text-center">Frank Zammetti</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              450.00 جنيه
            </span>
            <span class="product__price"> 250.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-3.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              C# 10 in a Nutshell
            </a>
          </div>
          <div class="product__author text-center">Joseph Albahari</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              650.00 جنيه
            </span>
            <span class="product__price"> 450.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-4.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Algorithms عربي
            </a>
          </div>
          <div class="product__author text-center">Aditya Y. Bhargava</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              359.00 جنيه
            </span>
            <span class="product__price"> 249.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-5.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Head-First Design Patterns
            </a>
          </div>
          <div class="product__author text-center">
            Eric Freeman & Elisabeth Robson
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-1.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="single-product.html">
              Flutter Apprentice
            </a>
          </div>
          <div class="product__author text-center">Mike Katz</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-2.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Modern Full-Stack Development
            </a>
          </div>
          <div class="product__author text-center">Frank Zammetti</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              450.00 جنيه
            </span>
            <span class="product__price"> 250.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-3.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              C# 10 in a Nutshell
            </a>
          </div>
          <div class="product__author text-center">Joseph Albahari</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              650.00 جنيه
            </span>
            <span class="product__price"> 450.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-4.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Algorithms عربي
            </a>
          </div>
          <div class="product__author text-center">Aditya Y. Bhargava</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              359.00 جنيه
            </span>
            <span class="product__price"> 249.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-5.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Head-First Design Patterns
            </a>
          </div>
          <div class="product__author text-center">
            Eric Freeman & Elisabeth Robson
          </div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-1.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="single-product.html">
              Flutter Apprentice
            </a>
          </div>
          <div class="product__author text-center">Mike Katz</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              550.00 جنيه
            </span>
            <span class="product__price"> 350.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-2.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Modern Full-Stack Development
            </a>
          </div>
          <div class="product__author text-center">Frank Zammetti</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              450.00 جنيه
            </span>
            <span class="product__price"> 250.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-3.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              C# 10 in a Nutshell
            </a>
          </div>
          <div class="product__author text-center">Joseph Albahari</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              650.00 جنيه
            </span>
            <span class="product__price"> 450.00 جنيه </span>
          </div>
        </div>
        <div class="products__item col-6 col-md-4 col-lg-3 mb-5">
          <div class="product__header mb-3">
            <a href="index.php?page=single-product">
              <div class="product__img-cont">
                <img class="product__img w-100 h-100 object-fit-cover" src="App/assets/images/product-4.webp"
                  data-id="white" />
              </div>
            </a>
            <div class="product__sale position-absolute top-0 start-0 m-1 px-2 py-1 rounded-1 text-white">
              وفر 10%
            </div>
            <div
              class="product__favourite position-absolute top-0 end-0 m-1 rounded-circle d-flex justify-content-center align-items-center bg-white">
              <i class="fa-regular fa-heart"></i>
            </div>
          </div>
          <div class="product__title text-center">
            <a class="text-black text-decoration-none" href="index.php?page=single-product">
              Algorithms عربي
            </a>
          </div>
          <div class="product__author text-center">Aditya Y. Bhargava</div>
          <div class="product__price text-center d-flex gap-2 justify-content-center flex-wrap">
            <span class="product__price product__price--old">
              359.00 جنيه
            </span>
            <span class="product__price"> 249.00 جنيه </span>
          </div>
        </div>
      </div>

      <div class="products__pagination mb-5 d-flex justify-content-center gap-2">
        <span class="pagination__btn rounded-1 pagination__btn--next"><i
            class="fa-solid fa-arrow-right-long"></i></span>
        <span class="pagination__btn rounded-1 active">1</span>
        <span class="pagination__btn rounded-1">2</span>
        <span class="pagination__btn rounded-1">3</span>
        <span class="pagination__btn rounded-1">4</span>
        <span class="pagination__btn rounded-1 pagination__btn--prev"><i class="fa-solid fa-arrow-left-long"></i></span>
      </div>
    </div>
  </div>
</main>