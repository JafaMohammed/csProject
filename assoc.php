<?php 
require('function.php');
$db=connect();
       session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// echo "<pre>";
// print_r([$_POST]);
// echo "</pre>";

 if(isset($_POST['count'])){
            if(!($_SESSION['count'])){
                $_SESSION['count'] = 1;
            }else{
                $count = $_SESSION['count'] + 1;
                $_SESSION['count'] = $count;
            }
        }
        // echo $_SESSION['count'];       
          ?>
<!DOCTYPE html>
<html>
<head>
	<title>#NoMail</title>
  <link href="C:\xampp\htdocs\webapp\Tutorhub\css" rel="stylesheet">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body {
  background-image: url("backg4.jpg");
  background-repeat: no-repeat;
  background-color: #cccccc;
  height: 500px; 
  background-position: center; 
  background-size: cover; 
}
  </style>
 
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="admin.png" width="80px" height="80px" ">
     <!--  <a class="navbar-brand" href="#">Pizza Tavern</a> -->
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
       <li><a href="index.php" type="button" class="btn btn-default btn-sm" style="margin-top:9px;padding: none;">
          <span class="glyphicon glyphicon-shopping-cart"></span>Order Cart <?php echo "<span style=\"color:#fff; border-style: solid;
  border-width: 2px;
  font-size:8px;
  border-color: red;
  border-radius: 50%;
  background-color:red;

  width: 18px;
  height: 18px;
  line-height: 20px;
  top: -12px;
  color: #64686d;\">"; echo $_SESSION['count']; echo "</span>"; ?>
        </a>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	<form action="" method="post">
  <div class="container">
    <img src="imagedatabase\chefb.png" width="80px" height="80px" style="margin-left:500px; ">
    <h1 style="text-align: center;">Welcome to #NoMail</h1>
    <hr style=" border: 1px solid #f1f1f1;margin-bottom: 25px;">
    <div style="margin-left: 600px;">

      <label for="Eventname" style="margin-right: 25px;color: red;"><b>Eventname</b></label>
      <select name="Eventname">
        <?php 
        $sql = mysqli_query($db, "SELECT Eventname FROM admin_entry");
         while ($row = $sql->fetch_assoc()){
         echo "<option >" . $row['Eventname'] . "</option>";
         }
         ?>
        
        </select><br><br><br>
        

      <label for="num1" style="margin-right: 25px;color: red;"><b>Quantity</b></label>
      <input type="number" placeholder="Enter number " name="num1" value="0" ><br><br><br>

       
   </div>
    


<input name="count" value="1" type="hidden">
    <button type="submit" value="post" class="registerbtn" style="background-color: #2055E6;color: white;padding: 16px 20px;margin-left:300px;border: none;cursor: pointer;width: 50%;opacity:0.9;">Order</button>
  </div><br>
   <hr>
  
</form>
	 <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>

    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

</body>
</html>