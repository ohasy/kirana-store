<?php include_once 'helpers/init.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kirana-store</title>


</head>

<body>

<?php subview('header.php'); ?>

<section id="main">

	<?php subview('sidebar.php'); ?>

	<section id="content">
		<!-- content begins -->

		<?php

		// -----------------------------------------------
		if($_SESSION['is_authenticated'] == true) {
			header("Location:"."views/auth-views/home");
		} else {
			header("Location:"."views/auth-views/login");
		}
		

		// if(addProduct(10,"another product name","Product description")) {
		// 	echo "proudct added successfully";
		// }else {
		// 	echo "adding proudct failed";
		// }

		// getProductsByCategory(10);

		// ------------------------------------------------

			// $cates = getCategories();
			// foreach ($cates as &$category) {
			// 	echo($category);
			// }

		// $dude = addCategory("New product name");
		// if($dude) {
		// 	echo "records addedsuccessfully";
		// }else {
		// 	echo "adding record failed";
		// }

		// $dude = updateCategory(10,"edited name");
		// if($dude){
		// 	echo "records edited successfully";
		// } else {
		// 	echo "editing failed";
		// }

		// $dude = deleteCategory(9);
		// if($dude){
		// 	echo "records deleted successfully";
		// } else {
		// 	echo "deleting failed";
		// }
		  ?>
		<!-- content ends --> 

  
  <?php subview('footer.php'); ?> 

</section>


</body>
</html>