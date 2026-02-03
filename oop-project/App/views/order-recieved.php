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
    <?php if (!empty($orderDetails)): ?>
      <?php 
      $order = $orderDetails[0];
      $orderId = $order['id'];
      $orderDate = date('Y-m-d', strtotime($order['created_at']));
      ?>
      <div>
        <p>شكرًا لك. تم استلام طلبك.</p>
        <div class="d-flex flex-wrap gap-2">
          <div class="success__details">
            <p class="success__small">رقم الطلب:</p>
            <p class="fw-bolder"><?php echo $orderId; ?></p>
          </div>
          <div class="success__details">
            <p class="success__small">التاريخ:</p>
            <p class="fw-bolder"><?php echo $orderDate; ?></p>
          </div>
          <div class="success__details">
            <p class="success__small">البريد الإلكتروني:</p>
            <p class="fw-bolder"><?php echo $order['customer_email']; ?></p>
          </div>
          <div class="success__details">
            <p class="success__small">الإجمالي:</p>
            <p class="fw-bolder"><?php echo number_format($order['total_amount'], 2); ?> جنيه</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>

  <?php if (!empty($orderDetails)): ?>
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
        <?php 
        $subtotal = 0;
        foreach ($orderDetails as $item): 
          $itemTotal = $item['quantity'] * $item['item_price'];
          $subtotal += $itemTotal;
        ?>
        <tr>
          <td>
            <div>
              <a href="index.php?page=single_product&id=<?php echo $item['product_id']; ?>">
                <?php echo $item['product_name']; ?>
              </a> x <?php echo $item['quantity']; ?>
            </div>
            <?php if (!empty($item['color'])): ?>
            <div>
              <span class="fw-bold">اللون:</span>
              <span><?php echo $item['color']; ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($item['size'])): ?>
            <div>
              <span class="fw-bold">المقاس:</span>
              <span><?php echo $item['size']; ?></span>
            </div>
            <?php endif; ?>
          </td>
          <td><?php echo number_format($itemTotal, 2); ?> جنيه</td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <th>المجموع:</th>
          <td class="fw-bolder"><?php echo number_format($subtotal, 2); ?> جنيه</td>
        </tr>
        <tr>
          <th>الإجمالي:</th>
          <td class="fw-bold"><?php echo number_format($order['total_amount'], 2); ?> جنيه</td>
        </tr>
      </tbody>
    </table>
  </section>
  <?php endif; ?>
  
  <?php if (!empty($orderDetails)): ?>
  <section class="section-container mb-5">
    <h2>عنوان الفاتورة</h2>
    <div class="border p-3 rounded-3">
      <p class="mb-1"><?php echo $order['customer_name']; ?></p>
      <?php if (!empty($order['customer_address'])): ?>
      <p class="mb-1"><?php echo $order['customer_address']; ?></p>
      <?php endif; ?>
      <?php if (!empty($order['customer_phone'])): ?>
      <p class="mb-1"><?php echo $order['customer_phone']; ?></p>
      <?php endif; ?>
      <?php if (!empty($order['customer_email'])): ?>
      <p class="mb-1"><?php echo $order['customer_email']; ?></p>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>
</main>