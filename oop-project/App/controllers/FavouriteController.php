<?php

namespace Oop\Project\controllers;

use DateTime;
use Oop\Project\Favourite;
use PDO;

class FavouriteController {
    

    public static function handle(PDO $pdo):void{
        if(isset($_SESSION['user_id'], $_GET['bookId'], $_GET['action'])){
            if($_GET['action'] === "store"){
                self::store($pdo);
            }
            elseif($_GET['action'] === "remove"){
                self::remove($pdo);
            }
        }

        else{
            set_messages([['content' => 'Something went wrong!', 'type' => 'danger']]);
            header("Location: index.php?page=home");
            exit;
        }
    }
    public static function store(PDO $pdo): void
    {
        if(isset($_SESSION['user_id'])){
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

        else{
            header("Location: index.php?page=account");
            exit;
        }
    }

    public static function remove(PDO $pdo): void
    {

        if(isset($_SESSION['user_id'])){
            $bookId = trim(htmlspecialchars($_GET['bookId']));
            $userId = isset($_SESSION['user_id'])? $_SESSION['user_id']: null;

            if($userId && $bookId){
                $removed = Favourite::remove(
                    $pdo,
                    $userId,
                    $bookId,
                );

                if($removed){
                    set_messages([['content' => 'Favourite removed successfuly', 'type' => 'danger']]);
                }
            }

            header("Location: index.php?page=favourites");
            exit;
        }

        else{
            header("Location: index.php?page=account");
            exit;
        }
    }


}

FavouriteController::handle($db);
