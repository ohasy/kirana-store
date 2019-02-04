<?php
  include_once __DIR__."/../helpers/init.php";
 
  // get all categories

  function getCategories():array {

    $getCategoriesQuery = "SELECT A.id,A.category_name,A.cate_desc,B.image FROM `categories` AS `A` LEFT JOIN `category_images` AS `B` ON A.cate_img_id=B.id";
    $result = mysqli_query($GLOBALS['con'], $getCategoriesQuery);
    // var_dump($result);

    if($result->num_rows) {

      $res_array = array();
      while($row = mysqli_fetch_assoc($result)){
        $res_array[] = $row;
      }
      return $res_array;
    } 
    return array("message" => "No category found.");

  }
  // add new category
  
  function addCategory($cate_name):bool {

    $insertCateQuery = "INSERT INTO `categories` (`category_name`) VALUES( ? )";
    $stmt = $GLOBALS['con']->prepare($insertCateQuery);
    $stmt->bind_param("s",$cate_name);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }

  // update category

  function updateCategory($category_id,$category_name):bool {

    $updateCateQuery = "UPDATE `categories` SET `category_name`=? WHERE `id` =? ";
    $stmt = $GLOBALS['con']->prepare($updateCateQuery);
    $stmt->bind_param("si",$category_name,$category_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }

  // delete category

  function deleteCategory($category_id):bool {
    $deleteCateQuery = "DELETE FROM `categories` WHERE `id` = ? ";
    $stmt = $GLOBALS['con']->prepare($deleteCateQuery);
    $stmt->bind_param("i",$category_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
      return true;
    }else {
      return false;
    }
  }
?>