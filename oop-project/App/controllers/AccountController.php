<?php

    use Oop\Project\User;
    use PDO;

    class AccountController{
        public static function handle(PDO $pdo): void{

            $action = $_GET['action'];
            switch($action){
                case "register":
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $name = trim(htmlspecialchars(htmlentities(($_POST['name']))));
                        $email = trim(htmlspecialchars(htmlentities(($_POST['email']))));
                        $password = trim(htmlspecialchars(htmlentities(($_POST['password']))));


                        $user = User::register($pdo, $name, $email, $password, 'user');


                        if($user !== null){
                            set_messages([['content' => "register success!", 'type'=> 'success']]);
                            header("Location: index.php?page=profile");
                            die();
                        }

                        break;
                    }

                case "login":
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $email = trim(htmlspecialchars(htmlentities($_POST('email'))));
                        $password = trim(htmlspecialchars(htmlentities($_POST('password'))));

                        $user = User::login($pdo, $email, $password);

                        if($user !== null){
                            set_messages([['content' => "login success!", 'type'=> 'success']]);
                            header("Location: index.php?page=profile");
                            die();
                        }
                    }
                    break;
            }
            set_messages([['content' => "login Failed!", 'type'=> 'danger']]);
            header("Location: index.php?page=account");
            die();
        }
    }

    AccountController::handle($db);

?>