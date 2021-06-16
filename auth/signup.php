<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>

<?php
include_once('./authHelper.php');

if(isset($_POST['name']) 
    && isset($_POST['email']) 
    && isset($_POST['password']) 
    && isset($_POST['confirm_password'])){

    $user_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    signup($user_name, $email, $password, $confirm_password);
}

?>

<body>

    <div class="signup_card">

        <center> 
            <div class="center">
                <h1>Signup</h1>
                <br><br>
                <form class="login_form" action="./signup.php" method="post">
                    <div>
                        <label class="input-label" for="name">Full Name</label><br>
                        <input class="input-text" name="name" id="name" required placeholder="Enter Full Name" type="name"><br>
                    </div>
                    <div>
                        <label class="input-label" for="email">Email</label><br>
                        <input class="input-text" name="email" id="email" required placeholder="Enter email" type="email"><br>
                    </div>
                    <div>
                        <label class="input-label" for="password">Password</label><br>
                        <input class="input-text" name="password" id="password" required placeholder="Enter Password" type="password"><br>
                    </div>
                    <div>
                        <label class="input-label" for="confirm-password">Confirm Password</label><br>
                        <input class="input-text" name="confirm_password" id="confirm_password" required 
                            placeholder="Confirm Password" type="password">
                    </div>
                    <br><br>
                    <br><br>
                    <input class="input-text submit" type="submit" value="signup">
                </form>
                <a class="redirect-label" href="./login.php">Already Have an Account? Login here</a>
            </div>
        </center>

    </div>


</body>
</html>