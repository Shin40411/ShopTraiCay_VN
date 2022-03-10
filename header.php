<?php
  if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['dangky']);
  } 
?>
<?php
require_once ('db/dbhelper.php');
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
 <!--  <link rel="stylesheet" type="text/css" href="Index_css/menu.css"></link> -->

   <link rel="shortcut icon" type="image/png" href="Admin/assets/img/Free.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <?php
// $id='';
// if(isset($_GET['id'])){
//   $id = $_GET['id'];
//   $sql = 'select * from category order by id DESC';
//   $category = executeSingleResult($sql);
// }
  $con=mysqli_connect("localhost","root","","shophq");
  $sql_category = "SELECT * FROM category ORDER BY id DESC";
  $query_category = mysqli_query($con,$sql_category);
?>
<style type="text/css">
  input.form-control.mr-sm-2 {
    width: 72%;
}
.brand{
  color: #0086b3; 
  font-size: 20px;
} 
</style>
  <nav class="navbar navbar-expand-sm navbar-light navbar-fixed-top" style="background-color: #33FF54;margin-bottom: 0px;width:100%">
  <a class="navbar-brand" href="introduce.php"><p class="brand">Shoptraicay.vn</p></a> 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Trang chủ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newspost.php">Tin tức</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="introduce.php">Giới thiệu</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Danh mục
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
        while($row_category = mysqli_fetch_array($query_category)){
        ?>
          <a class="dropdown-item" href="category.php?id=<?php echo $row_category['id'] ?>"><?php echo $row_category['name'] ?></a>
          <?php
        }
           ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="giohang.php">Giỏ hàng</a>
      </li>
       <?php
        if(isset($_SESSION['dangky'])){ 
        ?>
        <li class="nav-item"> <a class="nav-link"  href="lichsudonhang.php">Lịch sử đơn hàng</a></li>
        <li class="nav-item dropdown"> 
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          <i style="font-size:15px" class="fa">&#xf007;</i> <span style="color:red"><?php echo $_SESSION['dangky'] ?></span>
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="giohang.php?dangxuat=1">Đăng xuất tài khoản</a>
        </div>
        </li>
        <?php
        }else{ 
        ?>

        <li class="nav-item"> 
          <a class="nav-link" href="#" id="popup-btn"> Đăng nhập </a>
          <?php include('login/sign_in.php') ?>
        </li>
      <?php
        } 
        ?>
        <form class="form-inline" style="margin-left:20px" action="index.php" method="GET">
      <input class="form-control mr-sm-2" type="search" name="tukhoa" placeholder="Từ khóa sản phẩm..." required="" aria-label="Search">
     <button class="btn btn-success" type="submit"><i style="font-size:15px" class="fa">&#xf002;</i></button>
    </form>
    </ul>
    <ul class="navbar-nav ml-auto">
    </ul>
  </div>
</nav>

