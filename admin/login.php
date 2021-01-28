<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/modal.css">
    <style>
        label{
            font-size: 18px;
            float: left;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="login">
        <h1 class="text-center">Welcome Back, Restaurant!</h1><hr>
        <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br>

        <!-- Login Form Starts HEre -->
        <form action="" method="POST" class="text-center">
            <div class="form-group">
                <label> Username: </label><br>
                <input type="text" class="formControl" name="username" placeholder="Enter Username">
            </div><br>
            <div class="form-group">
                <label> Password:</label> <br>
                <input type="password" class="formControl" name="password" placeholder="Enter Password">
            </div>

            <input type="submit" class="greenButton" name="submit" value="Login" class="btn-primary">
            <br>
        </form>
        <!-- Login Form Ends HEre -->

    </div>

</body>

</html>

<?php

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {
    //Process for Login
    //1. Get the Data from Login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. COunt rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //User AVailable and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {
        //User not Available and Login FAil
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>