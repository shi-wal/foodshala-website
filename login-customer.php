<?php include('config/constants.php'); ?>

<html>

<head>
    <title>FoodShala | Login</title>
    <link rel="stylesheet" href="css/modal.css">
    <style>
        body {
            background: url('images/bg.jpg');
        }
    </style>
</head>

<body>
    <!-- ====Sign In Modal======= -->

    <div id="signInModal" class="modals">
        <!-- Modal content -->
        <div class="modalContent">
            <div class="modalHeader">
                <h2>Welcome Back!</h2>
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
            </div>
           
            <div class="modalBody">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="formControl" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="formControl" name="password" placeholder="Enter Password" required>
                    </div>
                    <input type="submit" name="submit" class="greenButton" value="Sign In">
                </form>
            </div>
            <div class="modalFooter">
                <h6>Not a customer? <a href="<?php echo SITEURL; ?>admin/login.php">Log in as a Restaurant</a></h6>
            </div>
        </div>
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
    $sql = "SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. COunt rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //User AVailable and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['users'] = $username; //TO check whether the user is logged in or not and logout will unset it
        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL);
    } else {
        //User not Available and Login FAil
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'login-customer.php');
    }
}

?>