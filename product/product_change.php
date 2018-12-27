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
$ItemCode = $_POST["ItemCode"];  //echo $ItemItemCode;
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

if($_POST["buttonType"] == 'Update'){
    update();
}
else if($_POST["buttonType"] == 'Delete'){
    delete();
}
else{
    echo "Error";
}

function update(){
    global $conn,$ItemCode,$ItemDescription,$isActive, $wBatch, $Brand,$ItemType,$Location;
    $flag=0;
    $sql1 =  "select * from product where ItemCode = '".$ItemCode."';";
    $result1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1) > 0){
        $flag = 1;
    }
    else{
        echo"No such product";
    }
    if($ItemDescription && $ItemType ){
        $sql0 = "update product set ItemDescription = '".$ItemDescription."' ,ItemType = '".$ItemType."' where ItemCode = '".$ItemCode."';";
    }
    else if($Brand && $ItemType ) {
        $sql0 = "update product set Brand = '".$Brand."' , ItemType = '".$ItemType."' where ItemCode = '".$ItemCode."';";
    }
    else if($ItemDescription && $Brand){
        $sql0 = "update product set ItemDescription = '".$ItemDescription."' ,Brand = '".$Brand."'where ItemCode = '".$ItemCode."';";
    }
    else if($ItemType) {
        $sql0 = "update product set ItemType = '".$ItemType."' where ItemCode = '".$ItemCode."';";
    }
    else if($Brand) {
        $sql0 = "update product set Brand = '".$Brand."' where ItemCode = '".$ItemCode."';";
    }
    else if($Location) {
        $sql0 = "update product set Location = '".$Location."' where ItemCode = '".$ItemCode."';";
    }
    else if($isActive) {
        $sql0 = "update product set isActive = '".$isActive."' where ItemCode = '".$ItemCode."';";
    }
    else if($wBatch) {
        $sql0 = "update product set wBatch = '".$wBatch."' where ItemCode = '".$ItemCode."';";
    }
    
    if($flag == 1){
        $result_po = mysqli_query($conn, $sql0);
        if ($result_po) {
            echo "<script>
             alert('Record update successfully');
             window.history.go(-1);
            </script>";
        } else {
            echo "<script>
             alert('Error : Failed to update record');
               window.history.go(-1);
        </script>";
            //echo "Error: ".$sql."<br>'.$conn->error;
        }
        $flag=0;
    }   
}

function delete(){
    global $conn,$ItemCode,$ItemDescription,$isActive, $wBatch, $Brand,$ItemType,$Location;
    $flag=0;
    $sql1 =  "select * from product where ItemCode = '".$ItemCode."';";
    $result1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1) > 0){
        $flag = 1;
    }
    else{
        echo"No such product";
    }
    $sql0 = "delete from product where ItemCode = '".$ItemCode."';"; 
    
    if($flag == 1){
        $result_po = mysqli_query($conn, $sql0);
        if ($result_po) {
            echo "<script>
             alert('Record delete successfully');
             window.history.go(-1);
            </script>";
        } else {
            echo "<script>
             alert('Error : Failed to delete record');
               window.history.go(-1);
        </script>";
            //echo "Error: ".$sql."<br>'.$conn->error;
        }
        $flag=0;
    }    
}






    


mysqli_close($conn);
?> 
</div>

</body>
</html>
