        <?php
        if(isset($_GET['tukhoa'])){
         ?>
        <h3>Từ khoá tìm kiếm: <?php echo $_GET['tukhoa'];?></h3>
    <?php }else{ ?>
        <h3>Sản phẩm của chúng tôi:</h3>
    <?php } ?>
        <div class="row">
       <!--   <ul class="product_list"> -->
                <?php 
                 $limit = 12;
                $page  = 1;
                if (isset($_GET['page'])){
                  $page = $_GET['page'];
                }
                if($page <= 0) {
                  $page = 1;
                }
                $firstIndex = ($page-1)*$limit;
                $s = '';
                if(isset($_GET['tukhoa'])){
                  $s = $_GET['tukhoa'];
                }
                $additional = '';
                if(!empty($s)){
      $additional = ' and title like "%'.$s.'%" ';
    } 
          $sql = 'select product.id, product.title, product.price, product.thumbnail, product.status_pro, product.id_category, product.updated_at, category.name category_name from product left join category on product.id_category = category.id where 1'.$additional.' limit '.$firstIndex.','.$limit;
          $productList = executeResult($sql);

          $sql = 'select count(id) as total from product where 1'.$additional;
            $countResult = executeSingleResult($sql);
            $number = 0;
            if($countResult != null) {
            $count = $countResult['total'];
            $number = ceil($count/$limit);
            }
            $index = 1;
            
          foreach ($productList as $item) {
           ?>
                  <div class="col-md-3">
                 <div class="productlist">
                  <?php if($item['status_pro']==0){?>
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product"><?php echo $item['title'] ?></p>
                            <p class="price_product">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
                                <div class="out-of-stock-label">Hết hàng</div>

                               <?php }else{ ?>

                                <a href="detail.php?id=<?php echo $item['id'] ?>&id_category=<?php echo $item['id_category'] ?>" style="text-decoration: none;" title="xem sản phẩm">
                            <img class="img img-responsive" width="100%" src="<?php echo $item['thumbnail'] ?>">
                            <p class="title_product"><?php echo $item['title'] ?></p>
                            <p class="price_product">Giá:<?php echo number_format($item['price'],0,',','.') .' vnđ' ?></p>
                        </a>
                         <form method="POST" action="cart.php?id=<?php echo $item['id'] ?>"> 
                               <a href="#" title="Thêm vào giỏ">
             <button class="addcart" type="submit" name="themgiohang">+<i class="fa fa-shopping-cart"></i></button>   
                                 </a>
             </form>       
                        <?php  } ?>
                 </div>
                    </div> 
       <?php  } ?>
             
            <!--     </ul> -->
                </div>
          <div class="clear"></div>
          <div style="text-align:center"><?=paginarion($number, $page, '')?></div>
        <?php include('video.php') ?>
