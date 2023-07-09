<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>LOGIN-Productsorder System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body id="login-body">
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo ($_SESSION['login']);
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br>
        <!-- Login form start-->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="LOGIN" class="btn-primary">
            <br><br>
        </form>
        <!-- Login form start-->

        <p class="text-center">Created By - <a href="http://localhost:8080/food-order/">Power Fitness</a></p>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) //checking submit btn
{
    //process for login
    //get data from login form
    //$username=$_POST['username'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    // $password=md5($_POST['password']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //check the sql with username pass exists or not 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'AND password='$password'";

    //Execute Query
    $res = mysqli_query($conn, $sql);

    //count to check wheather user exists ornot
    $count = mysqli_num_rows($res);
    if ($username == null || $password == null) {
        $_SESSION['login'] = "<div class='error text-center'>All fields are required*</div>";
        //dispatch to home 
        header('location:' . SITEURL . 'admin/login.php');
    } else if ($count == 1) {
        //user valid login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;   //to check wheather the user is login or not and logout will unset it     
        //dispatch to home 
        header('location:' . SITEURL . 'admin/');
    } else {
        //user valid login Fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password not match.</div>";
        //dispatch to home 
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>