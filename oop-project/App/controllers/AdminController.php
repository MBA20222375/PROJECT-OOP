<?php

use Oop\Project\User;

    class AdminController{
        public static function handle(PDO $pdo): void{

            $action = $_GET['action'];
            switch($action){
                case "add":

                    if($_SERVER['REQUEST_METHOD'] === 'POST'){

                        $name = trim(htmlspecialchars(htmlentities(($_POST['name']))));
                        $email = trim(htmlspecialchars(htmlentities(($_POST['email']))));
                        $password = trim(htmlspecialchars(htmlentities(($_POST['password']))));


                        $user = User::register($pdo, $name, $email, $password, 'admin');

                        if($user !== null){

                            set_messages([['content' => "Admin add success!", 'type'=> 'success']]);
                            header("Location: index.php?page=admin-add");
                            die();
                        }

                        break;
                    }
            }
        }

    }

    AdminController::handle($db);
?>