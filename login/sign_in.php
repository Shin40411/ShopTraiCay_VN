  <?php
  if(isset($_POST['dangnhap'])){
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $con=mysqli_connect("localhost","root","","shophq");
    $sql = "SELECT * FROM signup WHERE phone='".$phone."' AND passwords='".$password."' LIMIT 1";
    $row = mysqli_query($con,$sql);
    $count = mysqli_num_rows($row);

    if($count>0){
      $row_data = mysqli_fetch_array($row);
      $_SESSION['dangky'] = $row_data['name'];
      $_SESSION['phone'] = $row_data['phone'];
      $_SESSION['id_khachhang'] = $row_data['id_signup'];
    echo "<script>alert('Đăng nhập thành công.');</script>";
    echo "<script>setTimeout(\"location.href = 'giohang.php';\",1500);</script>";
      // header("Location:giohang.php");
    }else{ 
     echo '<script language="javascript">';
    echo 'alert("Tài khoản không tồn tại")';
    echo '</script>';
    }
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
    table.dangky tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
    table.dangky tr td {
      background: #00ffff;
      padding: .625em;
    }
     table.dangky tr td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    @media screen and (max-width: 600px) {
  table {
    border: 0;
  }
}
   </style>

<!--Trigger-->

<div class="popup">
<div class="popup-content">
<a href="#"><span class="close-btn">&times;</span></a>
 <h3 style="margin-left: 0px;margin-bottom: 22px;">Đăng nhập thành viên</h3>
    <div class="container-fluid">
     <div class="row">
        <div class="col-md-12">
              <div class="table-responsive">  
        <form action="" method="POST">
<table class="dangky" border="1" style="border-collapse: collapse;">
    <tr>
        <td><input type="text" style="width: 100%;height:40px" name="phone" placeholder="Email của tài khoản..." required=""></td>
    </tr>
    <tr>
        <td><input type="password" style="width: 100%;height:40px"  autocomplete="off" name="password" placeholder="Mật khẩu của tài khoản..." required=""></td>
    </tr>
    <tr>
        <td>
            <button class="btn btn-success" style="border-left-width: 3px;border-top-width: 3px;border-right-width: 3px;border-bottom-width: 3px;width:auto;height:auto;margin-right:3%" type="submit" name="dangnhap">Đăng nhập</button>
             Bạn chưa có tài khoản?<a href="login/sign_up.php"> Đăng ký ngay!</a>
        </td>
      </tr>
</table>
</form>
            </div>
        </div>
    </div>
</div>
</div>
</div>