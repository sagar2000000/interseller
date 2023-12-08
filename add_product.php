<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
  </head>
  <body>
    <header class="header">
      <h1 class="name">TarkariGhar</h1>
    </header>
    <nav class="navbar">
      <a href="header.php">Home</a>
      <a href="aboutus.html">About Us</a>
      <a href="view_products.php">Products</a>
      <a href="services.html">Services</a>
      <a href="contact.html">Contact</a>
     
    
      

       </nav>
<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['add'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'new assets/'.$rename;

   if($image_size > 2000000){
      $warning_msg[] = 'Image size is too large!';
   }else{
      $add_product = $conn->prepare("INSERT INTO `products`(id, name, price, image) VALUES(?,?,?,?)");
      $add_product->execute([$id, $name, $price, $rename]);
      move_uploaded_file($image_tmp_name, $image_folder);
      $success_msg[] = 'Product added!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <link rel="stylesheet" href="style.css">

</head>
<body>
   


<section class="product-form">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>product info</h3>
      <p>product name <span>*</span></p>
      <input type="text" name="name" placeholder="enter product name" required maxlength="50" class="box">
      <p>product price <span>*</span></p>
      <input type="number" name="price" placeholder="enter product price" required min="0" max="9999999999" maxlength="10" class="box">
      <p>product image <span>*</span></p>
      <input type="file" name="image" required accept="image/*" class="box">
      <input type="submit" class="btn" name="add" value="add product">
   </form>

</section>






   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="script.js"></script>

<?php include 'alert.php'; ?>
<footer>
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: tarkarighar@gmail.com</p>
            <p>Phone: +977 9841091926</p>
        </div>

        <div class="footer-section">
            <h3>Follow Us</h3>
            <ul class="social-icons">

                <a href="facebook"><img id="i1" src="assets/fcbook.png"></a>
                <a href="twitter"><img id="i2"  src="  assets/twitter.png"></a>
                <a href="instagram"><img id="i3" src="assets/insta.jpg"></a>
            </ul>
        </div>

        <div class="copyright">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>