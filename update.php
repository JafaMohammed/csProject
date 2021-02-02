<?php 


       session_start();
        require('function.php');
       $db=connect();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
         ?>
<!DOCTYPE html>
<html>
<head>
	<title>#NoMail</title>
  <link href="C:\xampp\htdocs\template\css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
    body {
  background-image: url("backg.jpg");
  background-repeat: no-repeat;
  background-color: #cccccc;
  height: 500px; 
  background-position: center; 
  background-size: cover; 
}

/* Profile Content */
.profile-content {
  padding: 40px;
  background: #fff;
  min-height: 460px;
  margin-left: 300px;
}
table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 23px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
  .login-form .group label .icon{
    width:15px;
    height:15px;
    border-radius:2px;
    position:relative;
    display:inline-block;
    background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
    content:'';
    width:10px;
    height:2px;
    background:#fff;
    position:absolute;
    transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
    left:3px;
    width:5px;
    bottom:6px;
    transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
    top:6px;
    right:0;
    transform:scale(0) rotate(0);
}
  </style>
</head>
<body>




  <?php
 
$msg = '';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $price = $_POST["price"];
  $item = $_POST["Eventname"];
  $code = $_POST["code"];
 // Get image name
    $image = $_FILES['image']['name'];
    // image file directory
    $target = "product-images/".basename($image);
    
  $categ=$_POST["category"];
    $db=connect();
    $sql = "UPDATE `admin_entry` SET code='$code',Price='$price', image='$image', category='$categ' WHERE Eventname='$item'";
      if (mysqli_query($db, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($db);
}

mysqli_close($db);
 }
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="admin.png" width="80px" height="80px">
      <a class="navbar-brand" href="#">#NoMail</a> 
    </div>
    <ul class="nav navbar-nav">
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile_admin.php"><span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

  <div class="col-md-9">
        <div class="profile-content">

	<form  action="" method="post" enctype="multipart/form-data">
      <h1 style="text-align: center;">Update Events already created</h1>
   <hr style=" border: 1px solid #f1f1f1;margin-bottom: 25px;">
   <div > 
  <label for="code" >Event Name</label>
     <select name="Eventname"  >
        <?php 
        $sql = mysqli_query($db, "SELECT Eventname FROM admin_entry");
         while ($row = $sql->fetch_assoc()){
         echo "<option >" . $row['Eventname'] . "</option>";
         }
         ?>
        
        </select><br><br>
</div>
           <div class="form-group" >
    <label for="code">Event Code</label>
    <input type="text" class="form-control" name="code" aria-describedby="Eventname" placeholder="Enter Product Code">
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
           <div class="form-group" >
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" aria-describedby="Eventname" placeholder="Enter Price" value="0">
           </div>
             <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="image">Upload</span>
  </div>
  <div class="form-group">
    <input type="file" class="custom-file-input" name="image" aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>
     <!-- <label  for="code" style="color: red;"><b>Event code</b></label>
      <input type="text" placeholder="Enter product code " name="code" ><br><br><br>

      <label for="price" style="margin-right: 65px;color: red;"><b>Price</b></label>
      <input type="number" placeholder="Enter price " name="price" value="0" ><br><br><br>
      
-->

  
    

    <div class="form-group">
    <input type="hidden" name="inserth" id="inserth" value="inserth">
    <input type="submit" value="Update" id="insert" class="registerbtn" style="background-color: #2055E6;color: white;padding: 16px 20px;margin-left:300px;border: none;cursor: pointer;width: 50%;opacity:0.9;"></div>
  <br>
   <hr>
  
</form>
</div>
</div>

</body>
</html>