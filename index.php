<?php
session_start();
require_once("dbcontroller.php");

$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM admin_entry WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('Eventname'=>$productByCode[0]["Eventname"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'Price'=>$productByCode[0]["Price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>EVENTS</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
 <link href="C:\xampp\htdocs\webapp\Tutorhub\css" rel="stylesheet">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
       <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</HEAD>
   <style type="text/css">
    body {
  background-image: url("background.jpg");

  background-color: #cccccc;
  height: 1000px; 
  background-position: center; 
  background-size: cover; }
  /* Style the search box inside the navigation bar */
.topnav input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;

}
.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}
.product-item {
	float: left;
	background: #C0E3F4;
	margin: 30px 30px 0px 0px;
	border: #E0E0E0 1px solid;
	height:800px;
	width:600px;
}
.product-image {
width: 300px;
 height:600px;
	
}
.product-title {
	margin-bottom: 20px;
	font-size: 18px;
	font-weight: bold;
	text-align: center;
}
.product-title2 {
	margin-bottom: 20px;
	font-size: 18px;
	
	text-align: center;
}
.product-price {
	float:left;
	font-weight: bold;
	font-size: 18px;
}
  </style>
<BODY><nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="logo1.jpg" width="100px" height="80px" ">
     <!--  <a class="navbar-brand" href="#">Pizza Tavern</a> -->
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.html">Home</a></li>
     
    </ul>
     <ul class="nav navbar-nav navbar-right">
     	<li>
    <div class="topnav">
<input type="text" placeholder="Search..">
</div></li>

   
      <li><a href=""><span class="glyphicon glyphicon-user"></span><?php echo htmlspecialchars($_SESSION["username"]); ?></a></li>
       <li><a href="#" type="button" class="btn btn-default btn-sm" style="margin-top:9px;padding: none;">
          <span class="glyphicon glyphicon-shopping-cart"></span>EVENTS CHOSEN <?php echo "<span style=\"color:#fff; border-style: solid;
  border-width: 2px;
  font-size:8px;
  border-color: red;
  border-radius: 50%;
  background-color:red;

  width: 18px;
  height: 18px;
  line-height: 20px;
  top: -12px;
  color: #64686d;\">"; echo "</span>"; ?>
        </a>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  <div class="container site-section" id="gallery">
        <h1>Upcoming Events</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail"><a data-lightbox="cakes" href="assets/img/founder.png" target="_blank"><img class="img-responsive" src="assets/img/founder.png"></a></div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail"><a data-lightbox="cakes" href="assets/img/img1.jpg" target="_blank"><img class="img-responsive" src="assets/img/img1.jpg"></a></div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail"><a data-lightbox="cakes" href="assets/img/karaoke.jpg" target="_blank"><img class="img-responsive" src="assets/img/karaoke.jpg"></a></div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail"><a data-lightbox="cakes" href="assets/img/kwetu.png" target="_blank"><img class="img-responsive" src="assets/img/kwetu.png"></a></div>
            </div>
             <div class="col-md-4">
                <div class="thumbnail"><a data-lightbox="cakes" href="assets/img/bensoul.png" target="_blank"><img class="img-responsive" src="assets/img/bensoul.png"></a></div>
            </div>
        </div>
    </div>
<div id="shopping-cart">
	<div >
	<label  class="btn btn-primary" >List Content</label> </div>

<a id="btnEmpty" href="index.php?action=empty">Empty List</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;font-size: 20px;">EventName</th>
<th style="text-align:left;font-size: 20px;">Code</th>
<th style="text-align:right;font-size: 20px;" width="5%">Quantity</th>
<th style="text-align:right;font-size: 20px;" width="10%">Unit Price</th>
<th style="text-align:right;font-size: 20px;" width="10%">Price</th>
<th style="text-align:center;font-size: 12px;" width="2%">Remove</th>
</tr>	
<?php
$count=0;		
    foreach ($_SESSION["cart_item"] as $item){
    	$count=$count+2;
    	$_SESSION["count"]=$count;
        $item_price = $item["quantity"]*$item["Price"];
		?>
				<tr>
				<td style="font-size: 20px;"><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["Eventname"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right; "><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "ksh ".$item["Price"]; ?></td>
				<td  style="text-align:right;"><?php echo "ksh ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				
				</tr>
				<?php
				
				
				$total_quantity += $item["quantity"];
				$total_price += ($item["Price"]*$item["quantity"]);
				$order_id=$_SESSION["username"].$total_price.$item["code"];
				$_SESSION["order_id"]=$order_id;
				$_SESSION["spent"]=$total_price;
			
		}

		?><br>
<a href="welcome.php" class="btn btn-danger">Checkout</a>
<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "ksh ".number_format($total_price, 2); $_SESSION["ksh"]=$total_price; ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records" >Your List is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div >
	<label  class="btn btn-primary"  >Events</label> </div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM admin_entry ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">

			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" width="600px" height="600px"></div>
			<div class="product-tile-footer" height="200px">
			<div class="product-title"><?php echo $product_array[$key]["Eventname"]; ?></div>
			<div class="product-title2"><?php echo $product_array[$key]["description"]; ?></div>
			<div class="product-price"><?php
			 echo "ksh".$product_array[$key]["Price"]; 
			 

			?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="BOOK" class="btnAddAction" onclick='window.location.reload(true);'/></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
<script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>
</BODY>
</HTML>