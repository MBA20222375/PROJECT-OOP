<?php

    session_start();

    function set_messages(array $messages): void{
        if(session_status() === PHP_SESSION_DISABLED){
        }

        foreach($messages as $message){
            $_SESSION['messages'][] = $message;
        }
    }

    function get_messages(): void{
        if(isset($_SESSION['messages'])){
            $messages = $_SESSION['messages'];

            foreach($messages as $message){

                $content = $message["content"];

                $type = $message["type"];

                echo "<div class='alert alert-$type'>$content</div>";
            }
            unset($_SESSION["messages"]);
        }
    }
?>