<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br><br>

        <?php
        
            if(isset($_SESSION['upload']))

            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" required placeholder="Title of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td> 
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                    //create php code to display category from DB
                                    //create sql to get all active category from DB
                                    $sql ="SELECT * FROM tbl_category WHERE active = 'Yes'"; // string wrap inside single qoute
                                    $res = mysqli_query($conn, $sql);

                                    //count row to check whether we have category or not 
                                    $count = mysqli_num_rows($res);

                                    //if count is greater than zero, we have category else we do not have category 
                                    if($count>0)
                                    {
                                        //we have category
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get details og category 
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                    //we do not have category
                                        ?>
                                            <option value="0">No Category Found</option>
                                        <?php
                                    }
                            //display dropdown
                                         ?>
                            
                        </select>
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
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

        <?php
                    if(isset($_POST['submit']))
                    {
                        // get the data fro form 
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price=$_POST['price'];
                        $category = $_POST['category'];

                        if(empty($title) || empty($description) || empty($price) || empty($category))
                        {
                            $_SESSION['add'] = "<div class='error'>Food Not Added.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {

                        

                        if(isset($_POST['featured']))
                        {
                            $featured = $_POST['featured'];

                        }
                        else
                        {
                            $featured = "No"; //default value
                        }

                        if(isset($_POST['active']))
                        {
                            $active = $_POST['active'];
                        }
                        else
                        {
                            $active = "No";
                        }
                        //upload selected image
                        
                        if(isset($_FILES['image']['name']))
                        {
                            //get the details
                            $image_name = $_FILES['image']['name'];
                            //upload img only selected
                            if($image_name!="")
                            {
                                //img selected
                                //rename the img 
                                $ext = end(explode('.',$image_name));
                                //create new name
                                $image_name="Food-Name-".rand(0000,9999).".".$ext;
                                //upload the img
                                //source path n destination path
                                $src = $_FILES['image']['tmp_name'];
                                //des path for the img to be uploaded
                                $dst ="../images/food/".$image_name;
                                $upload = move_uploaded_file($src, $dst);

                                if($upload==false)
                                {
                                    //fail to upload redirect to add food with msg & stop the process
                                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                                    header('location:'.SITEURL.'admin/add-food.php');
                                    
                                    die();

                                }
                                
                            }
                        }
                        else
                        {
                            $image_name = ""; //default value blank
                        }
                    }
                        //insert into DB 
                        // for num we dont need ''(qoutes)
                        $sql2 = "INSERT INTO tbl_food SET
                            title = '$title',
                            description='$description',
                            price = $price,
                            image_name = '$image_name',
                            category_id = $category,
                            featured = '$featured',
                            active = '$active'
                        ";

                        $res2 = mysqli_query($conn, $sql2);//excute qoery


                        if($res2 == true)
                        {
                            //data add successfully
                            $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        else
                        {
                            $_SESSION['add'] = "<div class='error'>Product not Added.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                        //dispatch the page to manage food pg
                    }
        ?>


    </div>
</div>







<?php include('partials/footer.php'); ?>