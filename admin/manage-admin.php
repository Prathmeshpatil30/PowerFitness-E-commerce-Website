<?php include('partials/menu.php');?>
  
  
  <!-- Main Content Section Starts-->
  <div class="main-content">
  <div class="wrapper">
  <h1>Manage Admin </h1>
<br />

<?php
if(isset($_SESSION['add']))
{
  echo$_SESSION['add']; //display session msg
  unset($_SESSION['add']);//removed session msg
}

if(isset($_SESSION['delete']))
{
  echo $_SESSION['delete'];
  unset($_SESSION['delete']);
}

if(isset($_SESSION['update']))
{
  echo $_SESSION['update'];
  unset($_SESSION['update']);
}

if(isset($_SESSION['user-not-found']))
{
  echo $_SESSION['user-not-found'];
  unset($_SESSION['user-not-found']);
}

if(isset($_SESSION['pwd-not-match']))
{
  echo $_SESSION['pwd-not-match'];
  unset($_SESSION['pwd-not-match']);
}

if(isset($_SESSION['change-pwd']))
{
  echo $_SESSION['change-pwd'];
  unset($_SESSION['change-pwd']);
}

?>
<br><br><br>

<!-- button to add admin -->
<a href="add-admin.php" class="btn-primary">Add Admin</a>
<br /><br /><br />

<table class="tbl-full">
  <tr>
    <th>Sr no</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Actions</th>
  </tr>

  <?php
  $sql="SELECT * FROM tbl_admin"; //query data of all admin
  $res=mysqli_query($conn,$sql);
  
if($res==TRUE)
{
  $counts=mysqli_num_rows($res); //to get all the rows in database
$sn=1; //create variable and assign a value

  //check the rows
  if($counts>0)
  {
while($rows=mysqli_fetch_assoc($res))
{
  //while loop to get all the data 
  $id=$rows['id'];
  $full_name=$rows['full_name'];
  $username=$rows['username'];

  //display value in table
  ?>
 <tr>
    <td><?php echo $sn++;?>. </td>
    <td><?php echo $full_name; ?></td>
    <td><?php echo $username; ?></td>
    <td>
    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>"class="btn-primary">Change Password</a> 
     <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
     <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
    </td>
  </tr>

<?php
}
  }
}
  ?>

  
</table>

</div>
  </div>
<!--Main  Content Section End-->

<?php include('partials/footer.php');?>