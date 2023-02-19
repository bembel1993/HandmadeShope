<?php
session_start();

$servername = "localhost";
$username = "sqluser";
$password = "password";
$dbname = "handmade";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Handmade Shope</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/mycart.css">
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <?php
    include('header.php');
    ?>
    <!-- MY CART -->
    <br><br> <br><br>
    <section class="shopping-cart dark">
        <div class="container">
            <div class="block-heading">
                <h2>Shopping Cart</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <div class="product">
                                <div class="row">
                                    <?php
                                    $userId = $_SESSION['id'];
                                    $sql = "SELECT name, 
                                                   price, 
                                                   descrip, 
                                                   photo
                                            FROM products Left Join cart 
                                            ON products.id = cart.productId
                                            LEFT JOIN user ON user.id = cart.userId
                                            WHERE user.id = $userId";

                                    $result = $conn->query($sql); ?>
                                    <?php if (!empty($result) && $result->num_rows > 0) {
                                        $count = 0;
                                        foreach ($result as $row) {
                                            $count++;
                                    ?>
                                            <div class="col-md-3">
                                                <img class="img-fluid mx-auto d-block image" src=<?php echo $row['photo']; ?>>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="info">
                                                    <div class="row">
                                                        <div class="col-md-5 product-name">
                                                            <div class="product-name">
                                                                <a href="#">Lorem Ipsum dolor</a>
                                                                <div class="product-info">
                                                                    <div>Name: <span class="value"><?php echo $row['name']; ?></span></div>
                                                                    <div>Description: <span class="value"><?php echo $row['descrip']; ?></span></div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 quantity">
                                                            <label for="quantity">Quantity:</label>
                                                            <input id="quantity" type="number" value="1" class="form-control quantity-input">
                                                        </div>
                                                        <div class="col-md-3 price">
                                                            <span><?php echo $row['price']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <?php
                        $userId = $_SESSION['id'];
                        $sql = "SELECT sum(price) as sumprice
                                FROM products Left Join cart 
                                ON products.id = cart.productId
                                LEFT JOIN user ON user.id = cart.userId
                                WHERE user.id = $userId";

                        $result = $conn->query($sql); ?>
                        <?php if (!empty($result) && $result->num_rows > 0) {
                            foreach ($result as $row) {
                        ?>
                                <div class="summary">
                                    <h3>Summary</h3>
                                    <div class="summary-item"><span class="text">Subtotal</span><span class="price"><?php echo $row['sumprice']; ?></span></div>
                                    <div class="summary-item"><span class="text">Discount</span><span class="price">$0</span></div>
                                    <div class="summary-item"><span class="text">Shipping</span><span class="price">$0</span></div>
                                    <div class="summary-item"><span class="text">Total</span><span class="price"><?php echo $row['sumprice']; ?></span></div>
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Checkout</button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
    <!---->
    <h2>
        <?php
        if (isset($_SESSION['name'])) {
            echo $_SESSION['name'];
            echo $_SESSION['id'];
        } ?>
        <h2>
            <br><br><br><br><br><br><br><br><br><br>


            <?php
            include('footer.php');
            ?>

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


            <!-- Additional Scripts -->
            <script src="assets/js/custom.js"></script>
            <script src="assets/js/owl.js"></script>
            <script src="assets/js/slick.js"></script>
            <script src="assets/js/isotope.js"></script>
            <script src="assets/js/accordions.js"></script>


            <script language="text/Javascript">
                cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
                function clearField(t) { //declaring the array outside of the
                    if (!cleared[t.id]) { // function makes it static and global
                        cleared[t.id] = 1; // you could use true and false, but that's more typing
                        t.value = ''; // with more chance of typos
                        t.style.color = '#fff';
                    }
                }
            </script>
</body>

</html>