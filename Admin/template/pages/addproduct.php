<?php 
require('function.php');
if(!isset($_SESSION['login'])){
  header('Location: sign-in.php');
}
?>
<?php
require_once ('../../../db/dbhelper.php');

$id = $price = $title = $thumbnail = $status = $content = $id_category = '';
if(!empty($_POST)) {
	if(isset($_POST['title'])) {
		$title = $_POST['title'];
		$title = str_replace('"', '\\"', $title);
	}
	if(isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if(isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"', '\\"', $price);
	}
	if(isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}
	if(isset($_POST['status'])) {
		$status = $_POST['status'];
		$status = str_replace('"', '\\"', $status);
	}
	if(isset($_POST['content'])) {
		$content = $_POST['content'];
		$content = str_replace('"', '\\"', $content);
	}
	if(isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
		$id_category = str_replace('"', '\\"', $id_category);
	}

	if(!empty($title)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//luu vao database
		if($id == '') {
			$sql = 'insert into product(title, thumbnail, status_pro, price, content, id_category ,created_at, updated_at) values ("'.$title.'", "'.$thumbnail.'", "'.$status.'", "'.$price.'", "'.$content.'", "'.$id_category.'", "'.$created_at.'", "'.$updated_at.'")';
		} else {
			$sql = 'update product set title = "'.$title.'", updated_at = "'.$updated_at.'", thumbnail = "'.$thumbnail.'", status_pro = "'.$status.'", price = "'. $price.'", content = "'.$content.'", id_category = "'.$id_category.'" where id = '.$id;
		}
		
		    execute($sql);

		    header('Location: product.php');
		    die();
	}

}


if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from product where id = '.$id;
	$product = executeSingleResult($sql);
	if($product != null) {
		$title       = $product['title'];
		$price       = $product['price'];
		$thumbnail   = $product['thumbnail'];
		$status 		 = $product['status_pro'];
		$id_category = $product['id_category'];
		$content     = $product['content'];
	}
}
?>

<?php 
include('header.php');
?>

  <title>
   Thêm/sửa sản phẩm
  </title>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="name">Tên Sản Phẩm:</label>
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					  <input required="true" type="text" class="form-control" id="title" name="title" value="<?=$title?>">
					</div>
					<div class="form-group">
					  <label for="price">Chọn Danh Mục:</label>					 
					  <select class="form-control" name="id_category" id="id_category">
					  	<option>-- Lựa chọn danh mục --</option>
<?php
$sql = 'select * from category';
$categoryList = executeResult($sql);

foreach ($categoryList as $item) {
	if($item['id'] == $id_category) {
		echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
	} else {
		echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
	}
}
?>					  	
					  </select>
					</div>	
					<div class="form-group">
					  <label for="price">Giá Bán:</label>			 
					  <input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
					</div>			
					<div class="form-group">
					  <label for="thumbnail">Thumbnail:</label>					 
					  <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumpnail()">
					  <img src="<?=$thumbnail?>" style="max-width: 200px;margin-left: 400px;margin-top: 25px;"id="img_thumbnail">
					</div>	

					<div class="form-group">
					  <label for="status">Chọn trạng thái(0: Hết hàng, 1: Còn hàng):</label>					 
					  <input type="number" required="trues" id="status" name="status" min="0" max="1" value="<?=$status?>">
					</div>	

					<div class="form-group">
					  <label for="content">Nội dung:</label>					 
					 <textarea class="form-control" style="resize: none" rows="5" name="content"><?=$content?></textarea>
					</div>		
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>						
		</div>
	</div>

	<!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript" ></script>

  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

   <script>
           CKEDITOR.replace( 'content' );
   </script>

</body>
<?php 
include ('footer.php');
?>
</html>