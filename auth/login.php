<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="styles.css">

</head>

<?php

include_once('./authHelper.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    login($email, $password);
}

?>

<body>

    <div class="login_card">

        <center> 
            <div class="center">
                <h1>Login</h1>
                <br><br>
                <form class="login_form" action="./login.php" method="post">
                    <div>
                        <label class="input-label" for="email">Email</label><br>
                        <input class="input-text" name="email" id="email" required placeholder="Enter email" type="email"><br>
                    </div>
                    <div>
                        <label class="input-label" for="password">Password</label><br>
                        <input class="input-text" name="password" id="password" required placeholder="Enter Password" type="password">
                    </div>
                    <br><br>
                    <br><br>
                    <input class="input-text submit" type="submit" value="login">
                </form>
                <a class="redirect-label" href="./signup.php">New Member? Signup here</a>
            </div>
        </center>

    </div>


</body>
</html>