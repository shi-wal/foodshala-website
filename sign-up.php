<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodShala | Sign Up </title>
    <link rel="stylesheet" href="css/modal.css">
    <style>
        body {
            background: url('images/bg.jpg');
        }
    </style>
</head>

<body>

    <!-- ====Sign Up Modal======= -->

    <div id="signUpModal" class="modals" style="padding-top: 70px;">
        <!-- Modal content -->
        <div class="modalContent">
            <div class="modalHeader">
                <h2>Get Started</h2>
            </div>
            <div class="modalBody">
                <?php
                if (isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
                {
                    echo $_SESSION['add']; //Display the SEssion Message if SEt
                    unset($_SESSION['add']); //Remove Session Message
                }
                ?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="formControl" name="full_name" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="formControl" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="preference">Preference</label>
                        <select id="preference" name="preference" class="formControl" style="width: 96.5%;" required>
                            <option value="select">Select</option>
                            <option value="veg">Vegetarian</option>
                            <option value="non-veg">Non-vegetarian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="formControl" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="formControl" name="password2" placeholder="Confirm Password" required>
                    </div>
                    <input type="submit" name="submit" class="greenButton" value="Sign Up">
                </form>
            </div>
            <div class="modalFooter">
                <h6>Not a customer? <a href="admin/add-admin.php">Sign Up as a Restaurant</a></h6>
            </div>
        </div>
    </div>


</body>

</html>
<?php
//Process the Value from Form and Save it in Database

//Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    //1. Get the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $preference = $_POST['preference'];
    $password = md5($_POST['password']); //Password Encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO tbl_customer SET 
            full_name='$full_name',
            username='$username',
            preference='$preference',
            password='$password'
        ";

    //3. Executing Query and Saving Data into Datbase
    $res = mysqli_query($conn, $sql);

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success text-center'>You signed up Successfully.</div>";
            
        header("location:".SITEURL);
    } else {
        $_SESSION['add'] = "<div class='error text-center'>Failed to Add Admin.</div>";
        //Redirect Page to Add Admin
        header("location:".SITEURL.'sign-up.php');
    }
}

?>