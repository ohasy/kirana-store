<?php include_once 'helpers/init.php' ?>
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
	
    <form action="play.php" method="POST" enctype="multipart/form-data"> 
        <label>Product Name:
            <input type="text" name="product-name">
        </label>
        <label>Product Description:
            <input type="text" name="product-dec">
        </label>  
        <label>Product Image:
            <input type="file" name="product-image">
        </label>    
        <button type="submit" name="add-prod">Submit</button>
    </form>
  
  <?php subview('footer.php'); ?> 

</section>


</body>
</html>


<?php 
    if(isset($_POST['add-prod'])){
        $file = $_FILES['product-image'];
        
        var_dump($file);
        $types = array('image/jpeg','image/jpg','image/png');
        // if(in_array($file['type'],$types)){
            move_uploaded_file($file['tmp_name'],'uploads/'.$file['name']);
       // }
        
    }
?>
