<?php

use Oop\Project\Book;
use Oop\Project\Order;

  if(!isset($_GET['id'])){
    header("Location: index.php?page=home");
    die();
  }
    $order = Order::getOrderById($db, $_GET['id']);
    $orderItems = Order::getOrderItemsById($db, $_GET['id']);

    $id = $_GET['id'];
    $created_at = $order['created_at'];
    $email = $order['email'];
    $name = $order['name'];
    $address = $order['address'];
    $city = $order['city'];
    $phone = $order['phone'];
    $total = 0.0;
?>

<main>
  <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>حسابي</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">حسابي</span>
      </div>
    </div>
  </section>

  <section class="section-container profile my-5 py-5">
    <div class="text-center mb-5">
      <div class="success-gif m-auto">
        <img class="w-100" src="assets/images/success.gif" alt="" />
      </div>
      <h4 class="mb-4">جاري تجهيز طلبك الآن</h4>
      <p class="mb-1">
        سيقوم أحد ممثلي خدمة العملاء بالتواصل معك لتأكيد الطلب
      </p>
      <p>برجاء الرد على الأرقام الغير مسجلة</p>
      <button class="primary-button">تصفح منتجات اخري</button>
    </div>
    <div>
      <p>شكرًا لك. تم استلام طلبك.</p>
      <div class="d-flex flex-wrap gap-2">
        <div class="success__details">
          <p class="success__small">رقم الطلب:</p>
          <p class="fw-bolder"><?= $id; ?></p>
        </div>
        <div class="success__details">
          <p class="success__small">التاريخ:</p>
          <p class="fw-bolder"><?= $created_at; ?></p>
        </div>
        <div class="success__details">
          <p class="success__small">البريد الإلكتروني:</p>
          <p class="fw-bolder"><?= $email; ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="section-container">
    <h2>تفاصيل الطلب</h2>
    <table class="success__table w-100 mb-5">
      <thead>
        <tr class="border-0 bg-main text-white">
          <th>المنتج</th>
          <th class="d-none d-md-table-cell">الإجمالي</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($orderItems as $orderItem):
          $book = Book::getProductByID($db, $orderItem['book_id']);
          $total += $book->getDiscount()===0? $book->getPrice():$book->getPriceAfterDiscount();
        ?>
        <tr>
          <td>
            <div>
              <a href="<?php echo "index.php?page=single_product&id={$orderItem['book_id']}"?>"><?= $book->getName(); ?></a> x 1
            </div>
            <div>
              <span><?= $book->getDescription(); ?></span>
            </div>
          </td>
          <td><?php echo $book->getDiscount()===0? $book->getPrice():$book->getPriceAfterDiscount(); ?></td>
        </tr>
        <?php endforeach;?>

        <tr>
          <th>المجموع:</th>
          <td class="fw-bolder"><?= $total." جنيه" ?></td>
        </tr>
        <tr>
          <th>الإجمالي:</th>
          <td class="fw-bold"><?= $total." جنيه" ?></td>
        </tr>
      </tbody>
    </table>
  </section>
  <section class="section-container mb-5">
    <h2>عنوان الفاتورة</h2>
    <div class="border p-3 rounded-3">
      <p class="mb-1"><?= $name; ?></p>
      <p class="mb-1"><?= $address; ?></p>
      <p class="mb-1"><?= $city; ?></p>
      <p class="mb-1"><?= $phone; ?></p>
      <p class="mb-1"><?= $email; ?></p>
    </div>
  </section>
</main>