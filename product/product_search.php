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
$ItemCode = $_POST['ItemCode'];  //echo $ItemCode;
$ItemDescription = $_POST['ItemDescription'];  //echo $ItemDescription;
$Brand = $_POST['Brand'];  //echo $Brand;
$ItemType = $_POST['ItemType'];  //echo $ItemType;
$wBatch = $_POST['wBatch']; 
$Location = $_POST['Location'];
$isWatch = $_POST['isWatch'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//detect button "insert" or "search"
if($_POST["buttonType"] == 'Insert'){
    insert();
}
else if($_POST["buttonType"] == 'Search'){
    search();
}
else{
    echo "Error";
}


function insert(){
    global $conn,$ItemCode,$ItemDescription,$isWatch, $wBatch, $Brand,$ItemType,$Location;
    $sql = "insert into product
            values ('".$ItemCode."', '".$ItemDescription."', '".$ItemType."', '".$Brand."', '".$Location."', '".$isActive."','".$wBatch."');";
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
}

function search(){
    global $conn,$ItemCode,$ItemDescription, $isWatch, $wBatch, $Brand,$ItemType,$Location;
    if($ItemCode &&$Brand){
        $sql1 = "select * from product
         where Brand = '".$Brand."' AND ItemCode = '".$ItemCode."';";
    }
    
    else if($Brand){
        $sql1 = "select * from product where Brand = '".$Brand."';";
    } 
    else if($ItemCode){
        $sql1 = "select * from product where p.ItemCode = '".$ItemCode."';";
    }
    
    else if($ItemType){
        $sql1 = "select * from product where ItemType = '".$ItemType."';";           
    } 
    
    else if($ItemDescription){
        $sql1 = "select * from product where ItemDescription = '".$ItemDescription."';";   

    }  
      

    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        echo 
           "<table class=\"table\">
            <tr>
            <th>Product Detail</th>
            </tr>
            <tbody>
              <tr> <td>ItemCode </td> <td>ItemDescription </td> <td>ItemType </td> <td>Brand </td> <td>Location </td><td>isActive</td><td>wBatch</td> </tr>
           ";
        while($row = mysqli_fetch_assoc($result1)) {
            echo           
              "
               <td>".$row['ItemCode']."</td> <td>".$row["ItemDescription"]."</td>
               <td>".$row["ItemType"]."</td><td>".$row["Brand"]."</td><td>".$row["Location"]."</td>
               <td>".$row["isActive"]."</td><td>".$row["wBatch"]."</td></tr>
               ";    
        }
        echo"
        </tbody>
        </table>";
    }else {
        echo "Failed to find Product record";
    }
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





mysqli_close($conn);
?> 
</div>

</body>
</html>
