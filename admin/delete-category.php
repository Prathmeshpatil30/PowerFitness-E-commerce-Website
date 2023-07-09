<?php
//include constants files
include('../config/constants.php');

 //check wheather the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
//get the value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //remove the img file
    if($image_name!="")
    {
        $path ="../images/category/".$image_name;
        //remove the img file
        $remove=unlink($path);
    
        //if failed to remove img then add error msg and stop the process
        if($remove==false)
        {
            //set session msg
            $_SESSION['remove']="<div class='error'>Fail to remove category image.</div>";
            //redirect to manage pg
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop process
            die();
        }
    }
//delete data from database
//SQL Query to delete data from DB
$sql="DELETE FROM tbl_category WHERE id=$id";
//Execute the query
$res=mysqli_query($conn, $sql); 
//check wheather the data is deleted from db or not 
if($res==true) 
{
    //success msg
$_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
//redirect to manage page
header('location:'.SITEURL.'admin/manage-category.php');
}  
else
{
    //fail msg
        //success msg
$_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";
//redirect to manage page
header('location:'.SITEURL.'admin/manage-category.php');
}
}
    else
    {
//redirect to manage page

    header('location:'.SITEURL.'admin/manage-category.php');
    }
    ?>