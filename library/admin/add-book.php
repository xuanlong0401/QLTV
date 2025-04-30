<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];
$bookimg=$_FILES["bookpic"]["name"];
$bqty=$_POST['bqty'];
// get the image extension
$extension = substr($bookimg,strlen($bookimg)-4,strlen($bookimg));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
//rename the image file
$imgnewname=md5($bookimg.time()).$extension;
// Code for move image into directory

if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Định dạng file không hợp lệ. Chỉ cho phép  .jpg / .jpeg/ .png /gif');</script>";
}
else
{
move_uploaded_file($_FILES["bookpic"]["tmp_name"],"bookimg/".$imgnewname);
$sql="INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice,bookImage,bookQty) VALUES(:bookname,:category,:author,:isbn,:price,:imgnewname,:bqty)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':imgnewname',$imgnewname,PDO::PARAM_STR);
$query->bindParam(':bqty',$bqty,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Thêm thành công');</script>";
echo "<script>window.location.href='manage-books.php'</script>";
}
else 
{
echo "<script>alert('Có lỗi xảy ra , vui lòng kiểm tra lại ');</script>";    
echo "<script>window.location.href='manage-books.php'</script>";
}}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hệ thống quản lý thư viện trực tuyến | Thêm sách</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript">
    function checkisbnAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'isbn='+$("#isbn").val(),
type: "POST",
success:function(data){
$("#isbn-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script>
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">THÊM SÁCH</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Thông tin sách
</div>
<div class="panel-body">
<form role="form" method="post" enctype="multipart/form-data">

<div class="col-md-6">   
<div class="form-group">
<label>Tên sách<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off"   />
</div>
</div>

<div class="col-md-6">  
<div class="form-group">
<label> Danh mục<span style="color:red;">*</span></label>
<select class="form-control" name="category" >
<option value=""> Chọn danh mục sách</option>
<?php 
$status=1;
$sql = "SELECT * from  tblcategory where Status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
 <?php }} ?> 
</select>
</div></div>

<div class="col-md-6">  
<div class="form-group">
<label> Tác giả<span style="color:red;">*</span></label>
<select class="form-control" name="author" >
<option value=""> Chọn tác giả</option>
<?php 

$sql = "SELECT * from  tblauthors ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
 <?php }} ?> 
</select>
</div></div>

<div class="col-md-6">  
<div class="form-group">
<label>số ISBN <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" id="isbn"  autocomplete="off" onBlur="checkisbnAvailability()"  />
<p class="help-block">Mã số sách chuẩn quốc tế. ISBN phải là duy nhất</p>
         <span id="isbn-availability-status" style="font-size:12px;"></span>
</div></div>

<div class="col-md-6">  
 <div class="form-group">
 <label>Giá<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" autocomplete="off"   />
 </div>
</div>

<div class="col-md-6">  
 <div class="form-group">
 <label>Hình ảnh<span style="color:red;">*</span></label>
 <input class="form-control" type="file" name="bookpic" autocomplete="off"    />
 </div>
    </div>

<div class="col-md-6">  
 <div class="form-group">
 <label>Số lượng<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="bqty" autocomplete="off"   />
 </div>
</div>
<div class="col-md-12"> 
<button type="submit" name="add" id="add" class="btn btn-info">Thêm</button>
</div>
 </div>
</div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
