<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['signup']))
{
    // Tạo Student ID tự động
    $count_my_page = ("studentid.txt");
    $hits = file($count_my_page);
    $hits[0]++;
    $fp = fopen($count_my_page , "w");
    fputs($fp , "$hits[0]");
    fclose($fp); 
    $StudentId = $hits[0];   
    
    $fname = $_POST['fullanme'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email']; 
    $password = md5($_POST['password']); 
    $status = 1;

    $sql = "INSERT INTO tblstudents(StudentId, FullName, MobileNumber, EmailId, Password, Status) 
            VALUES(:StudentId, :fname, :mobileno, :email, :password, :status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo '<script>alert("Bạn đã đăng ký thành công , mã đăng ký của bạn là '.$StudentId.'")</script>';
    }
    else 
    {
        echo "<script>alert('Có lỗi xảy ra , vui lòng thử lại !');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký người dùng</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f7f7f7;
    }
    .register-form {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-top: 40px;
    }
    .form-group i {
      position: absolute;
      top: 12px;
      left: 15px;
      color: #999;
    }
    .form-control {
      padding-left: 35px;
    }
    .btn-custom {
      background-color: #e74c3c;
      border: none;
    }
    .btn-custom:hover {
      background-color: #c0392b;
    }
    label {
      font-weight: 600;
    }
  </style>
  <script type="text/javascript">
    function valid() {
      if(document.signup.password.value != document.signup.confirmpassword.value) {
        alert("Mật khẩu và Nhập lại mật khẩu không khớp!");
        document.signup.confirmpassword.focus();
        return false;
      }
      return true;
    }

    function checkAvailability() {
      $("#loaderIcon").show();
      jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#emailid").val(),
        type: "POST",
        success: function(data){
          $("#user-availability-status").html(data);
          $("#loaderIcon").hide();
        },
        error:function(){}
      });
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="register-form">
          <h4 class="text-center mb-4">Đăng ký người dùng</h4>
          <form name="signup" method="post" onSubmit="return valid();">

            <div class="form-group position-relative">
              <label>Họ và tên </label>
              <input type="text" name="fullanme" class="form-control" required>
            </div>
            <div class="form-group position-relative">
              <label>Số điện thoại</label>
              <input type="text" name="mobileno" maxlength="10" class="form-control" required>
            </div>

            <div class="form-group position-relative">
              <label>Email </label>
              <input type="email" name="email" id="emailid" class="form-control" onBlur="checkAvailability()" required>
              <span id="user-availability-status" style="font-size:12px;"></span>
            </div>

            <div class="form-group position-relative">
              <label>Mật khẩu </label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group position-relative">
              <label>Nhập lại mật khẩu </label>
              <input type="password" name="confirmpassword" class="form-control" required>
            </div>

            <button type="submit" name="signup" class="btn btn-custom btn-block">Đăng ký</button>
            <a href="index.php" class="btn btn-secondary btn-block mt-2">Quay về trang đăng nhập</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
