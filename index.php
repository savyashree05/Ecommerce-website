<!-- connect file-->
<?php
include('includes/connect.php');


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewpoint" content="width=device-width,initial-scale=1.0">
        <title>Ecommerce Website using PHP and MySQL</title>
        <!--bootstrap CSS link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <!--navbar-->
   <style>
    .card-img-top{
    width:100%;
    height:200px;
    object-fit:contain;
}</style>
   <div class="container-fluid p-0">
    <!-- first child-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: linen;">
  <div class="container-fluid">
  <img src="https://techbullion.com/wp-content/uploads/2022/09/677t7676.jpg"  height="30">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
        <?php
        cart_item()
        ?>
        </sup>
        </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:
          <?php   total_cart_price(); ?>
            </a>
        </li>
        
      </ul>
      <form class="d-flex" role="search" action="search_product.php" method="get" >
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="Search_data">
        <!--<button class="btn btn-outline-success" type="submit">Search</button>-->
        <input type="submit" value="Search" class="btn btn-outline-secondary" name="Search_data_product">
      </form>
    </div>
  </div>
</nav>
<!-- second child-->

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary p-0">
    <div class="container-fluid"> <!-- Add a container for better spacing -->
        <ul class="navbar-nav me-auto"> <!-- Changed class name to "me-auto" for correct alignment -->
            <li class="nav-item">
                <a class="nav-link" href="#">Welcome Patron</a>
            </li>
           <!-- <li class="nav-item" style="margin-left: 10px;"> Add inline style to adjust margin
                <a class="nav-link" href="#">Login</a>
            </li> -->
        </ul>
    </div>
</nav>

<!-- third child-->
<div class="bg-light">
  <h3 class="text-center">Vogue Venture</h3>
  <p class="text-center">Looks so Good on the Outside, It'll Make You Feel Good  on the Inside</p>
</div>
<!-- fourth child-->
<div class="row px-3">
  <div class="col-md-12">
  <!--products-->
  <div class="row">
<!--fetching products-->
<?php

$select_query="select * from products order by rand() LIMIT 0,9";
$result_query=mysqli_query($con,$select_query);
  
   //$row=mysqli_fetch_assoc($result_query);
   //echo $row['product_title'];
   while($row=mysqli_fetch_assoc($result_query)){
    $product_id=$row['product_id'];
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    $product_image=$row['product_image'];
    $product_price=$row['product_price'];
    echo " <div class='col-md-4 mb-2'>
    <div class='card' >
  <img src='./admin_area/productImages/$product_image' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'>Price:Rs $product_price</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-secondary my-2'>Add to cart</a>
  <form method='post' action='process_payment.php'>
    <input type='hidden' name='product_name' value='$product_title'>
    <input type='hidden' name='product_price' value='100'>
    <input type='submit' name='buy_now' value='Buy Now' class='btn btn-secondary'>
</form>

  </div>
</div>
</div>";
   }
  

?>
<?php
 function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
?>
<?php

if(isset($_GET['add_to_cart'])){
  global $con;
  $get_ip_add = getIPAddress();
  $get_product_id=$_GET['add_to_cart'];
  
  $select_query="select * from cart_details where ip_address='$get_ip_add'  and product_id=$get_product_id";
  $result_query=mysqli_query($con,$select_query);
  $num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows>0){
echo"<script>alert('Item is already present in the cart')</script>";
echo "<script>window.open('index.php','_self')</script>";

}else{
  $insert_query="insert into cart_details(product_id,ip_address,quantity)values($get_product_id,'$get_ip_add',0)";
  $result_query=mysqli_query($con,$insert_query);
  echo"<script>alert('Item is added to cart')</script>";
  echo "<script>window.open('index.php','_self')</script>";

}
}

//function to get cart item number
function cart_item(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $get_ip_add = getIPAddress();
    $select_query="select * from cart_details where ip_address='$get_ip_add' ";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  
  }else{
    global $con;
    $get_ip_add = getIPAddress();
    $select_query="select * from cart_details where ip_address='$get_ip_add' ";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  
  
  }
  echo $count_cart_items;
  }

  
  function total_cart_price(){
    global $con;
      $get_ip_add = getIPAddress();
      $total_price=0;
      $cart_query="Select * from cart_details where ip_address='$get_ip_add' ";
      $result=mysqli_query($con,$cart_query);
      while($row=mysqli_fetch_array($result)){
        $product_id=$row['product_id'];
        $select_products="select * from products where product_id='$product_id' ";
        $result_products=mysqli_query($con,$select_products);
          while($row_product_price=mysqli_fetch_array($result_products)){
             $product_price=array($row_product_price['product_price']);
             $product_values=array_sum($product_price);
             $total_price+=$product_values;
 }
 }
echo $total_price;
}
?>
  


<!-- row end-->

</div>
<!-- column end-->

</div>




   <!-- <div class="col-md-4 mb-2">
    <div class="card" >
  <img src="https://img101.urbanic.com/v1/goods-pic/aca6fa4b04784d2490804a57716096b0UR_w1440_q90.webp" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
  </div>
</div>
    </div>
    <div class="col-md-4 mb-2">
    <div class="card" >
  <img src="https://everstylish.com/pub/media/catalog/product/cache/f1831bc42043919087a4ff2769315671/j/e/jew1102979-1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
    </div>
  </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="card" >
  <img src="https://everstylish.com/pub/media/catalog/product/cache/f1831bc42043919087a4ff2769315671/j/e/jew1102979-1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
    </div>
  </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="card" >
  <img src="https://everstylish.com/pub/media/catalog/product/cache/f1831bc42043919087a4ff2769315671/j/e/jew1102979-1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
    </div>
  </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="card" >
  <img src="https://everstylish.com/pub/media/catalog/product/cache/f1831bc42043919087a4ff2769315671/j/e/jew1102979-1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-info">Add to cart</a>
    <a href="#" class="btn btn-secondary">View more</a>
    </div>
  </div>
  </div>
</div>
</div>-->





  <!--sidenav-->
  
  </div>
</div>

<!--searching products-->




<!-- last child-->

<div class="bg-light p-2 ">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FAF0E6;">
    <p>
      VOUGE VENTURE - DESIGNED IN 2024</p>
</nav>
   </div>

  
 <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var productId = $(this).data('product-id');
            var productTitle = $(this).data('product-title');
            var productPrice = $(this).data('product-price');

            // Send AJAX request to addToCart.php
            $.ajax({
                type: 'POST',
                url: 'addToCart.php',
                data: {
                    product_id: productId,
                    product_title: productTitle,
                    product_price: productPrice
                },
                success: function(response) {
                    // Display success message or perform any other action
                    alert('Product added to cart successfully!');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>-->






<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>