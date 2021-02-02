<?php 


       session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
         ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
  <link href="C:\xampp\htdocs\template\css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
    body {
  background-image: url("background.jpg");
  
  background-color: #cccccc;
  height: 2000px; 
  background-position: center; 
  background-size: cover; 
}
  </style>
</head>
<body>
  <?php
  require('function.php');
$msg = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $price = $_POST["price"];
  $item = $_POST["Eventname"];
  $code = $_POST["code"];
   $desc = $_POST["description"];
   $categ = $_POST["category"];
   // Get image name
    $image = $_FILES['image']['name'];
    // image file directory
    $target = "product-images/".basename($image);
    
    $db=connect();
         $insert ="INSERT into `admin_entry` (`Eventname` ,`code`,`image`,`description`, `Price`,`category`) VALUES (?,?,?,?,?,?);";
    
 if($stmt = mysqli_prepare($db, $insert)){
    

    mysqli_stmt_bind_param($stmt,'ssssss',$param_item,$param_code,$param_img, $param_desc,$param_price,$param_categ);
    $param_item=$item;
    $param_code=$code;
    $param_img=$image;
    $param_desc=$desc;
    $param_price=$price;
    $param_categ=$categ;
    mysqli_stmt_execute($stmt);

    $check = mysqli_stmt_affected_rows($stmt);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
    mysqli_close($db);
}}
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="logo1.jpg" width="100px" height="80px" ">
     <!--  <a class="navbar-brand" href="#">Pizza Tavern</a> -->
    </div>
    <ul class="nav navbar-nav">
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile_admin.php"><span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

<form  action="" method="post" enctype="multipart/form-data">
  
 <div class="container">
    <img src="admin.png" width="80px" height="80px" style="margin-left:500px; ">
    <h1 style="text-align: center;">ADMIN #NoMail</h1>
    <hr style=" border: 1px solid #f1f1f1;margin-bottom: 25px;">

  <div class="form-group" >
    <label for="exampleInputEmail1">Event Name</label>
    <input type="text" class="form-control" name="Eventname" aria-describedby="Eventname" placeholder="Enter Event Name">
    <small id="Eventname" class="form-text text-muted">Will appear on student end</small>
  </div>
   <div class="form-group" >
    <label for="exampleInputEmail1">Event Code</label>
    <input type="text" class="form-control" name="code" aria-describedby="code" placeholder="Enter Event Code">
    <small id="code" class="form-text text-muted">Will appear on student end</small>
  </div>
  <div class="form-group">
<p>
   <label for="exampleInputEmail1">Choose</label>
<select name="category"  class="btn btn-primary">
  <option value="">Category...</option>

  <option name="sports">Sports</option>

  <option name="music">Music</option>

  <option name="talks">Talks</option>

    <option name="others">Others</option>
</select>

</p>

</div>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Kshs</span>
    <span class="input-group-text">0.00</span>
    <small id="price" class="form-text text-muted">Will appear on student end</small>
  </div>
  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price">
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" name="description" rows="3"></textarea>
  </div>
</form>

  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="image">Upload</span>
  </div>
  <div class="form-group">
    <input type="file" class="btn btn-primary" name="image" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>
  <button type="submit" class="btn btn-primary"value="Insert" id="insert" >Submit</button>
</form>
 <hr style=" border: 1px solid #f1f1f1;margin-bottom: 25px;">


	
 
</body>
</html>
<!-- <?php
require('functions.php');

echo "<pre>";
print_r([$_POST]);
echo "</pre>";
$price = $_POST["price"];
$item = $_POST["Eventname"];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $imagebs64 = $_FILES['image']['tmp_name'];
    $img =addslashes(file_get_contents($imagebs64));
insert($item,$img,$price);

}  
        

 ?>  -->