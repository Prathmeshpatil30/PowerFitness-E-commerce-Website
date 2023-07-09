<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add Category form -->
        <form action="" method="POST" enctype="multipart/form-data"> <!-- enctype allow u to uploade a file-->
        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" required placeholder="Category Title">
            </td>
        </tr>

        <tr>
            <td>Select Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Featured: </td>
            <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No 
            
            </td>
        </tr>
        <tr>
            <td>Active: </td>
            <td>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>

        
        </table>
        
    </form>

    <?php
        if(isset($_POST['submit']))
        {
            //getting value from user for category
            $title = $_POST['title'];
            //for radio btn 
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";
            }

            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";
            }
            
            //check img selection and set the value for image
            
            if(isset($_FILES['image']['name']))
            {
                //upload the image
                $image_name=$_FILES['image']['name'];

                //upload img only if img is selected
                if($image_name !="")
                {

                
                    //Same image will auto rename
                    //get the extension of our image eg. jpg,png,gif etc.
                    $ext=end(explode('.', $image_name));
                    //rename img
                    $image_name="Food_Category_".rand(000, 999).'.'.$ext; //Food_Category_123'jpg
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../images/category/".$image_name;
                    //finally upload img
                    $upload = move_uploaded_file($source_path, $destination_path);
                    
                    if($upload==false)
                    {
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                        //redirect to add category
                        header('location:'.SITEURL.'admin/add-category.php');
                        //stop the process
                        die();
                    }
                 }                             
            
            }
            else
            {
                //don't upload img and set upload img value blank
                $image_name="";
            }

            //create sql query to insert data
            $sql="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //query for saving data
            $res=mysqli_query($conn, $sql);

            if($res==true)
            {
                //category added
                $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";
                //dispatch to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //category added
                $_SESSION['add']="<div class='error'>Failed Add Category.</div>";
                //dispatch to manage category page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }

?>
    </div>
</div>



<?php include('partials/footer.php');?>