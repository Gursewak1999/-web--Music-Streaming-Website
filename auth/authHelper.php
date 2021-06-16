<?php

include_once('../misc/connect.php');
session_start();

function generateUserId() {
    $length =59;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return 'user_'.$randomString;
}

function alert($str){
    echo '<script>
    alert("'.$str.'");
    </script>';
}

function redirectToLogin($str){

    echo '<script>
        var res = confirm("'.$str.'")
        window.location.replace("./login.php");
    </script>';
}
function redirectToSignup($str){

    echo '<script>
        var res = confirm("'.$str.'")
        window.location.replace("./signup.php");
    </script>';
}
function redirectToSignup2(){
    sleep(3);
    header( "location: ./signup.php" ); 
}
function gotoHome(){
    header( "location: ../" ); 
}

function login($email,$password){

    global $conn;

    $password = md5($password);
    $query = "SELECT COUNT(*) FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn,$query);

    if($result){
        $count = mysqli_fetch_row($result)[0];
        if($count>0){
            $query = "SELECT COUNT(*) FROM `users` WHERE `email` = '$email' AND `pass_hash`= '$password'";
            $result = mysqli_query($conn, $query);
            if($result){
                $count=mysqli_fetch_row($result)[0];
				if($count>0){
					$_SESSION['valid'] = true;
					$_SESSION['timeout'] = time();
					$_SESSION['username'] = $email;
					gotoHome();
				}else{
					alert("Wrong Password.");
				}
            }
        }else{
            redirectToSignup("No User Found. Redirecting to Signup");
        }
    }else{
        alert("Unknown Error has Occurred");
    }
}

function signup($user_name, $email, $password, $password2){

    global $conn;

    $id = generateUserId();
    if($password != $password2){
        alert("Passwords doesn't match.");
        echo("here3<br>");
        return;
    }
    $password = md5($password);
    
    $query = "SELECT COUNT(*) FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);
    if($result){
        $count = mysqli_fetch_row($result)[0];
        if($count>0){
            redirectToLogin("User Already Exist. Redirecting to Login");
        }else{
            $query = "INSERT INTO `users`(`id`, `user_name`, `pass_hash`, `email`, `played_history`) VALUES 
            ('$id','$user_name','$password','$email','')";
            $result = mysqli_query($conn, $query);
            if($result){
                redirectToLogin("SignUp Success. Redirecting to Login Page");
            }else{
                alert("Failed to Sign you up.");
            }
        }
    }else {
        alert("An Unkown Error has Occurred");
    }
}

?>