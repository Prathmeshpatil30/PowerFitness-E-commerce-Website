<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            // Get the ID of selected Admin
            $id=$_GET['id'];
             // create a sql query to get details
              $sql="SELECT * FROM tbl_admin WHERE id=$id";
               //execute query
                $res=mysqli_query($conn, $sql);

                     //check query execution
                   if($res==true)
                  {
                        $count=mysqli_num_rows($res);

                           //check admin data
                    if($count==1)
                   {
                    //current details            
                    $row=mysqli_fetch_assoc($res);
        
                                $full_name=$row['full_name']; 
                                 $username=$row['username'];
                    }
                  else
                     {
                        header('location:'.SITEURL.'admin/manage-admin.php');
                     }
                  }
?>
        <form action="" method="POST">
<table class="tbl-30">
<tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>"> 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- hidden will hide the id  when we put the text it display the id -->
<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
</table>
        </form>
    </div>
</div>

<?php
//check button function
if(isset($_POST['submit']))
{
   //getting the value from form to update
   $id=$_POST['id'];
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   
   //create sql query to update admin
   $sql="UPDATE tbl_admin SET
   full_name='$full_name',
   username='$username' 
   WHERE id='$id'
   ";

   //Execute query
$res=mysqli_query($conn, $sql);

if($res==true)
{
    $_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";
    //redirrect to manage page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['update']="<div class='error'>Failed to Delete Admin.</div>";
    //redirrect to manage page
    header('location:'.SITEURL.'admin/manage-admin.php'); 
}

}
?>


<?php include('partials/footer.php'); ?>