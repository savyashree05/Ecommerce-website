<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
  $product_title=$_POST['product_title'];
  $product_description=$_POST['product_description'];
  $product_category=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  //accessing image
  $product_image=$_FILES['product_image']['name'];
  $product_image_tmp = $_FILES['product_image']['tmp_name'];
    move_uploaded_file($product_image_tmp, "./productImages/$product_image");

    // Insert product details into database
    $insert_product_query="insert into products (product_title,product_description,category_id,brand_id,product_image,product_price) values('$product_title','$product_description','$product_category ' , '$product_brand ' ,'$product_image ',' $product_price ' )";

    $run_product = mysqli_query($con, $insert_product_query);

    if($run_product){
        echo "<script>alert('Product has been inserted successfully!')</script>";
        echo "<script>window.open('index.php?insert_product','_self')</script>";
    }
}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Products-Admin Dashboard</title>
     <!--bootstrap CSS link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--font awesome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--css file--> 
<link rel="stylesheet" href="../style.css">

   
  </head>
  <body class="bg-light">
    <div class="class-container mt-3">
      <h1 class="text-center">Insert Products</h1>
      <!--form-->
      <form action="" method="post" enctype="multipart/form-data">
      <!-- title-->    
      <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product title</label>
           <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
          </div>
          <!--description-->
          <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_description" class="form-label">Product Description</label>
           <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
          </div>

          <!--categories-->
          <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="" class="form-select">
              <option value="">Select a category</option>
              <?php
              $select_query="Select * from categories";
              $result_query=mysqli_query($con,$select_query);
              while($row=mysqli_fetch_assoc($result_query)){
                $category_title=$row['category_title'];
                $category_id=$row['category_id'];
                echo "<option value='$category_id'>$category_title</option>";
              }
              ?>
              
            </select>
          </div>

          <!--brands-->
          <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brand" id="" class="form-select">
              <option value="">Select a brand</option>
              <?php
              $select_query="Select * from brands";
              $result_query=mysqli_query($con,$select_query);
              while($row=mysqli_fetch_assoc($result_query)){
                $brand_title=$row['brand_title'];
                $brand_id=$row['brand_id'];
                echo "<option value='$brand_id'>$brand_title</option>";
              }
              ?> 
              
            </select>
          </div>
            
           <!--image-->
           <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_image" class="form-label">Product image</label>
           <input type="file" name="product_image" id="product_image" class="form-control"  required="required">
          </div>
          
           <!--price-->
           <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_price" class="form-label">Product price</label>
           <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
          </div>
           
           <!--description-->
           <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_product" class="btn btn-secondary mb-3 px-3" value="Insert Product">
          </div>

      </form>
    </div>


      </form>
    </div>
	
  </body>
</html>