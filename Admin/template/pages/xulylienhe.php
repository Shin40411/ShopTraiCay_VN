<?php
require_once ('../../../db/dbhelper.php');

$thongtinlienhe = $_POST['thongtinlienhe'];
$id = $_GET['id'];

if(isset($_POST['submitlienhe'])){
	//sua
	$con=mysqli_connect("localhost","root","","shophq");
	$sql_update = mysqli_query($con,"UPDATE contact SET contactdetail='".$thongtinlienhe."' WHERE id='$id' ");
	header('Location:contact.php');
}

?>