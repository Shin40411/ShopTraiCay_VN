<?php 
session_start();
include('db/dbhelper.php');
//themsoluong
if(isset($_GET['cong'])){
		$id=$_GET['cong'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				$_SESSION['cart'] = $products;
			}else{
				$tangsoluong = $cart_item['soluong'] + 1;
				if($cart_item['soluong']<=9){
					
					$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				}else{
					$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				}
				$_SESSION['cart'] = $products;
			}
			
		}
		header('Location:giohang.php');
	}
//trusoluong
	if(isset($_GET['tru'])){
		$id=$_GET['tru'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				$_SESSION['cart'] = $products;
			}else{
				$tangsoluong = $cart_item['soluong'] - 1;
				if($cart_item['soluong']>1){
					
					$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				}else{
					$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
				}
				$_SESSION['cart'] = $products;
			}
			
		}
		header('Location:giohang.php');
	}
//xoa
	if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		foreach($_SESSION['cart'] as $cart_item){

			if($cart_item['id']!=$id){
				$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
			}

		$_SESSION['cart'] = $products;
		header('Location:giohang.php');
		}
	}
//xoatatca
if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
		unset($_SESSION['cart']);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}
//themgiohang
if(isset($_POST['themgiohang'])){
		//session_destroy();
		$id= $_GET['id'];
		$soluong=1;
		$sql ="SELECT * FROM product WHERE id ='".$id."' LIMIT 1";
		 $product = executeSingleResult($sql);
		if($product){
			$new_product=array(array('title'=>$product['title'],'id'=>$id,'soluong'=>$soluong,'price'=>$product['price'],'masp'=>$id,'thumbnail'=>$product['thumbnail']));
			//kiem tra session gio hang ton tai
			if(isset($_SESSION['cart'])){
				$found = false;
				foreach($_SESSION['cart'] as $cart_item){
					//neu du lieu trung
					if($cart_item['id']==$id){
						$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$soluong+1,'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
						$found = true;
					}else{
						//neu du lieu khong trung
						$products[]= array('title'=>$cart_item['title'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'price'=>$cart_item['price'],'masp'=>$cart_item['id'],'thumbnail'=>$cart_item['thumbnail']);
					}
				}
				if($found == false){
					//lien ket du lieu new_product voi product
					$_SESSION['cart']=array_merge($products,$new_product);
				}else{
					$_SESSION['cart']=$products;
				}
			}else{
				$_SESSION['cart'] = $new_product;
			}

		}
		header("Location:".$_SERVER['HTTP_REFERER']);

}

?>