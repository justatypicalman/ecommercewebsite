<!-- 
    MEMBERS:
    Dango, Eric T.
    Ligones, Princess Joy B.
    Acebo, Diana M.
-->
<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($select_cart) > 0) {
      $message[] = 'product already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }
};

if (isset($_POST['update_cart'])) {
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <title>PickApps</title>
   <link rel="icon" href="img/logo.png">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <div class="dimmer">
      <div class="banner">
         <span class="exit">&times;</span>
         <button type="button" onclick="window.location.href='products.php';" id="shop" class="btn btn-default navbar-btn" style="width: 150px;border-radius: 10px;color:black; background-color: #5bccf6">Shop Now</button>
      </div>
   </div>

   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PickApps</title>
      <link rel="icon" href="img/logo.png">
      <link rel="stylesheet" href="css/styles.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   </head>

   <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
            <a class="navbar-brand" href="#"><img style="width: 80px" src="img/logo.png"><img style="width: 150px" src="img/brandname.png"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="products.php">Products</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="cart.php">My Cart</a>
                  </li>

                  <li id="signin">
                     <a href="index.php?logout=<?php echo $user_id; ?>" id="signin" onclick="return confirm('Are you sure you want to logout?');" class="delete-btn">logout</a>
                  </li>
               </ul>

            </div>
         </div>
      </nav>




      <?php
      if (isset($message)) {
         foreach ($message as $message) {
            echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
         }
      }
      ?>
      <div class="container-fluid" style="height: 650px;background: url('img/bg.jpg'); background-size: 100% 100%">

      </div>
      <div class="container">
         <div class="row">

         </div>
         <!-- <div class="row">
      <div class="col-md-8">
      Tite
      </div>
      <div class="col-md-4">
      Tite
      </div>
   </div> -->
         <div class="filler" style="height: 40px"></div>
         <div class="row">
            <div data-aos="fade-right" class="col-md">
               <img src="img/banner2.png" style="border: 5px solid rgb(243,156,18); border-radius: 15px;">
            </div>
            <div data-aos="fade-left" class="col-md" style="border: 15px solid rgb(243,156,18); border-radius: 15px; background-color:#094349; font-weight: bold; color: white; font-size: 25px; padding: 25px;">
               <p style="padding: 25px;">Pickapps gives small Entrepreneurs the option to expand their markets with the use of internet system, providing high quality services
                  without sacrificing privacy and security for all users, whether its a consumer, seller or service provider. <br><br>Now we are looking for a WATER REFILLING STATION to do business with and start its boost of sales!</p>
            </div>
         </div>

      </div>
      <footer class="page-footer font-small blue" style="background-color: #094349; color: white; ">


         <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#" style="text-decoration: none; color: white;"> PickApps</a>
         </div>


      </footer>

      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
         AOS.init();
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script>
         var header = $("nav");
         var hide = $("#btn-hide");
         var show = $("#btn-show");
         var banner = $(".banner");
         var body = $("body");
         var dimmer = $(".dimmer");
         var exit = $(".exit");
         var footer = $("footer");
         var container = $(".container");
         var fluid = $(".container-fluid");
         $(document).ready(function() {
            container.hide();
            dimmer.show();
            fluid.hide();
            footer.hide();
            header.css("opacity", 0.1);
            header.css("pointer-events", "none");
            $('.exit').click(function() {
               banner.fadeOut();
               container.fadeIn(2000);
               fluid.fadeIn(2000);
               footer.show();
               header.fadeTo(700, 1);
               header.css("pointer-events", "auto");
            })
         })
      </script>
   </body>

   </html>