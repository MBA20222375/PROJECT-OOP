<?php
  if(!isset($_SESSION['user_id'])){
    header("Location: index.php?page=account");
    die();
  }
use Oop\Project\Cart;

$cart = new Cart();
$cartItems = Cart::getCartItemsWithDetails($cart->getItems(), $db);
$total = Cart::getCartTotal($cart->getItems(), $db);
?>
<main class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-12">
        <div class="my-5">
          <h2 class="mb-4">Shopping Cart</h2>

          <?php if ($cart->isEmpty()): ?>
            <div class="alert alert-info text-center">
              <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
              <h4>Your cart is empty</h4>
              <p class="text-muted">Looks like you haven't added any products to your cart yet.</p>
              <a href="index.php?page=shop" class="btn btn-primary">Continue Shopping</a>
            </div>
          <?php else: ?>
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="mb-0">Cart Items (<?php echo $cart->getTotalItems(); ?>)</h5>
                  </div>
                  <div class="card-body">
                    <form method="post" action="index.php?page=cart-control">
                      <input type="hidden" name="action" value="update_cart">
                      
                      <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item d-flex align-items-center border-bottom pb-3 mb-3">
                          <div class="cart-item-image me-3">
                            <?php if ($item['product']->getImage()):?>
                              <img src="public/uploads/<?php echo $item['product']->getImage(); ?>" 
                                   alt="<?php echo $item['product']->getName(); ?>" 
                                   style="width: 80px; height: 80px; object-fit: cover;" class="rounded">
                            <?php else: ?>
                              <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                   style="width: 80px; height: 80px;">
                                <i class="fas fa-book text-white fa-2x"></i>
                              </div>
                            <?php endif; ?>
                          </div>
                          
                          <div class="cart-item-details flex-grow-1">
                            <h6 class="mb-1">
                              <a href="index.php?page=single_product&id=<?php echo $item['product']->getId(); ?>" 
                                 class="text-decoration-none text-dark">
                                <?php echo $item['product']->getName(); ?>
                              </a>
                            </h6>
                            <p class="text-muted mb-1 small">
                              Pages: <?php echo $item['product']->getPageCount(); ?>
                            </p>
                            <div class="d-flex align-items-center">
                              <?php if ($item['discount'] > 0): ?>
                                <span class="text-decoration-line-through text-muted me-2">
                                  $<?php echo number_format($item['price'], 2); ?>
                                </span>
                                <span class="fw-bold text-success">
                                  $<?php echo number_format($item['priceAfterDiscount'], 2); ?>
                                </span>
                              <?php else: ?>
                                <span class="fw-bold">
                                  $<?php echo number_format($item['priceAfterDiscount'], 2); ?>
                                </span>
                              <?php endif; ?>
                            </div>
                          </div>
                          
                          <div class="cart-item-quantity mx-3">
                            <div class="input-group" style="width: 120px;">
                              <input type="number" name="quantities[<?php echo $item['product']->getId(); ?>]" 
                                     value="<?php echo $item['quantity']; ?>" 
                                     min="1" max="99" class="form-control text-center">
                            </div>
                          </div>
                          
                          <div class="cart-item-subtotal text-end">
                            <div class="fw-bold">
                              $<?php echo number_format($item['subtotal'], 2); ?>
                            </div>
                          </div>
                          
                          <div class="cart-item-remove ms-3">
                            <a href="index.php?page=cart-control&action=remove&product_id=<?php echo $item['product']->getId(); ?>" 
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Remove this item from cart?');">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </div>
                      <?php endforeach; ?>
                      
                      <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                          <a href="index.php?page=cart-control&action=clear" 
                             class="btn btn-outline-danger"
                             onclick="return confirm('Clear entire cart?');">
                            <i class="fas fa-trash"></i> Clear Cart
                          </a>
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-sync"></i> Update Cart
                          </button>
                          <a href="index.php?page=shop" class="btn btn-outline-secondary">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header bg-white">
                    <h5 class="mb-0">Order Summary</h5>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <span>Subtotal:</span>
                      <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                      <span>Shipping:</span>
                      <span>Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                      <span>Tax:</span>
                      <span>$0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                      <h6>Total:</h6>
                      <h5 class="text-primary">$<?php echo number_format($total, 2); ?></h5>
                    </div>
                    
                    <a href="index.php?page=checkout" class="btn btn-primary w-100 mb-2">
                      <i class="fas fa-credit-card"></i> Proceed to Checkout
                    </a>
                    
                    <a href="index.php?page=shop" class="btn btn-outline-secondary w-100">
                      <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</main>
