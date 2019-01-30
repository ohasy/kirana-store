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
	
  
  <?php subview('footer.php'); ?> 

</section>


</body>
</html>


<?php 
var_dump($_ENV);
$recipients = array(
    'yash@sharabhtechnologies.com',
    'anuraj.7627@gmail.com',
    'raviojha500@gmail.com'
 );

 $zip = createZip('../helpers');
 
 $attachments = array(
    $zip['zip_path'] => $zip['zip_name'] ,
 );

 
 var_dump($attachments);


 $result = sendMail("dummy subject","dummy body",$recipients,$attachments);

 if(array_key_exists("error",$result)){
    echo $result['error'];
    
 } else {
     echo 'chl gya';
    // header('Location:index.php');
 }
?>
