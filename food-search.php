<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php  
                //get search keyword
                $search = mysqli_real_escape_string($conn,$_POST['search']);
            
            ?>
            <h2>Product You Search <a id="suplle" href="#" class="text">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"> PRODUCT MENU</h2>

            <?php
                
                //sql query to get food based on search
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'"; //search food done on title description
                //execute query
                $res = mysqli_query($conn, $sql);
                //count 
                $count = mysqli_num_rows($res);
                //chek food avail
                if($count>0)
                {
                    //food avail
                    while($row=mysqli_fetch_assoc($res)) //get all value from DB in Aaray format 
                    {
                        //get all details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check img name is avail or not
                                        if($image_name=="")
                                        {
                                            //img not avail
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
                                            //img avail
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="img" class="img-responsive img-curve">
                                            <?php
                                        }

                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
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
                    //not avail
                    echo "<div class='error'>Product Not Found.</div>";
                }
            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>