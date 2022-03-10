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
  <title>Phương thức thanh toán</title>
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
          <h3 style=" text-align: center;">Phương thức thanh toán</h3>

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
    <div class="step done"><span><a href="giohang.php" >Giỏ hàng</a></span></div>
    <div class="step done"> <span><a href="shipping.php" >Giao hàng</a></span></div>
    <div class="step current"><span>Thanh toán<span> </div>
    <div class="step"> <span>Đơn hàng<span> </div>
  </div>
  <!-- end Responsive Arrow Progress Bar -->
                      <div class="row"> 

                        <form action="xulythanhtoan.php" method="POST">
                        <?php
                       $id_dangky =  $_SESSION['id_khachhang'];
                      $con=mysqli_connect("localhost","root","","shophq");
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
                        <div class="col-md-8">
                          <h4>Thông tin giao hàng và giỏ hàng</h4>
                          <ul>
                            <li>Họ và tên người nhận: <b><?php echo $fullname ?></b></li>
                             <li>Số điện thoại: <b><?php echo $phone_number ?></b></li>
                              <li>Địa chỉ người nhận: <b><?php echo $addresses ?></b></li>
                               <li>Ghi chú: <b><?php echo $note ?></b></li>
                          </ul>
                                <!-- Giỏ hàng -->
      <table style="text-align:center;width: 100%;border-collapse: collapse;margin-top:2%" border="1">
            <thead>
          <tr>
            <th class="text-center" style="vertical-align: middle;">STT</th>

            <th class="text-center" style="vertical-align: middle;">Tên sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;padding-left:2px">Số lượng</th>

            <th colspan="2" class="text-center" style="vertical-align: middle;">Giá</th>

            <th class="text-center" style="vertical-align: middle;">Mã sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;">Hình ảnh</th>
            
            <th colspan="2" class="text-center" style="vertical-align: middle;">Thành tiền</th>
  
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
           
            <td style="vertical-align: middle; text-align:center; padding-left:2px"><?php echo $cart_item['title']; ?></td>
            
            <td style="vertical-align: middle; text-align:center; padding-left:1px">
               
        <?php echo $cart_item['soluong']; ?>
                
            </td>
            
            <td colspan="2" style="vertical-align: middle; text-align:center; padding-left:1px"><?php echo number_format($cart_item['price'],0,',','.').'vnđ'; ?></td>

            <td style="vertical-align: middle; text-align:center"><?php echo $cart_item['id']; ?></td>
            
            <td style="vertical-align: middle;"><img class="img img-responsive" width="100%" src="<?php echo $cart_item['thumbnail']; ?>"></td>
            
            <td colspan="2" style="vertical-align: middle; text-align:center; padding-left:1px"><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
          </tr>
  <?php 
    }
  ?>
  <?php
  }else{ 
  ?>
            <tr>
    <td colspan="8"><p style="line-height:43px;">Hiện tại giỏ hàng trống!!!</p></td>
            </tr>
  <?php
  } 
  ?>
        </table>
                        </div>
                         <div class="col-md-4">
                           <h4>Phương thức thanh toán</h4>
                           <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="Tiền mặt" checked>
                            <label class="form-check-label" style="padding-left:20px" for="exampleRadios1">
                              Tiền mặt
                            </label>
                          </div>
                          <div class="form-check" style="margin-top:25px">
                            <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="Chuyển khoản ATM">
                            <label class="form-check-label" style="padding-left:20px" for="exampleRadios2">
                              Chuyển khoản
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" style="margin-top:28px" id="exampleRadios3" value="vnpay">
                            <img src="img/vnpaylogo.jpg" height="70" width="40%" style="margin-left:8px"> 
                          </div>
                           <p style="float: left;margin-top: 8px;">Tổng tiền: <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
                          <input type="submit" value="Thanh toán ngay" name="redirect" id="redirect" class="btn btn-danger"> 
                         </div>
                       </form>
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
   echo "<script>alert('Bạn cần đăng nhập');</script>";
  echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
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