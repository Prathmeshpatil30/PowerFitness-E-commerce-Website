    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

        <?php 
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset ($_SESSION['order']);
            }
        
        
        ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">ALL PRODUCTS</h2>
            
            <?php 
                //create sql query to display category from db
                $sql = "SELECT * FROM tbl_category LIMIT 6";
                //execute query
                $res = mysqli_query($conn,$sql);
                //count rows to check the category available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value
                        $id = $row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?> 
                                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                <?php  
                                    if($image_name=="")
                                    {
                                        //display msg
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Image" class="img-responsive img-curve">
                                        <?php 
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>
                        
                        <?php
                    }
                }
                else
                {
                    //not available
                    echo "<div class='error'>Category Not Added.</div>";
                }
            
            ?>

           

            

           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->




    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">PRODUCTS MENU</h2>
            <?php
                //Getting food from DB Which active n Featured
                //SQL Query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 50";
                //Execute Query
                $res2 = mysqli_query($conn, $sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);
                //check food avail or not
                if($count2>0)
                {
                    //food avail
                    while($row= mysqli_fetch_assoc($res2))
                    {
                        //get all values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                             <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                    //check img avail or not
                                    if($image_name=="")
                                    {
                                        //img not avail
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> "alt="img" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php

                    }
                }
                else
                {
                    // not avail
                    echo "<div class='error'>Product Not Available.</div>";
                }
            ?>
           

            
                

                   
            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   

<?php include('partials-front/footer.php'); ?>