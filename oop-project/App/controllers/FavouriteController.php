<?php

namespace Oop\Project\controllers;

use DateTime;
use Oop\Project\Favourite;
use PDO;

class FavouriteController {

    public static function store(PDO $pdo): void
    {
        $bookId = trim(htmlspecialchars($_GET['bookId']));
        $userId = isset($_SESSION['user_id'])? $_SESSION['user_id']: null;

        if($userId && $bookId){
            $Favourite = Favourite::add(
                $pdo,
                $userId,
                $bookId,
                );

            if($Favourite){
                set_messages([['content' => 'Favourite added successfuly', 'type' => 'success']]);
            }
        }

        header("Location: index.php?page=favourites");
        exit;
    }
}

FavouriteController::store($db);
