<!DOCTYPE html>
<html>
<head>
  <title>產品管理</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 新 Bootstrap 核心 CSS 文件 -->
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock";
//$type = $_POST["product"];  //echo $type;
$ItemCode = $_POST["ItemCode"];  //echo $ItemCode;
$ItemDescription = $_POST["ItemDescription"];  //echo $ItemDescription;
$ItemType = $_POST["ItemType"];  //echo $ItemType;
$Brand = $_POST["Brand"];  //echo $Brand;
$Location = $_POST["Location"];  //echo $Location;
$isActive = $_POST["isActive"];  //echo $isActive;
$wBatch = $_POST["wBatch"];  //echo $wBatch;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/*
// sql statement
$sql = "insert into ".$type." values ('".$code."', '".$name."', '".$addr."', '".$cnum."', '".$email."', '".$remark."');";
//$result = mysqli_query($conn, $sql);
if ($conn->query($sql) === TRUE) {
    echo "<script>
             alert('New record created successfully');
             window.history.go(-1);
        </script>";
} else {
    echo "<script>
             alert('Error : Failed to create new record');
               window.history.go(-1);
        </script>";
    //echo "Error: ".$sql."<br>'.$conn->error;
    
}
*/

$sql0 = "delete * from product where ItemCode = '".$ItemCode."';";
    $result0 = mysqli_query($conn, $sql0);
    if (mysqli_num_rows($result0) > 0) {
        while($row = mysqli_fetch_assoc($result0)) {
            echo 
            
            "<table class=\"table\">
            <thead>
            <tr>
            <th>Product Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr> <td>Item Code : </td><td>".$row["ItemCode"]."</td></tr>
            <tr> <td>Item Description :</td><td>".$row["ItemDescription"]."</td></tr>
            <tr> <td>Item Type :</td><td>".$row["ItemType"]."</td></tr>            
            <tr> <td>Brand :</td><td>".$row["Brand"]."</td></tr>
            <tr> <td>Location :</td><td>".$row["Location"]."</td></tr>
            <tr> <td>isActive :</td><td>".$row["isActive"]."</td></tr>
            <tr> <td>wBatch :</td><td>".$row["wBatch"]."</td></tr>
            </tbody>
            </table>";
        }
    }else {
        echo "Failed to create Product record";
    }



/*
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Client Code: " . $row["ClientCode"]. " - Company Name: " . $row["CompanyName"]. " - Address: " . $row["Address"]. " - Contact Number: " . $row["ContactNo"]. " - Email: " . $row["Email"]. " - Remark: " . $row["Remark"]. "<br>";
    }
} else {
    echo "0 results";
}
*/
mysqli_close($conn);
?> 
</div>

</body>
</html>
