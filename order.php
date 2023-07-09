<?php include('partials-front/menu.php'); ?>

<?php
//chcek product set or not
if (isset($_GET['food_id'])) {
    //get id n details of selected food 
    $food_id = $_GET['food_id'];
    //get the details of selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //exec query
    $res = mysqli_query($conn, $sql);
    //count rows
    $count = mysqli_num_rows($res);
    //check data avail or not
    if ($count == 1) {
        //avail
        //get from DB
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        //not avail
        header('location:' . SITEURL);
    }
} else {
    //dispatch to home pg
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    //check img avail
                    if ($image_name == "") {
                        //img avail
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="image" class="img-responsive img-curve">
                    <?php
                    }

                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter Name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" pattern=".{10,}" name="contact" placeholder="Enter Number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter Email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="Enter Address" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            //Get all the details
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("y-m-d h:i:sa");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //save the order in db
            $sql2 = "INSERT INTO tbl_order SET 
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total =$total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact ='$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";
            //exe query
            $res2 = mysqli_query($conn, $sql2);
            //check query exe success or not
            if ($res2 == true) {
                //query exe
                $_SESSION['order'] = "<div class='success text-center'>Order  Successfully.</div>";
                 header('location: https://rzp.io/l/M31LsZd54D');
                
            } else {
                //fail to save order
                $_SESSION['order'] = "<div class='error text-center'>Order Failed.</div>";
                header('location:' . SITEURL);
            }
        }

        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>