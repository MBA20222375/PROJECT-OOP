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

  <section class="section-container my-5 py-5">
    <?php if (!empty($orderDetails)): ?>
      <?php 
      $order = $orderDetails[0];
      $orderId = $order['id'];
      $orderDate = date('Y-m-d', strtotime($order['created_at']));
      $orderStatus = $order['status'] ?? 'قيد التنفيذ';
      ?>
      <p>
        تم تقديم الطلب #<?php echo $orderId; ?> في <?php echo $orderDate; ?> وهو الآن بحالة <?php echo $orderStatus; ?>.
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
      <section class="mb-5">
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
    <?php else: ?>
      <p>لم يتم العثور على تفاصيل الطلب.</p>
    <?php endif; ?>
  </section>
</main>