<?php

use Oop\Project\Book;

$books = Book::getFavouriteBooks($db, $_SESSION['user_id']);
?>


<main>
  <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>المفضلة</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">المفضلة</span>
      </div>
    </div>
  </div>

  <div class="my-5 py-5">
    <section class="section-container favourites">
      <table class="w-100">
        <thead>
          <th class="d-none d-md-table-cell"></th>
          <th class="d-none d-md-table-cell"></th>
          <th class="d-none d-md-table-cell">الاسم</th>
          <th class="d-none d-md-table-cell">السعر</th>
          <th class="d-none d-md-table-cell">تاريخ الاضافه</th>
          <th class="d-table-cell d-md-none">product</th>
        </thead>
        <tbody class="text-center">
          <?php
          foreach ($books as $book):
            $name = $book->getName();
            $price = $book->getPrice();
            $created_at = $book->getCreatedAt();
            $priceAfterDiscount = $book->getPriceAfterDiscount();
            $image = "public/uploads/" . $book->getImage();
            $id = $book->getId();

            ?>
            <tr>
              <td class="d-block d-md-table-cell">
                <span class="favourites__remove m-auto">
                  <i class="fa-solid fa-xmark"></i>
                </span>
              </td>
              <td class="d-block d-md-table-cell favourites__img">
                <img src="<?= $image ?>" alt="" />
              </td>
              <td class="d-block d-md-table-cell">
                <a href="index.php?page=single_product&id=<?= $id; ?>"> <?= $name; ?> </a>
              </td>
              <td class="d-block d-md-table-cell">
                <span class="product__price product__price--old"><?= $price." جنية" ?></span>
                <span class="product__price"><?= $priceAfterDiscount." جنية" ?></span>
              </td>
              <td class="d-block d-md-table-cell"><?= $created_at->format('Y-m-d H:i:s') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </div>
</main>