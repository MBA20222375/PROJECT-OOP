<?php

    namespace Oop\Project;

    use PDO;

    class Favourite{
            private int $user_id;
            private int $book_id;
            
            public function __construct(int $user_id, int $book_id)
            {
                $this->user_id = $user_id;
                $this->book_id = $book_id;
            }

            public static function add(PDO $pdo, int $user_id, int $book_id): Favourite|null{
                $stmt = $pdo->prepare("INSERT INTO favourites(user_id, book_id) Values (?, ?) ;");      
                $success = $stmt->execute([$user_id, $book_id]);
            
                if($success){
                    return new Favourite($user_id, $book_id);
                }

                return null;
            }

            public static function remove(PDO $pdo, int $user_id, int $book_id): bool{
                $stmt = $pdo->prepare("DELETE FROM favourites WHERE user_id = ? AND book_id =  ? ;");
                $success = $stmt->execute([$user_id, $book_id]);

                if($success){
                    return true;
                }

                return false;
            }

            public static function getUserFavourites(PDO $pdo, int $user_id): array|null{
                $stmt = $pdo->prepare("SELECT * FROM favourites WHERE user_id = ? ;");      
                $success = $stmt->execute([$user_id]);
            
                if($success){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $user_favourites = [];

                    foreach($rows as $row){
                        $user_favourites[] = $row;
                    }

                    return $user_favourites;
                }

                return null;
            }

    }


?>