 <?php
  if(isset($_SESSION['dangky'])){
    echo '<i class="fa fa-shopping-cart" aria-hidden="true" style="margin-left: 5px;"></i>: '.'<span style="color:red">'.$_SESSION['dangky'].'</span>';
  } 
  ?>
      <h3 style=" text-align: center;">Giỏ hàng</h3>
      <?php
      if(isset($_SESSION['cart'])){
      }
      ?>
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
     <?php if(isset($_SESSION['cart'])){ ?>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step current"> <span> Giỏ hàng</span> </div>
    <div class="step"> <span>Giao hàng</span> </div>
    <div class="step"> <span>Thanh toán<span> </div>
    <div class="step"> <span>Đơn hàng<span> </div>
  </div>
  <!-- end Responsive Arrow Progress Bar -->
<?php } ?>
  <div class="clear" style="margin-bottom:1%"></div>
          <table style="text-align:center;width: 100%;border-collapse: collapse;" border="1">
            <thead>
          <tr>
            <th class="text-center" style="vertical-align: middle;">STT</th>

            <th class="text-center" style="vertical-align: middle;">Tên sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;">Số lượng</th>

            <th class="text-center" style="vertical-align: middle;">Giá</th>

            <th class="text-center" style="vertical-align: middle;">Mã sản phẩm</th>

            <th class="text-center" style="vertical-align: middle;">Hình ảnh</th>
            
            <th class="text-center" style="vertical-align: middle;">Thành tiền</th>
  
            <th class="text-center" style="vertical-align: middle;">Xóa sản phẩm</th>
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
                <a href="cart.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
        <?php echo $cart_item['soluong']; ?>
                <a href="cart.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>
            </td>
            
            <td style="vertical-align: middle; text-align:center"><?php echo number_format($cart_item['price'],0,',','.').'vnđ'; ?></td>

            <td style="vertical-align: middle; text-align:center"><?php echo $cart_item['id']; ?></td>
            
            <td style="vertical-align: middle;"><img class="img img-responsive" width="100%" src="<?php echo $cart_item['thumbnail']; ?>"></td>
            
            <td style="vertical-align: middle; text-align:center"><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
            
            <td style="vertical-align: middle; text-align:center"><a href="cart.php?xoa=<?php echo $cart_item['id'] ?>">Xóa</a></td>
          </tr>
  <?php 
    }
  ?>
   <tr>
    <td colspan="8">
        <p style="float: left;margin-top: 8px;">Tổng tiền: <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
        <p style="float: right;margin-top: 9px;"><a href="cart.php?xoatatca=1">Xoá tất cả</a></p>
         <div style="clear: both;"></div>
          <?php
        if(isset($_SESSION['dangky'])){
                      ?>
            <a href="shipping.php"><button class="btn btn-success" ><i class='fa fa-truck' style='font-size:16px'> Giao hàng</i></button></a>
        <?php
        }else{
         ?>
       <a href="shipping.php"><button class="btn btn-danger"><i class='fa fa-truck' style='font-size:16px'> Giao hàng</i></button></a>
         <?php
        }
      ?>
    </td>
    </tr>
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
     <!--  </div> -->
      </div>
    </div>
  </div>