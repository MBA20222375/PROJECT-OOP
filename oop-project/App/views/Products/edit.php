<?php

use Oop\Project\Book;
  if(!isset($_SESSION['user_id'], $_SESSION['role'])&& $_SESSION['role']==="admin"){
    header("Location: index.php?page=account");
    die();
  }

$book = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book = Book::find($db, $id);
}
?>
<main class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="my-5">

          <form method="post" enctype="multipart/form-data" action="index.php?page=update-product&id=<?php echo $book ? $book->getId() : ''; ?>">
            <input type="hidden" name="id" value="<?php echo $book ? $book->getId() : ''; ?>">

            <!-- name -->
            <div class="form-floating mb-3">
              <input class="form-control" name="name" type="text" value="<?php echo $book ? htmlspecialchars($book->getName()) : ''; ?>" required />
              <label>Book Name</label>
            </div>

            <!-- page_count -->
            <div class="form-floating mb-3">
              <input class="form-control" name="page_count" type="number" value="<?php echo $book ? $book->getPageCount() : ''; ?>" required />
              <label>Page Count</label>
            </div>

            <!-- price -->
            <div class="form-floating mb-3">
              <input class="form-control" name="price" type="number" step="0.01" value="<?php echo $book ? $book->getPrice() : ''; ?>" required />
              <label>Price</label>
            </div>

            <!-- discount -->
            <div class="form-floating mb-3">
              <input class="form-control" name="discount" type="number" step="0.01" value="<?php echo $book ? $book->getDiscount() : '0'; ?>" />
              <label>Discount</label>
            </div>

            <!-- description -->
            <div class="form-floating mb-3">
              <textarea class="form-control" name="description" style="height: 120px"><?php echo $book ? htmlspecialchars($book->getDescription()) : ''; ?></textarea>
              <label>Description</label>
            </div>

            <div class="mb-3">
              <label for="reason"> نوع الكتاب <span class="required">*</span></label>
              <select class="contact__input" id="reason" name="reason" required>
                <option value="">- اضغط هنا اختيار نوع الكتاب -</option>
                <option value="اللغة العربية">كتاب بالغة العربيه</option>
                <option value="اللغة الانجليزيه">كتاب بالغة الانجليزيه</option>
              </select>
            </div>
            <!-- Author -->
             <div class="form-floating mb-3">
              <input class="form-control" name="author" type="text" />
              <label>Author</label>
            </div>

            <!-- image -->
            <div class="form-floating mb-3">
              <input class="form-control" name="image" type="file" />
              <label>Image</label>
            </div>

            <button class="btn btn-primary text-uppercase mt-4" type="submit">
              <?php echo $book ? 'Update Book' : 'Add Book'; ?>
            </button>
            <?php if ($book): ?>
            <a href="index.php?page=delete-product&id=<?php echo $book->getId(); ?>" class="btn btn-danger text-uppercase mt-4" onclick="return confirm('Are you sure you want to delete this book?');">
              Delete Book
            </a>
            <?php endif; ?>

          </form>

        </div>
      </div>
    </div>
  </div>
</main>