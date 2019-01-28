<?php
  include_once __DIR__."/../helpers/init.php";

  // get all products by category id

  function getProductsByCategory($category_id):array {
    $getProductQuery = "SELECT `id`,`product_name`,`category_id`,`product_desc` FROM `products` WHERE `category_id`= $category_id ";
    $result = mysqli_query($GLOBALS['con'], $getProductQuery);
    if($result->num_rows) {
      $res_array = array();
      while($row = $result->fetch_row())
      {
          $res_array[]=$row;
      }
      return $res_array;
    }
    return array("message"=>"no data found");
  }

  // get product by product id

  function getProductById($product_id) {
    $getProductQuery = "SELECT `id`,`product_name`,`category_id`,`product_desc` FROM `products` WHERE `id`= ? LIMIT 1 ";
    $stmt = $GLOBALS['con']->prepare($getProductQuery);
    $stmt->bind_param("i",$product_id);
    $result = $stmt->execute(); 
    $stmt->close();
    var_dump($result);
  }

  // get products by similar name 

  function searchProducts($product_name){
    $getProductQuery = "SELECT `id`,`product_name`,`category_id`,`product_desc` FROM `products` WHERE `product_name` LIKE ? ";
    $stmt = $GLOBALS['con']->prepare($getProductQuery);
    $stmt->bind_param("i",$product_id);
    $result = $stmt->execute(); 
    $stmt->close();
    var_dump($result);
  }

  // add product 
  function addProduct($category_id,$product_name,$product_desc):bool {

    $insertNewProduct = "INSERT INTO `products` (`category_id`,`product_name`,`product_desc`) VALUES(?,?,?) ";
    $stmt = $GLOBALS['con']->prepare($insertNewProduct);
    $stmt->bind_param("iss",$category_id,$product_name,$product_desc);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }

  // update product
  function updateProduct($product_id,$product_name,$product_desc):bool {
    $updateProduct = "UPDATE `products` SET `product_name`=?,`product_desc`=? WHERE `id`= ? ";
    $stmt = $GLOBALS['con']->prepare($updateProduct);
    $stmt->bind_param("ssi",$product_name,$product_desc,$product_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }

  // delete product
  function deleteProduct($product_id):bool{
    $deleteProductQuery = "DELETE FROM `products` WHERE `id` = ? ";
    $stmt = $GLOBALS['con']->prepare($deleteProductQuery);
    $stmt->bind_param("i",$product_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }
?>