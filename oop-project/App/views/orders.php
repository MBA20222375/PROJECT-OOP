<main>
  <section class="page-top d-flex justify-content-center align-items-center flex-column text-center ">
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

  <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
    <div class="profile__right">
      <div class="profile__user mb-3 d-flex gap-3 align-items-center">
        <div class="profile__user-img rounded-circle overflow-hidden">
          <img class="w-100" src="assets/images/user.png" alt="">
        </div>
        <div class="profile__user-name">moamenyt</div>
      </div>
      <ul class="profile__tabs list-unstyled ps-3">
        <li class="profile__tab">
          <a class="py-2 px-3 text-black text-decoration-none" href="index.php?page=profile">لوحة التحكم</a>
        </li>
        <li class="profile__tab active">
          <a class="py-2 px-3 text-black text-decoration-none" href="index.php?page=orders">الطلبات</a>
        </li>
        <li class="profile__tab">
          <a class="py-2 px-3 text-black text-decoration-none" href="index.php?page=account_details">تفاصيل الحساب</a>
        </li>
        <li class="profile__tab">
          <a class="py-2 px-3 text-black text-decoration-none" href="index.php?page=favourites">المفضلة</a>
        </li>
        <li class="profile__tab">
          <a class="py-2 px-3 text-black text-decoration-none" href="index.php?page=logout">تسجيل الخروج</a>
        </li>
      </ul>
    </div>
    <div class="profile__left mt-4 mt-md-0 w-100">
      <div class="profile__tab-content orders active">
        <?php

use Oop\Project\Order;

        $order = new Order($db);
        $userOrders = $order->getUserOrders($_SESSION['user_id']);

        if (empty($userOrders)): 
        ?>
          <div class="orders__none d-flex justify-content-between align-items-center py-3 px-4">
            <p class="m-0">لم يتم تنفيذ اي طلب بعد.</p>
            <button class="primary-button">تصفح المنتجات</button>
          </div>
        <?php else: ?>
          <table class="orders__table w-100">
            <thead>
              <th class="d-none d-md-table-cell">الطلب</th>
              <th class="d-none d-md-table-cell">التاريخ</th>
              <th class="d-none d-md-table-cell">الحالة</th>
              <th class="d-none d-md-table-cell">الاجمالي</th>
              <th class="d-none d-md-table-cell">اجراءات</th>
            </thead>
            <tbody>
              <?php 
              $processedOrders = [];
              foreach ($userOrders as $orderItem): 
                $orderId = $orderItem['id'];
                $total = Order::getOrderTotal($db, $orderId);
                if (!isset($processedOrders[$orderId])):
                  $processedOrders[$orderId] = true;
              ?>
              <tr class="order__item">
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الطلب:</div>
                  <div><a href="index.php?page=order_details&order_id=<?php echo $orderId; ?>">#<?php echo $orderId; ?></a></div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">التاريخ:</div>
                  <div><?php echo date('Y-m-d', strtotime($orderItem['created_at'])); ?></div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الحالة:</div>
                  <div><?php echo $orderItem['status'] ?? 'قيد التنفيذ'; ?></div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الاجمالي:</div>
                  <div><?php echo $total['total']; ?> جنيه</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">اجراءات:</div>
                  <div><a class="primary-button" href="index.php?page=order_details&order_id=<?php echo $orderId; ?>">عرض</a></div>
                </td>
              </tr>
              <?php 
                endif;
              endforeach; 
              ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>