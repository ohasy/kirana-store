<?php
  include_once __DIR__."/../helpers/init.php";
 
  // get all categories

  function getAllCategories():array {
    echo(`<script>alert("what");</script>`);
    $getCategoriesQuery = "SELECT `id`,`category_name` FROM `categories`";
    $result = mysqli_query($GLOBALS['con'], $getCategoriesQuery);
    // var_dump($result);

    if(!$result) {
      return array("message" => "No category found.");
    } else {
      echo`records found`;
      $res_array = array();
      while($row = mysqli_fetch_assoc($result)){
        array_push($res_array,$row['category_name']);
      }
      return $res_array;
    }

  }
  // add new category
  
  function addNewCategory($cate_name):bool {

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


  function deleteCategory($category_id):bool {
    $updateCateQuery = "DELETE FROM `categories` WHERE `id` =? ";
    $stmt = $GLOBALS['con']->prepare($updateCateQuery);
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