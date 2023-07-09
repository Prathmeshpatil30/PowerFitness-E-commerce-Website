<?php include('partials/menu.php');?>
<div class="main-content">
<div class="wrapper">
<h1>
    Manage Products
</h1>
<br /><br />

      

<!-- button to add admin -->
<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Product</a>
<br /><br /><br />

                <?php
                  if(isset($_SESSION['add']))
                  {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                  }

                  if(isset($_SESSION['delete']))
                  {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                  }

                  if(isset($_SESSION['upload']))
                  {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                  }

                  if(isset($_SESSION['unauthorize']))
                  {
                    echo $_SESSION['unauthorize'];
                    unset ($_SESSION['unauthorize']);
                  }

                  if(isset($_SESSION['update']))
                  {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                  }

                  
                
                  
                ?>
     

<table class="tbl-full">
  <tr>
    <th>Sr no</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Featured</th>
    <th>Active</th>
    <th>Actions</th>
  </tr>

    <?php 
      //create sql query to gey all food
      $sql = "SELECT * FROM tbl_food";

      $res = mysqli_query($conn, $sql);

      $count =mysqli_num_rows($res);

      //create serial num variable n set deafult value
      $sn=1;

      if($count>0)
      {
        //get food from db and display
        while($row=mysqli_fetch_assoc($res))
        {
          $id = $row['id'];
          $title =$row['title'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active =$row['active'];
          ?>
            <tr>
                <td><?php echo $sn++; ?> </td>
                <td><?php echo $title; ?></td>
                <td>$<?php echo $price; ?></td>
                <td>
                <?php 
                  if($image_name =="")
                  {
                    //we dont have img display error msg
                    echo "<div class='error'>Image not Added.</div>";
                  }
                  else
                  {
                    //we have img display img
                    ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                    <?php
                  }
                ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Products</a>
                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Products</a>
                </td>
            </tr>

          <?php
        }
      }
      else
      {
        echo "<tr> <td colspan='7' class ='error'>Products not Added Yet.</td></tr>";
      }
    ?>
  

  

</table>
</div>
</div>

<?php include('partials/footer.php');?>