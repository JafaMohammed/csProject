<?php 

//require('mpesa.php');
//include 'mpesa.php';
require_once('function.php');
session_start();


  if (isset($_POST['pay'])){

     header("Location: transaction.php");
  }

   // echo $_SESSION['number'];
    //echo $_SESSION['number'];
    //$_SESSION['total'];

   class mpesa_utils 
 {

  var $secret="jZ3VJKboXAk25uvBwAt0Pqh5S094GXMD"; 
  var $key="bV7deJIeJBj8CVaN";
  var $paybill="174379";
  var $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
  //var $checkoutrequestid = "";

  function genAuthToken($con_secret,$con_key)
  {

     $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
     
    $opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
          "Authorization: Basic ".base64_encode($con_secret.':'.$con_key)."\r\n",
        'timeout' => 60
      )
    );
                       
    $context  = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);

    $decoded_result = json_decode($result, true);

    $access_token = $decoded_result["access_token"];

    return $access_token;

  }

  function passGeneration($paybill_, $passkey_, $timestamp_)
  {
    $password = base64_encode($paybill_.$passkey_.$timestamp_);

    return $password;
  }


  // function onlineCheckout($phone_number,$amount)
  // {
  //   $date = new \DateTime('now');
  //   $timestamp = $date->format('Ymdhis');
  //   $pass_ = $this->passGeneration($this->paybill,$this->passkey,$timestamp);
  //   $access_token = $this->genAuthToken($this->secret, $this->key);

  //   $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  
  //     $curl = curl_init();
  //     curl_setopt($curl, CURLOPT_URL, $url);
  //     curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
      
      
  //     $curl_post_data = array(
  //       //Fill in the request parameters with valid values
  //        "BusinessShortCode"=> $this->paybill,
  //         "Password"=> $pass_,
  //         "Timestamp"=> $timestamp,
  //         "TransactionType"=> "CustomerPayBillOnline",
  //         "Amount"=> $amount,
  //         "PartyA"=> $phone_number,
  //         "PartyB"=> $this->paybill,
  //         "PhoneNumber"=> $phone_number,
  //         "CallBackURL"=> "http://localhost.com",
  //         "AccountReference"=> $phone_number,
  //         "TransactionDesc"=>"Some desc"
  //     );
      
  //     $data_string = json_encode($curl_post_data);
      
  //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //     curl_setopt($curl, CURLOPT_POST, true);
  //     curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      
  //     $curl_response = curl_exec($curl);
      
  //     $response = json_decode($curl_response, true);
      
  //     $checkid = $response["CheckoutRequestID"];

  //     var_dump($response);

  //     echo "<br>"."<br>".$checkid."<br>"."<br>";

  //    insertcheckID($checkid);
  //    }

  //  function transactionStatus()
  //  {
  //   $checkoutrequestid = selectID();

  //   $date = new \DateTime('now');
  // $timestamp = $date->format('Ymdhis');
  //     $pass_ = $this->passGeneration($this->paybill,$this->passkey,$timestamp);

  //   $access_token = $this->genAuthToken($this->secret, $this->key);

  
  //     $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
      
  //     $curl = curl_init();
  //     curl_setopt($curl, CURLOPT_URL, $url);
  //     curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
      
      
  //  $curl_post_data = array(
  //       //Fill in the request parameters with valid values
  //     'BusinessShortCode' => $this->paybill,
  //     'Password' => $pass_,
  //       'Timestamp' => $timestamp,
  //       'CheckoutRequestID' => $checkoutrequestid
  //     );
      
  //     $data_string = json_encode($curl_post_data);
      
  //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //     curl_setopt($curl, CURLOPT_POST, true);
  //     curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
      
  //     $curl_response = curl_exec($curl);
  //    print_r($curl_response);

  //     $response = json_decode($curl_response, true);

  //    var_dump($response);

    //  echo $response["ResultCode"];
      
     //  if ($response["ResultCode"]!="0") {
     //  echo "TRANSACTION FAILED";
     //  }else{
     //    echo "TRANSACTION SUCCESSFUL";
     //  }
     // // echo $curl_response;
     //     }

    // function viewID(){
   // selectID();
    // }
 }

  // $obj = new mpesa_utils;

   // $obj->onlineCheckout($_SESSION['number'],$_SESSION["ksh"]);
  //$obj->transactionStatus();
    //echo $_SESSION['id'];
    //-header("Location: confirm.php");




 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PAYMENT</title>
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
      <img src="logo1.jpg" width="80px" height="80px" >
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
<form  action="confirm.php" method="post" enctype="multipart/form-data">
       <div class="col-md-9">
            <div class="profile-content">


            <div class="form-group" >
    <label for="code" style="text-align:center;">For the Phone Number</label>
    <input type="text" class="form-control" name="number" aria-describedby="number" placeholder="" value=<?php echo $_SESSION['number']; ?> disabled><br><br> 
     <p>
        
        <input type="submit" name="pay"class="btn btn-warning" style="align-content: center;" value="Confirm Transcation">
    </p>
     <p>
        <a href="welcome.php" class="btn btn-warning" style="align-content: center;">GO BACK </a>
        
    </p>
           </div>
