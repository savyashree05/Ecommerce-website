<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
 <!--bootsrtap css link--> 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 <!--css file--> 
<link rel="stylesheet" href="../style.css">

</head>
<body>
    <!--navbar-->
<div class="container-fluid p-0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: linen;">
  <div class="container-fluid">
<img src="https://techbullion.com/wp-content/uploads/2022/09/677t7676.jpg" class="logo">
<nav class="navbar navbar-expand-lg ">
    <ul class="navbar-nav">
       <li class="nav-item">
        <a href="" class="nav-link">Welcome patron</a>

       </li>

    </ul>
</nav>
</div>
</nav>
<!--second child-->
<div class="bg-light">
    <h3 class="text-center p2"> Admin Details</h3>
</div>
<!--third child-->
<div class="row">
    <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
    <div class="pd-3">
<a href="#" ><img src="https://logo.com/image-cdn/images/kts928pd/production/0089b7ae1ed394f041c5f7929e111c11e8eafe4d-424x421.png?w=1080&q=72" class="admin_image"></a>
<p class="text-light text-center">Admin </p>
</div>
<div class="button text-center">
    <button><a href="insert_product.php" class="nav-link text-secondary" style="background-color: linen; my-1">Insert Products</a></button>
    <!--<button><a href="" class="nav-link text-secondary" style="background-color: linen; my-1">View Products</a></button>-->
    <button><a href="index.php?insert_category" class="nav-link text-secondary" style="background-color: linen; my-1">Insert Categories</a></button>
    
    <button><a href="index.php?insert_brand" class="nav-link text-secondary" style="background-color: linen; my-1">Insert Brands</a></button>
    
   
</div>
</div>
</div>
<!--fourth child-->
<div class="container my-3">
    <?php
    if(isset($_GET['insert_category'])){
       include('insert_categories.php');
    }
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
     }
    ?>
</div>
<!-- last child-->

<div class="bg-light p-2 ">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FAF0E6;">
    <p >
    VOUGE VENTURE - DESIGNED IN 2024</p>
</nav>
   </div>

</div>

    <!--bootsrtap js link--> 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>