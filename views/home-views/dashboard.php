<!-- FOR ADMIN -->
<?php include_once __DIR__.'/../../helpers/init.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>


</head>

<body>

<?php subview('header.php'); 

$categories = [];
$categories =  getCategories();
//  showArray($categories);
?>

<section id="main">

	<?php subview('sidebar.php'); ?>

	<section id="content">
		<!-- content begins -->
DASHBOARD
> Products
> Categories
> show all Categories
> Add option
<div class="row">
<?php 
if(count($categories >0 )) {
    foreach ($categories as $cate) {
        // showArray($cate);
        // localhost/kirana-store/uploads/18371287815c51481d45d9d.png
        // <?=$_ENV['IMGPATH'].$cate['image']?>
         <!-- print_r($_ENV['IMGPATH'].$cate['image']) -->
        
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?=$_ENV['IMGPATH'].$cate['image']?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?=$cate['category_name'] ?></h5>
                <p class="card-text"><?=$cate['cate_desc']?></p>
                <a href="#" class="btn btn-primary">View</a>
            </div>
        </div>
        <?php
    }
}
?>
</div>
  
  <?php subview('footer.php'); ?> 

</section>


</body>
</html>