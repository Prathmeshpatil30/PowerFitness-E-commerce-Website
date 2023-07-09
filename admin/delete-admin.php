<?php
//include $conn file hare which is in constants
include('../config/constants.php'); 
// get a admin to be deleted 
$id=$_GET["id"];
// select sql query to delete
$sql="DELETE FROM tbl_admin WHERE id=$id";
//execute the qurey 
$res=mysqli_query($conn,$sql);
//check the query executed successfully or not 
if($res==true)
{
$_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>"; // session variable to display message 
header('location:'.SITEURL.'admin/manage-admin.php'); //redirect to manage admin
}
else
{
$_SESSION['delete']="<div class='error'>Failed To Delete Admin Try Again Later..</div>";
header('location:'.SITEURL.'admin/manage-admin.php');
}
// redirct to manage admon page with message (success/error)
?>
