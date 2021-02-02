<?php
function connect(){
 $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'details';
        
       
        $db =  mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
        if($db->connect_error){
        die("connection failed: ".$db->connect_error);

        }else{
        	// echo "SUCCESS";
        }
        return $db;	
}

function insert($item,$image,$price){ 
       $db=connect();
         $insert = $db->query("INSERT into `admin_entry` (`Eventname` ,`image`, `Price`) VALUES ('$item','$image','$price');");
        if($insert){
            echo "File uploaded successfully.";
        }

    }
function insertcheckID($checkout){
  $conn = connect();
  $sql = "INSERT into `mpesa` (`checkoutid`) VALUES ('".$checkout."')";

  if($conn->query($sql)===true) {
    echo "ID GOTTEN";
  }else {
    echo "FAILURE";
  }

}

function selectID(){
  $conn = connect();
  $sql = "SELECT `checkoutid` FROM `mpesa` WHERE `id`=(SELECT max(`id`) FROM `mpesa`)";
  $res = $conn->query($sql);

  if ($conn->query($sql)) {
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
      $id = $row['checkoutid'];
     }
    }
    return $id;
  }


  


function mysql_get_var($query,$y=0){
$conn=connect();
       $res = mysqli_query($conn,$query);
       $row = mysqli_fetch_array($res);
       mysqli_free_result($res);
       $rec = $row[$y];
       return $rec;
}
function getData($sql){
$conn=connect();
$result=mysqli_query($conn,$sql);
$rowData=array();
echo '<table border="0" cellspacing="2" cellpadding="3"> 
      <tr> 
          <td> <font face="Arial">Eventname</font> </td> 
          
           <td> <font face="Arial">Image</font> </td>
          <td> <font face="Arial">Price</font> </td> 
          <td> <font face="Arial">Category</font> </td>

      </tr>';
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $rowData[]=$row;
                }
                for($i=0;$i<count($rowData);$i++){
                                echo '<tr> ';
                                foreach($rowData[$i] as $key=>$value){
                                                echo '<td>'.$value.'</td> ';

                                }
                                echo '</tr>';
                }
                                
    }
/*freeresultset*/
$result->free();
}
function getDataorder($sql){
$conn=connect();
$result=mysqli_query($conn,$sql);
$rowData=array();
echo '<table border="0" cellspacing="2" cellpadding="3" fontsize="8"> 
      <tr> 
          <td> <font face="Arial">ID</font> </td> 
          <td> <font face="Arial">Username</font> </td> 
          <td> <font face="Arial">Total Price</font> </td> 
          <td> <font face="Arial" >Order id</font> </td>  
      </tr>';
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $rowData[]=$row;
                }
                for($i=0;$i<count($rowData);$i++){
                                echo '<tr> ';
                                foreach($rowData[$i] as $key=>$value){
                                                echo '<td>'.$value.'</td> ';
                                }
                                echo '</tr>';
                }
                                
    }
/*freeresultset*/
$result->free();
}

        ?>