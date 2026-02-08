<?php

use Oop\Project\Book;
class ProductController
{


    public static function handle(PDO $pdo): void
    {
        if (
            isset($_SESSION['user_id'], $_GET['action'], $_SESSION['role']) &&
            $_SESSION['role'] === 'admin'
        ) {
            if ($_GET['action'] === "create") {
                self::store($pdo);
            }
                //  elseif ($_GET['action'] === "update") {
            //     self::update($pdo);
            // } 
            elseif ($_GET['action'] === "remove") {
                self::remove($pdo);
            }
        } else {
            set_messages([['content' => 'Something went wrong!', 'type' => 'danger']]);
            header("Location: index.php?page=home");
            exit;
        }
    }
    public static function store(PDO $pdo): void
    {
        $name = $_POST['name'];
        $pageCount = (int) $_POST['page_count'];
        $price = (float) $_POST['price'];
        $discount = (float) ($_POST['discount']);
        $description = $_POST['description'];

        $author = $_POST['author'];
        $category = $_POST['category'];
        //$tagIds      = $_POST['tag'];

        $image = $_FILES['image'] ?? null;

        Book::createWithRelations(
            $pdo,
            $name,
            $pageCount,
            $price,
            $discount,
            $description,
            $image,
            $author,
            $category
        );

        header("Location: index.php?page=create-product");
        exit;
    }

    public static function remove(PDO $pdo): void
    {
        $success = Book::deleteBook($pdo, $_GET['id']);

        if($success){
            set_messages([['content' => 'Product Deleted!', 'type' => 'danger']]);
            header("Location: index.php?page=home");
            exit;
        }

        set_messages([['content' => 'Something went wrong!', 'type' => 'danger']]);
            header("Location: index.php?page=edit-product&action=remove");
            exit;
    }


}

ProductController::handle($db);
