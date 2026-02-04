<main class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="my-5">

          <form method="post" enctype="multipart/form-data" action="index.php?page=store-product">

            <!-- name -->
            <div class="form-floating mb-3">
              <input class="form-control" name="name" type="text" />
              <label>Book Name</label>
            </div>

            <!-- page_count -->
            <div class="form-floating mb-3">
              <input class="form-control" name="page_count" type="number" />
              <label>Page Count</label>
            </div>

            <!-- price -->
            <div class="form-floating mb-3">
              <input class="form-control" name="price" type="number" step="0.01" />
              <label>Price</label>
            </div>

            <!-- discount -->
            <div class="form-floating mb-3">
              <input class="form-control" name="discount" type="number" step="0.01" value="0" />
              <label>Discount</label>
            </div>

            <!-- description -->
            <div class="form-floating mb-3">
              <textarea class="form-control" name="description" style="height: 120px"></textarea>
              <label>Description</label>
            </div>

            <div class="mb-3">
              <label for="reason"> نوع الكتاب <span class="required">*</span></label>
              <select class="contact__input" id="reason" name="category" required>
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
              Add Book
            </button>

          </form>

        </div>
      </div>
    </div>
  </div>
</main>