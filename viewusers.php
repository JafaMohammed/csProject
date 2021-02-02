<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "details";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        body {
          background: url("../img/desert_1.jpg") ;
          no-repeat center center fixed;
          background-size: cover;
          font-size: 16px;
          font-family: 'Lato', sans-serif;
          font-weight: 300;
          margin: 0;
          color: #666;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <h1>View Users</h1>

<div style="margin:40px;">
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First name</th>
      <th scope="col">Last Name</th>
        <th scope="col">User Type</th>
        
      <th scope= "col">Delete </th>
    
    </tr>
  </thead>
  <tbody>
 <?php 
      
       $insert= "SELECT id,fname,lname,User_type FROM users";
      $result = $conn->query($insert);
          while($row = $result->fetch_assoc()) {
     
          echo "<tr><td>".$row["id"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["User_type"]."</td>
          <td><input type='submit' value='delete' name='delete'></td></tr>";
           
    
          }
      ?>
      
      <?php
     /* if(isset($_POST['delete'])){
           $delete= "Delete from users where id= $row['id']";
            if ($conn->query($delete) === TRUE) {
               echo "item deleted";
        }
          else {
      echo "Error: " . $delete . "<br>" . $conn->error;
  }     
  }
      */      
 ?>
  </tbody>
</table>
</div>
<br>
<br>


  <li><a href="logout.php">Logout</a></li>
    </div>
</body>
</html>
