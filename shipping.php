<?php 
session_start();
?> 
<?php 
include ('header.php');
require_once ('db/dbhelper.php');
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
  <title>Giao hàng</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="Index_css/style.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <?php if(isset($_SESSION['dangky'])){ ?>
    <?php if(isset($_SESSION['cart'])){ ?>
    <div class="container-fluid">
        <div class="row">
            <?php include('banner-slider/slider.php') ?>
        <div id="main-products">   
          <?php include('sidebar/sidebar2.php') ?>
            <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12">
        <div class="main-detail">
           <?php
  if(isset($_SESSION['dangky'])){
    echo '<i class="fa fa-shopping-cart" aria-hidden="true" style="margin-left: 5px;"></i>: '.'<span style="color:red">'.$_SESSION['dangky'].'</span>';
  } 
  ?>
          <h3 style=" text-align: center;">Thông tin giao hàng</h3>

          <style type="text/css">
table {
      border: 1px solid #ccc;
      border-collapse: collapse;
      margin: 0;
      padding: 0;
      width: 100%;
      table-layout: fixed;
    }
table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
    }
table th,
table td {
      background: #00ffff;
      padding: .625em;
    }
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
  @media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
   table tr td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}
</style>

           <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
              <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"><span><a href="giohang.php">Giỏ hàng</a></span></div>
    <div class="step current"> <span>Giao hàng</span> </div>
    <div class="step"> <span>Thanh toán<span> </div>
    <div class="step"> <span>Đơn hàng<span> </div>
  </div>
  <!-- end Responsive Arrow Progress Bar -->
    <div class="clear" style="margin-bottom:1%"></div>
    <?php 
    if (isset($_POST['addvanchuyen'])){
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $addresses = $_POST['addresses'];
    $note = $_POST['note'];
    $id_dangky =  $_SESSION['id_khachhang'];
    $con=mysqli_connect("localhost","root","","shophq");
    $sql_add_vanchuyen = mysqli_query($con,"INSERT INTO shipping(fullname,phone_number,addresses,note,id_dangky) VALUES('$fullname','$phone_number','$addresses','$note','$id_dangky')");
    if($sql_add_vanchuyen){
      echo "<script>alert('Thêm thông tin giao hàng thành công!');</script>";
      }
    }elseif(isset($_POST['updatevanchuyen'])){
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $addresses = $_POST['addresses'];
    $note = $_POST['note'];
    $id_dangky =  $_SESSION['id_khachhang'];
    $con=mysqli_connect("localhost","root","","shophq");
    $sql_update_vanchuyen = mysqli_query($con,"UPDATE shipping SET fullname='$fullname',phone_number='$phone_number',addresses='$addresses',note='$note',id_dangky='$id_dangky' WHERE id_dangky='$id_dangky'");
    if($sql_update_vanchuyen){
      echo "<script>alert('Cập nhật thông tin giao hàng thành công!');</script>";
      }
    }
    ?>
    <div class="row">
      <?php
       $id_dangky =  $_SESSION['id_khachhang'];
      $sql_getvanchuyen = mysqli_query($con,"SELECT * FROM shipping WHERE id_dangky='$id_dangky' LIMIT 1");
      $count = mysqli_num_rows($sql_getvanchuyen);
      if($count>0){
    $row_getvanchuyen = mysqli_fetch_array($sql_getvanchuyen);
    $fullname  = $row_getvanchuyen['fullname'];
    $phone_number     = $row_getvanchuyen['phone_number'];
    $addresses = $row_getvanchuyen['addresses'];
    $note      = $row_getvanchuyen['note'];
      }else{
    $fullname  = '';
    $phone_number     = '';
    $addresses = '';
    $note      = '';
      }
      ?>
      <div class="col-md-12">
  <form action="" autocomplete="OFF" method="POST">
  <div class="form-group">
    <label for="email">Họ và tên:</label>
    <input type="text" name="fullname" required="" class="form-control" value="<?php echo $fullname ?>" placeholder="Họ tên người nhận...">
  </div>
  <div class="form-group">
    <label for="email">Số điện thoại:</label>
    <input type="text" name="phone_number" required="" class="form-control" value="<?php echo $phone_number ?>" placeholder="SĐT để liên hệ...">
  </div>
  <div class="form-group">
    <label for="email">Địa chỉ:</label>
    <input type="text" name="addresses" required="" class="form-control" value="<?php echo $addresses ?>" placeholder="Địa chỉ người nhận...">
  </div>
    <div class="form-group">
    <label for="email">Ghi chú:</label>
    <textarea type="text" name="note" class="form-control" placeholder="Ghi chú khi đặt hàng..."><?php echo $note ?></textarea>
  </div>
  <?php 
  if($fullname=='' && $phone_number==''){
  ?>
  <button type="submit" name="addvanchuyen" class="btn btn-success">Thêm thông tin giao hàng</button>
  <?php 
  }elseif($fullname!='' && $phone_number!=''){
  ?>
   <button type="submit" name="updatevanchuyen" class="btn btn-primary">Cập nhật thông tin giao hàng</button>
  <?php 
  }
  ?>
</form>
    </div>
      <!-- Giỏ hàng -->
      <table style="text-align:center;width: 100%;border-collapse: collapse;margin-top:2%" border="1">
            <thead>
          <tr>
            <th class="text-center" style="vertical-align: middle;">STT</th>

            <th class="text-center" style="vertical-align: middle;">Tên sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;">Số lượng</th>

            <th class="text-center" style="vertical-align: middle;">Giá</th>

            <th class="text-center" style="vertical-align: middle;">Mã sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;">Hình ảnh</th>
            
            <th class="text-center" style="vertical-align: middle;">Thành tiền</th>
  
          </tr>
          </thead>
          <?php
  if(isset($_SESSION['cart'])){
    $i = 0;
    $tongtien = 0;
    foreach($_SESSION['cart'] as $cart_item){
        $thanhtien = $cart_item['soluong']*$cart_item['price'];
        $tongtien = $tongtien+$thanhtien;
        $i++;
  ?>
          <tr>
            <td style="vertical-align: middle; text-align:center"><?php echo $i; ?></td>
           
            <td style="vertical-align: middle; text-align:center"><?php echo $cart_item['title']; ?></td>
            
            <td style="vertical-align: middle; text-align:center">
                
        <?php echo $cart_item['soluong']; ?>
                
            </td>
            
            <td style="vertical-align: middle; text-align:center"><?php echo number_format($cart_item['price'],0,',','.').'vnđ'; ?></td>

            <td style="vertical-align: middle; text-align:center"><?php echo $cart_item['id']; ?></td>
            
            <td style="vertical-align: middle;"><img class="img img-responsive" width="100%" src="<?php echo $cart_item['thumbnail']; ?>"></td>
            
            <td style="vertical-align: middle; text-align:center"><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
          </tr>
  <?php 
    }
  ?>
   <tr>
    <td colspan="7">
        <p style="float: left;margin-top: 8px;">Tổng tiền: <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
         <div style="clear: both;"></div>
            <a href="billinfo.php"><button class="btn btn-danger" style="height:auto;margin-bottom:5px;"><i class="fa fa-credit-card" style='font-size:16px'></i> Thanh toán</button></a>
    </td>
    </tr>
     <?php 
    }
  ?>
        </table>
      <!-- end gio hang -->
  </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <?php include('sidebar/sidebar.php') ?>
      </div>
      <div class="clear"></div>
        </div>
    </div>
  <?php }else{
  echo "<script>alert('Bạn chưa thêm giỏ hàng');</script>";
  echo "<script>setTimeout(\"location.href = 'giohang.php';\",1500);</script>";
}?>
<?php }else{
   echo "<script>alert('Vui lòng đăng nhập');</script>";
  echo "<script>setTimeout(\"location.href = 'giohang.php';\",1500);</script>";
} ?>
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