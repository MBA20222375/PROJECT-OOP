<?php
  if(!isset($_SESSION['user_id'])){
    header("Location: index.php?page=account");
    die();
  }
?>
<main>
  <div class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>تتبع طلبك</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">تتبع طلبك</span>
      </div>
    </div>
  </div>
<?php

use Oop\Project\Book;
use Oop\Project\Order;

  $order = Order::getOrderById($db, $_GET['order_id']);
  $items = Order::getOrderItemsByOrderId($db, $order['id']);
?>
  <section class="section-container my-5 py-5">
    <p>
      <?php echo "تم تقديم الطلب #{$order['id']} في {$order['created_at']} وهو الآن بحالة {$order['status']}."?>
    </p>
    <section>
      <h2>تفاصيل الطلب</h2>
      <table class="success__table w-100 mb-5">
        <thead>
          <tr class="border-0 bg-danger text-white">
            <th>المنتج</th>
            <th class="d-none d-md-table-cell">الإجمالي</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total = 0.0;
            foreach($items as $item):
              $book = Book::getProductByID($db, $item['book_id']);
              $total += $book->getDiscount()===0? $book->getPrice(): $book->getPriceAfterDiscount();
          ?>
          <tr>
            <td>
              <div>
                <a href="index.php?page=single_product&id=<?= $book->getId(); ?>"><?= $book->getName(); ?></a> <?= " * ".$item['qty']; ?>
              </div>
              <div>
                <span class="fw-bold"><?= $book->getDescription(); ?></span>
              </div>
            </td>
            <td><?= $book->getDiscount()===0? $book->getPrice(): $book->getPriceAfterDiscount(); ?></td>
          </tr>
          <?php endforeach;?>
          <tr>
            <th>المجموع:</th>
            <td class="fw-bolder"><?= $total; ?></td>
          </tr>
          <tr>
            <th>الإجمالي:</th>
            <td class="fw-bold"><?= $total; ?></td>
          </tr>
        </tbody>
      </table>
    </section>
    <section class="mb-5">
      <h2>عنوان الفاتورة</h2>
      <div class="border p-3 rounded-3">
        <p class="mb-1"><?= $order['name'] ?></p>
        <p class="mb-1"><?= $order['address'] ?></p>
        <p class="mb-1"><?= $order['city'] ?></p>
        <p class="mb-1"><?= $order['phone'] ?></p>
        <p class="mb-1"><?= $order['email'] ?></p>
      </div>
    </section>
  </section>
</main>