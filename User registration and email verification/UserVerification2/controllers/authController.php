<?php
session_start();

require 'config/db.php';

$errors = array();
$username="";
$email="";

//if user click on the sign up button

if(isset($_POST['signupbutton'])){
    $username= $_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $passwordConfirm= $_POST['passwordConfirm'];

    //validation

    if(empty($username)){
        $errors['username']= "Username required";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']= "invalid Email";
    }
    if(empty($email)){
        $errors['email']= "Email required";
    }
    if(empty($password)){
        $errors['password']= "Password required";
    }
    if($password !== $passwordConfirm){
        $errors['password']= "Password Dont Match";
    }

    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt ->bind_param('s', $email);
    $stmt ->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if($userCount > 0){
        $errors['email']= "Email already exist";
    }

    if(count($errors) === 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;

        $sql = "INSERT INTO users (username, email, verified, token, password) VALUES(?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt ->bind_param('ssbss', $username, $email, $verified, $token, $password);

        if ($stmt ->execute()){
            //login user

            $user_id = $conn->insert_id;
            $_SESSION['id']= $user_id; 
            $_SESSION['username'] = $username;
            $_SESSION['email']= $email;
            $_SESSION['verified']= $verified;

            //flash message

            $_SESSION['message']= "you are now logged in!";
            $_SESSION['alert-class'] = "alert-succes";
            header('location: index.php');
            exit();

        }else{
            $errors['db_error']= "Database error: faield to register";
        }
    }
    
}

//if user click on login button 


if(isset($_POST['loginbutton'])){
    $username= $_POST['username'];
    $password= $_POST['password'];

    //validation

    if(empty($username)){
        $errors['username']= "Username required";
    }
    if(empty($password)){
        $errors['password']= "Password required";
    }

    if(count($errors) === 0){
        $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt ->bind_param('ss', $username, $username);
        $stmt ->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if(password_verify($password, $user['password'])){
            //login success
    
                $_SESSION['id']= $user['id']; 
                $_SESSION['username'] = $user['username']; 
                $_SESSION['email']= $user['email']; 
                $_SESSION['verified']= $user['verified']; 
    
                //flash message
    
                $_SESSION['message']= "you are now logged in!";
                $_SESSION['alert-class'] = "alert-succes";
                header('location: index.php');
                exit();
    
    
    
        }else{
            $errors['login-fail']= "Wrong Credntials";
        }
    }
    }

    // logout user

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['verified']);
        header('location: login.php');
        exit();
    }