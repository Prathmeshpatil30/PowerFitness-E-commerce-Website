<?php  
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //proces to delete
        //get id n img name
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];
        
        //remove img if available
        if($image_name!="")
        {
            //get the path for img
            $path = "../images/food/".$image_name;

            //remove imf file from folder
            $remove = unlink($path);

            //check the deletion of img
            if($remove==false)
            {
                //faile to remove img
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image.</div>";
                //dispatch pg
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process
                die();
            }
            
        }

        $sql ="DELETE FROM tbl_food WHERE id=$id";
        //execute the query
        $res=mysqli_query($conn, $sql);
        //check query excute or not 
        //redirect to mange pg
        if($res==true)
        {
            $_SESSION['delete']= "<div class='success'>Product Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            
            $_SESSION['delete']= "<div class='error'>Failed to Delete Product.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }


    }
    else
    {
        //dispatch to manage food pg
        $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>