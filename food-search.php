<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php
    include('partial-frontent/menu.php');
    ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <!-- Add a proper search form -->
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            
            <?php
            // Check if search was performed
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                echo "<h2>Foods on Your Search <a href='#' class='text-white'>\"$search\"</a></h2>";
            }
            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
            // Only process search if search term was submitted
            if(isset($_POST['search'])) {
                // Include database connection if not already included
                include('config/constants.php');

                // Get the search keyword safely
                $search = mysqli_real_escape_string($conn, $_POST['search']);

                // SQL query to get food based on search keyword
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count > 0){
                    // Food is available
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if($image_name != ""){
                                    // Image available
                                    ?>
                                    <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                } else {
                                    // Image not available
                                    echo "<div class='error'>Image not available</div>";
                                }
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Food is not available
                    echo "<div class='error'>No foods found matching your search: '$search'</div>";
                }
            } else {
                // If no search was performed, display all menu items
                // You can retrieve all menu items from the database here
                // Or keep your hardcoded items as a fallback
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Food Title</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-burger.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Smoky Burger</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-burger.jpg" alt="Chicke Hawain Burger" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Nice Burger</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Food Title</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Food Title</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="images/menu-momo.jpg" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4>Chicken Steam Momo</h4>
                        <p class="food-price">$2.3</p>
                        <p class="food-detail">
                            Made with Italian Sauce, Chicken, and organice vegetables.
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php
    include('partial-frontent/footer.php');
    ?>
    <!-- footer Section Ends Here -->

</body>
</html>
