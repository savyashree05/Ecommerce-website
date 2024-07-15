<?php  
function search_products(){
 if(isset($_GET['Search_data_product'])){
  $search_data_value=$_GET['Search_data'];
 $search_query="Select * from products where product_title like '%$search_data_value%' ";
 $result_query=mysqli_query($con,$search_query);
//$row=mysqli_fetch_assoc($result_query);
//echo $row['product_title'];
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
echo"<h2 class='text-center text-secondary'>NO RESULTS MATCHED! NO PRODUCTS FOUND IN THIS CATEGORY!</h2>";
}
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
 }
}
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
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  

//cart function
function cart(){
if(isset($_GET['add_to_cart'])){
    global $con;
    $ip = getIPAddress();
    $get_product_id=$_GET['add_to_cart'];
    $select_query="select * from cart_details where ip_address=$ip and product_id=$get_product_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows>0){
echo"<script>alert("Item is already present in the cart")</script>";
echo "<script>window.open('index.php)</script>";
else{
    $insert_query="insert into cart_details(product_id,ip_address,quantity)values($get_product_id,'$get_ip_add',0)";
    $result_query=mysqli_query($con,$insert_query);
    echo "<script>window.open('index.php)</script>";
}
}
}
}
?>  