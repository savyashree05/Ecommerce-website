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
        <title>Ecommerce Website Cart details</title>
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
}
.cart_img{
    width:100px;
    height:100px;
    object-fit:contain;
}

</style>
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
        
        <!--li class="nav-item">
          <a class="nav-link" href="#">Total Price:
            
            </a>
        </li>-->
        
      </ul>
      
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






   <!--fourth child-->
    <div class="container">
        <div class="row">
            <form action="" method="post">
            <table class="table table-bordered text-center">
                
                    <!--php code to display dynamic data-->
                    <?php
                   
      $get_ip_add = getIPAddress();
      $total_price=0;
      $cart_query="Select * from cart_details where ip_address='$get_ip_add' ";
      $result=mysqli_query($con,$cart_query);
      $result_count=mysqli_num_rows($result);
      if($result_count>0){
        echo '<thead>
        <tr>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>';
      while($row=mysqli_fetch_array($result)){
        $product_id=$row['product_id'];
        $select_products="select * from products where product_id='$product_id' ";
        $result_products=mysqli_query($con,$select_products);
          while($row_product_price=mysqli_fetch_array($result_products)){
             $product_price=array($row_product_price['product_price']);
             $price_table=$row_product_price['product_price'];
             $product_title=$row_product_price['product_title'];
             $product_image=$row_product_price['product_image'];
             $product_values=array_sum($product_price);
             $total_price+=$product_values;
       
 
?>
                    <tr>
                        <td><?php echo $product_title ?></td>
                        <td><img src="http://localhost/Ecommerce%20Website/images/<?php echo $product_image?>" class="cart_img"> </td>
                        <td> <input type="text" class="form-input w-50" name="qty"></td>
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        if(isset($_POST['update_cart'])){
                            $quantities=$_POST['qty'];
                            $update_cart="update cart_details set quantity=$quantities where ip_address='$get_ip_add' ";
                            $result_products_quantity=mysqli_query($con,$update_cart);
                            $total_price=$total_price*$quantities;
                        }
                        ?>
                        <td><?php echo $price_table ?></td>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>" ></td>
                        <td>
                            <input type="submit" value="update cart" style="background-color: linen;" name="update_cart" >
                        <!--<button style="background-color: linen; border-0">Update</button></a>-->
                        <input type="submit" value="Remove from cart" style="background-color: linen;" name="remove_cart" >
                        </td>
                    </tr>
                    <?php
               }
              }
            }
            else{
              echo "<h2 class='text-center' >Cart is Empty</h2>";
            }
              ?>
                </tbody>
            </table>
            
            <!-- subtotal-->
            <div class="d-flex">
              <?php
              $get_ip_add = getIPAddress();
              
              $cart_query="Select * from cart_details where ip_address='$get_ip_add' ";
              $result=mysqli_query($con,$cart_query);
              $result_count=mysqli_num_rows($result);
              if($result_count>0){
                echo "<h4 class='px-3'>Subtotal:<strong class='text-secondary'>$total_price</strong></h4>
                <input type='submit' value='Continue Shopping' style='background-color: linen;' name='continue_shopping'>
                <a href='process_payment.php' class='btn btn-secondary '>Buy now</a>";
              } else{
              echo "  <input type='submit' value='Continue Shopping' style='background-color: linen;' name='continue_shopping' >";
              }
              if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php','_self')</script>";
              }
              ?>
                
               
                
            </div>
        </div>
    </div>
    </form>
    <!-- function to remove item-->
    <?php 
    global $con;
    function remove_cart_item(){
      global $con;
        if(isset($_POST['remove_cart'])){
            foreach($_POST['removeitem'] as $remove_id){
              echo   $remove_id;
              $delete_query="delete from cart_details where product_id=$remove_id ";
              $run_delete=mysqli_query($con,$delete_query);
              if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
              }
            }
        }
    }
    echo $remove_item=remove_cart_item();
    ?>
    <div class="bg-light p-2 ">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FAF0E6;">
    <p>
    VOUGE VENTURE - DESIGNED IN 2024</p>
</nav>
   </div>

<!--bootstrap js link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>