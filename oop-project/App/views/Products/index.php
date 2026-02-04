<?php
$books = \Oop\Project\Book::getAll($db);
?>
<main class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-12">
        <div class="my-5">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Products Management</h2>
            <a href="index.php?page=create-product" class="btn btn-primary">Add New Product</a>
          </div>

          <?php if (empty($books)): ?>
            <div class="alert alert-info">
              No products found. <a href="index.php?page=create-product">Add your first product</a>.
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Pages</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($books as $book): ?>
                    <tr>
                      <td><?php echo $book->getId(); ?></td>
                      <td>
                        <?php if ($book->getImage()): ?>
                          <img src="public/uploads/books/<?php echo htmlspecialchars($book->getImage()); ?>" 
                               alt="<?php echo htmlspecialchars($book->getName()); ?>" 
                               style="width: 50px; height: 50px; object-fit: cover;">
                        <?php else: ?>
                          <div class="bg-secondary d-inline-block" style="width: 50px; height: 50px;"></div>
                        <?php endif; ?>
                      </td>
                      <td><?php echo htmlspecialchars($book->getName()); ?></td>
                      <td><?php echo $book->getPageCount(); ?></td>
                      <td>$<?php echo number_format($book->getPrice(), 2); ?></td>
                      <td>
                        <?php if ($book->getDiscount() > 0): ?>
                          <span class="badge bg-success">$<?php echo number_format($book->getDiscount(), 2); ?></span>
                        <?php else: ?>
                          <span class="text-muted">None</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php 
                        $desc = $book->getDescription();
                        if ($desc && strlen($desc) > 50) {
                          echo htmlspecialchars(substr($desc, 0, 50)) . '...';
                        } else {
                          echo htmlspecialchars($desc ?: 'No description');
                        }
                        ?>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="index.php?page=edit-product&id=<?php echo $book->getId(); ?>" 
                             class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <a href="index.php?page=delete-product&id=<?php echo $book->getId(); ?>" 
                             class="btn btn-sm btn-outline-danger"
                             onclick="return confirm('Are you sure you want to delete this product?');">
                            <i class="fas fa-trash"></i> Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="mt-3">
              <small class="text-muted">
                Total Products: <?php echo count($books); ?>
              </small>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</main>
