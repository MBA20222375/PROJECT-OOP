<?php

    use Oop\Project\User;
    function validate_required($fields) {
        foreach($fields as $key => $value) {

            $name = ucfirst($key);

            if($value == "") {

                return "$name is required!";
            }
        }

        return null;
    }

    function validate_name($name){
        return (strlen($name) < 3) ? "Name must be at least 3 characters!": null;
    }

    function validate_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL)? null: "Invalid email!";
    }

    function validate_password($password){
        if(strlen($password) < 8){

            return "Password must be at least 8 characters!";
        }

        if(!preg_match("/[0-9]/", $password)){

            return "Password must contains at least 1 numeric digit!";
        }

        if(!preg_match("/[a-z]/", $password)){

            return "Password must contains at least 1 lowercase character!";
        }

        if(!preg_match("/[A-Z]/", $password)){

            return "Password must contains at least 1 uppercase character!";
        }

        return null;
    }


    function validate_register(PDO $pdo, string $name, string $email, string $password): string|null{
        $fields = [
            "name"=> $name,
            "email"=> $email,
            "password"=> $password,
        ];

        if($error = validate_required($fields)){

            return $error;
        }

        if($error = validate_name($name)){

            return $error;
        }

        if($error = validate_email($email)){

            return $error;
        }

        if($error = validate_password($password)){

            return $error;
        }

        if(User::checkEmailExists($pdo, $email)){
            return 'Email Already Exists!';
        }
        return null;
    }
?>