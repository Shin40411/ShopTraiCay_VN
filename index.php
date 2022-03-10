<?php 
session_start();
?> 
<?php 
include ('header.php');
require_once ('db/dbhelper.php');
require_once ('common/utility.php');
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'select * from product where id = '.$id;
    $product = executeSingleResult($sql);
  $sql = 'select * from category where id = '.$id;
  $category = executeSingleResult($sql);
  if($category != null) {
        $name = $category['name'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> 
    <?php
        if(isset($_GET['tukhoa'])){
         ?>
        Từ khoá tìm kiếm: <?php echo $_GET['tukhoa'];?>
    <?php }else{ ?>
        Trang chủ - Shop trái cây tươi sạch.
    <?php } ?>
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="Index_css/style.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
  
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include('banner-slider/slider.php') ?>
        <div id="main"> 
            <?php include('sidebar/sidebar2.php') ?>
            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
      <div class="main-content">
           <?php include('main-content/main-content.php') ?>
            </div>
        </div>
         <?php include('sidebar/sidebar.php') ?>
      </div>
      <div class="clear"></div>
        </div>
     </div>
     <img class="img img-responsive" width="100%" src="img/istockphoto-515673754-612x612.jpg" style="height: 609px">
  <!-- script -->
    <script src="js/jquery-1.11.1.min.js"></script>

      <?php include('banner-slider/slider-script.php') ?>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

      <?php include('login/script.php') ?>
</body>
</html>
<?php 
    include ('footer.php'); 
?>