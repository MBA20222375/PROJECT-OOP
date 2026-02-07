<?php

use Oop\Project\Cart;
  $cart = new Cart();
  $items = $cart::getCartItemsWithDetails($cart->getItems(), $db);
  $total = Cart::getCartTotal($cart->getItems(), $db);
  $totalDiscount = Cart::getCartTotalDiscount($cart->getItems(), $db);
?>

<main>
  <section class="page-top d-flex justify-content-center align-items-center flex-column text-center">
    <div class="page-top__overlay"></div>
    <div class="position-relative">
      <div class="page-top__title mb-3">
        <h2>إتمام الطلب</h2>
      </div>
      <div class="page-top__breadcrumb">
        <a class="text-gray" href="index.php?page=home">الرئيسية</a> /
        <span class="text-gray">إتمام الطلب</span>
      </div>
    </div>
  </section>

  <section class="section-container my-5 py-5 d-lg-flex">
    <div class="checkout__form-cont w-50 px-3 mb-5">
      <h4>الفاتورة </h4>
      <form class="checkout__form" action="index.php?page=order-control&action=purchase" method="post">
        <div class="d-flex gap-3 mb-3">
          <div class="w-50">
            <label for="first-name">الاسم الأول <span class="required">*</span></label>
            <input class="form__input" type="text" name="first_name" />
          </div>
          <div class="w-50">
            <label for="last-name">الاسم الأخير <span class="required">*</span></label>
            <input class="form__input" type="text"  name="last_name" />
          </div>
        </div>
        <div class="mb-3">
          <label for="last-name">المدينة / المحافظة<span class="required">*</span></label>
          <select class="form__input bg-transparent" type="text" name="city">
            <option value="القاهرة">القاهرة</option>
            <option value="اسكندرية">اسكندرية</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="address">العنوان بالكامل ( المنطقة -الشارع - رقم المنزل)<span class="required">*</span></label>
          <input class="form__input" placeholder="رقم المنزل او الشارع / الحي" type="text" name="address" />
        </div>
        <div class="mb-3">
          <label for="phone">رقم الهاتف<span class="required">*</span></label>
          <input class="form__input" type="text" name="phone" />
        </div>
        <div class="mb-3">
          <label for="email">البريد الإلكتروني<span class="required">*</span></label>
          <input class="form__input" type="text" name="email" />
        </div>
        <div class="mb-3">
          <h2>معلومات اضافية</h2>
          <label for="notes">ملاحظات الطلب<span class="required">*</span></label>
          <textarea class="form__input" placeholder="ملاحظات حول الطلب, مثال: ملحوظة خاصة بتسليم الطلب." type="text" name="additional_information"></textarea>
        </div>
        <button class="primary-button w-100 py-2">تاكيد الطلب</button>
      </form>
    </div>
    <div class="checkout__order-details-cont w-50 px-3">
      <h4>طلبك</h4>
      <div>
        <table class="w-100 checkout__table">
          <thead>
            <tr class="border-0">
              <th>المنتج</th>
              <th>المجموع</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($items as $item):?>
            <tr>
              <td> <?php echo $item['quantity']." * ".$item['product']->getName();?></td>
              <td>
                <div class="product__price text-center d-flex gap-2 flex-wrap">
                  <?php if($item['product']->getDiscount()>0):?>
                  <span class="product__price product__price--old">
                    <?php echo $item['product']->getPrice();?>
                  </span>
                  <span class="product__price"> <?php echo $item['product']->getPriceAfterDiscount();?></span>

                    <?php else:?>
                      <span class="product__price ">
                    <?php echo $item['product']->getPrice();?>
                  </span>
                  <?php endif;?>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
            <tr>
              <th>المجموع</th>
              <td class="fw-bolder"><?= $total; ?> جنيه</td>
            </tr>
            <tr class="bg-green">
              <th>قمت بتوفير</th>
              <td class="fw-bolder"><?= $totalDiscount; ?> جنيه</td>
            </tr>
            <tr>
              <th>الإجمالي</th>
              <td class="fw-bolder"><?= $total; ?> جنيه</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="checkout__payment py-3 px-4 mb-3">
        <p class="m-0 fw-bolder">الدفع نقدا عند الاستلام</p>
      </div>

      <p>الدفع عند التسليم مباشرة.</p>
    </div>
  </section>
</main>