<?php

include('../config/constants.php');

?>


<html>

<head>
    <title>FoodShala | signUp</title>


    <link rel="stylesheet" href="../css/modal.css">
    <style>
        * {
            /* margin: 0;
            padding: 0; */
            font-family: Arial, Helvetica, sans-serif;
        }

        .main-content {
            height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h2 {
            color: brown;
            margin: 0 0 30px 0;
        }
        td{
            font-size: 18px;
            font-weight: 700;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="main-content">
        <h1>Get Started with FoodShala</h1>
        <h2>As Restaurant</h2>
        <div class="wrapper text-center">


            <br><br>

            <?php
            if (isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" class="formControl" placeholder="Enter Your Name">
                        </td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" class="formControl" placeholder="Your Username">
                        </td>
                    </tr>
                    <tr>
                        <td>Location: </td>
                        <td>
                            <input type="text" name="location" class="formControl" placeholder="Location of Restaurant">
                        </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" class="formControl" placeholder="Your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" class="greenButton" value="Add Restaurant" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>


        </div>
    </div>




    <?php
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if (isset($_POST['submit'])) {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql);

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if ($res == TRUE) {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success text-center'>Restaurant Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:" . SITEURL);
        } else {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error text-center'>Failed to Add Restaurant.</div>";
            //Redirect Page to Add Admin
            header("location:" . SITEURL . 'admin/add-admin.php');
        }
    }

    ?>