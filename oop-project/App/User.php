<?php

    namespace Oop\Project;

    use PDO;

    class User{
            private int $id;
            private string $name;
            private string $email;
            private string $password;
            private string $role;
            
            public function __construct(int $id, string $name, string $email, string $password, string $role)
            {
                $this->id = $id;
                $this->name = $name;
                $this->email = $email;
                $this->password = $password;
                $this->role = $role;
            }

            public static function register(PDO $pdo, string $name, string $email, string $password, string $role): User|null{
                $fields = [$name, $email, $password];
                $error = validate_register($pdo, $name, $email, $password);

                if($error){
                    return null;
                }

                $stmt = $pdo->prepare("INSERT INTO users(name, email, password, role) Values (?, ?, ?, ?) ;");      
                $success = $stmt->execute([$name, $email, $password, $role]);
                $id = $pdo->lastInsertId();
                
                if($success){
                    return new User($id, $name, $email, $password, $role);
                }

                return null;
            }

            public static function login(PDO $pdo, string $email, string $password): User|null{
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? ;");
                $success = $stmt->execute([$email]);

                if($success){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($password, $row['password'])){

                        if(session_status() === PHP_SESSION_NONE){
                            session_start();
                        }

                        $_SESSION['user_id'] = $row['id'];

                        return new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role']);
                    }
                }

                return null;
            }

            public static function logout(): void{
                session_destroy();
            }

            public static function updateProfile(PDO $pdo, int $id, string $name, string $email, string $password): bool{
                $stmt = $pdo->prepare("UPDATE users SET name= ?, email= ?, password= ? WHERE id= ?");
                $success = $stmt->execute([$name, $email, $password, $id]);

                if($success){
                    return true;
                }

                return false;
            }

            public function getOrders(PDO $pdo, int $id){
                #هننادي على الميثود اللي هنعملها في كلاس الأوردر
            }

            public static function getFavourites(PDO $pdo, int $user_id): array|null{
                return Favourite::getUserFavourites($pdo, $user_id);
            }

            public static function addFavourite(PDO $pdo, int $user_id, int $book_id):Favourite|null{
                return Favourite::add($pdo, $user_id, $book_id);
            }

            public static function removeFavourite(PDO $pdo, int $user_id, int $book_id){
                return Favourite::remove($pdo, $user_id, $book_id);
            }

            public static function checkEmailExists(PDO $pdo, string $email): bool{
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email= ?");
                $success = $stmt->execute([$email]);

                if($success){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row){
                        return true;
                    }
                }

                return false;
            }

    }


?>