<?php include_once '../../helpers/init.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Product</title>


</head>

<body>

<?php subview('header.php'); ?>

<section id="main">

	<?php subview('sidebar.php'); ?>

	<section id="content">
	
    <form action="add-product.php" method="POST" enctype="multipart/form-data"> 
        <div class="form-group">
        <label>Product Name:
            <input type="text" name="product-name">
        </label>
        </div>
        <div class="form-group">
        <label>Product Description:
            <input type="text" name="product-dec">
        </label>  
        </div>
        <div class=form-group>
        <label>Product Image:
            <input type="file" name="product-image" >
        </label>    
        </div>
        <button type="submit" name="add-prod">Submit</button>
    </form>
  
  <?php subview('footer.php'); ?> 

</section>


</body>
</html>


<?php 
// accept="image/x-png,image/gif,image/jpeg"
    if(isset($_POST['add-prod'])){
        $result =  uploadFile('product-image');
        if(array_key_exists('error',$result)){
            echo($result['error']);
        } else {
            $fileName = $result['success'];
        }
        
    }
?>
