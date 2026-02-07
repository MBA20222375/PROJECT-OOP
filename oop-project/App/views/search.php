<div class="container mt-5 pt-5">

    <h4 class="mb-4">
        نتائج البحث عن: 
        <span class="text-primary">
            <?= htmlspecialchars($q) ?>
        </span>
    </h4>

    <?php if (empty($books)): ?>
        <div class="alert alert-warning">
            لا توجد نتائج مطابقة 🔍
        </div>
    <?php else: ?>
        <div class="row">

            <?php foreach ($books as $book):?>
                
                <div class="col-md-3 mb-4">
                    <div class="card h-100">

                        <img
                            src="public/uploads/<?= $book->getImage(); ?>"
                            class="card-img-top"
                            alt="<?= $book->getName(); ?>"
                        >

                        <div class="card-body">
                            <h6 class="card-title">
                                <?= $book->getName(); ?>
                            </h6>

                            <p class="card-text">
                                السعر:
                                <strong><?= $book->getPrice(); ?></strong>
                            </p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</div>
