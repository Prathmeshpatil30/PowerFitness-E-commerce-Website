<?php
//Authorization or access control
//checking for user login or not 
if(!isset($_SESSION['user'])) //if user is not there
{
 //user is not login
 //redirect to login pge with msg
 $_SESSION['no-login-message']="<div class='error text-center'>Please Login to Get Access for Admin Pannel.</div>";
 //Redirect to login pge
 header('location:'.SITEURL.'admin/login.php');
}
?>