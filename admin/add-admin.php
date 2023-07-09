<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>

        <br><br>

        <?php
if(isset($_SESSION['add']))
{
  echo$_SESSION['add']; //display session msg
  unset($_SESSION['add']);//removed session msg
}
?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" required placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>





<?php include('partials/footer.php');?>
<?php
//process value from Form and save it in database

//Checking the submit button 
if(isset($_POST['submit']))
{
    //button click
  
    //Get the data from form 
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encrypted by md5

    // SQL save data to database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

  //3. Executing query and saving data into database
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 

// check the query is executed or not
if($res==TRUE)
{
    //data inserted
//echo"data inserted";
//create a session variable to display message
$_SESSION['add']="<div class='success'>Admin Added Successfully.</div>";
//Redirect page to manage admin
header("location:".SITEURL.'admin/manage-admin.php');
}
else
{
//failed to insert
//echo"data not inserted";
$_SESSION['add']="Admin Not Added Successfully";
//Redirect page to Add admin
header("location:".SITEURL.'admin/add-admin.php');
}

}
?>
