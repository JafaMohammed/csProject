<?php
// Initialize the session
session_start();
require('function.php');
require('mpesa.php');
$link=connect();

echo"PRICE IS:".$_SESSION["ksh"];
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$name=$_SESSION["username"];
$spent=$_SESSION["spent"];
$order=$_SESSION["order_id"];
$sql = "INSERT INTO response (username, total_spent,order_id)
VALUES ('$name', '$spent', '$order')";

if ($link->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$_SESSION['cart_item'];

if(isset($_POST['pay'])) {

    $_SESSION['number'] = $_POST['number'];
    //echo $_SESSION['number'];
    //$_SESSION['total'];

    $obj = new mpesa_utils;

    $obj->onlineCheckout($_SESSION['number'],$_SESSION["ksh"]);
    //$obj->transcationStatus();
    //echo $_SESSION['id'];
    header("Location: confirm.php");
}


$link->close();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finish</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
     body {
  background-image: url("background.jpg");
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

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="logo1.jpg" width="80px" height="80px" ">
     <!--  <a class="navbar-brand" href="#">Pizza Tavern</a> -->
    </div>
    <ul class="nav navbar-nav">
      
    
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
       
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
    <div class="page-header" style="text-align:center">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.!<br>
          <p>THE TOTAL PRICE IS: <?php echo $_SESSION["ksh"]; ?></p><br>
        PROCEED TO PAY USING MPESA !</h1>
    </div>

    <form  action="welcome.php" method="post" enctype="multipart/form-data">
       <div class="col-md-9">
            <div class="profile-content">


              <div class="form-group" >
    <label for="code" style="text-align:center;">Enter Phone Number</label>
    <input type="text" class="form-control" name="number" aria-describedby="number" placeholder="Enter Valid Mpesa Phone Number eg 254700111222" value="2547">
           </div>
           <p>
        
        <input type="submit" name="pay"class="btn btn-warning" style="align-content: center;">
    </p>
           <p>
        <a href="index.php" class="btn btn-warning" style="align-content: center;">GO BACK TO STORE</a>
        
    </p>
          </div>
        </div>
      </form>
</body>
</html>