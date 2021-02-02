 <?php
require('functions.php');
require('admin.php');
echo "<pre>";
print_r([$_POST]);
echo "</pre>";
$price = $_POST["price"];
$item = $_POST["fooditem"];
// $image = $_POST["image"];
// $imagebs64=base64_encode($image);
if($_SERVER['REQUEST_METHOD']=='POST'){
    $imagebs64 = $_FILES['image']['tmp_name'];
    $img = file_get_contents($imagebs64);

// if(!empty($_FILES["image"]["tmp_name"]) 
//      && file_exists($_FILES['image']['tmp_name'])) {
//     $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
// echo "string";
}

        // $dbHost     = 'localhost';
        // $dbUsername = 'root';
        // $dbPassword = '';
        // $dbName     = 'pizza';
        
       
        // $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        
      
        // if($db->connect_error){
        //     die("Connection failed: " . $db->connect_error);
        // }
        
        
        insert($item,$imagebs64,$price);
   
        // $insert = $db->query("INSERT into `admin_entry` (`Food_item` ,`image`, `Price`) VALUES ('$item','$imagebs64','$price');");
        // if($insert){
        //     echo "File uploaded successfully.";
        // }

 ?>