<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 
        //check wheather the id is set or not
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            //sql query
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //execute query
            $res = mysqli_query($conn, $sql);
            //count the rows 
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect to manage category
                $_SESSION['no-category-found']="<div class='error'>Category not Found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-category.php');
           
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="title" name="title" value="<?php echo $title;?>"></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image !="")
                            {
                                ?>
                                 <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                                 <?php
                            }
                            else
                            {
                                //display msg
                                echo"<div class='error'>Image Not Added. </div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                    
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <inaput type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //get all values
                $title=$_POST['title'];
                $id=$_POST['id'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //updating new img if selected 
                //check img is selected or not 
                if(isset($_FILES['image']['name']))
                {
                    //img details
                    $image_name = $_FILES['image']['name'];

                    //check img availavle or not
                    if($image_name !="")
                    {
                                //A. upload new img 

                                //Same image will auto rename
                            //get the extension of our image eg. jpg,png,gif etc.
                            $ext = end(explode('.', $image_name));
                            //rename img
                            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //Food_Category_123'jpg
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/".$image_name;
                            //finally upload img
                            $upload = move_uploaded_file($source_path, $destination_path);
                            
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                                //redirect to add category
                                header('location:'.SITEURL.'admin/manage-category.php');
                                //stop the process
                                die();
                            }
                            //B. remove the current img  if available
                            if($current_image!="")
                            {

                                            
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
                                //check wheather img is remove or not if failed to remove display msg & stop process
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove Current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                             }
                    }
                    else
                    {
                        $image_name = $current_image;    
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //updatye the DB
                $sql2="UPDATE tbl_category SET
                    title='$title',
                    image_name = '$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";
                //execute the Query
                $res2=mysqli_query($conn,$sql2);

                // redirect to manage pg with msg
                if($res2==true)
                {
                    //category update
                    $_SESSION['update']= "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to update category
                    
                    $_SESSION['update']= "<div class='error'>Failed to Updated Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>




<?php include('partials/footer.php');?>