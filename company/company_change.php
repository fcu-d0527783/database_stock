<!DOCTYPE html>
<html>
<head>
  <title>供應商、客戶管理</title>
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

$type = $_POST["company"];  //echo $type;
$ccode = $_POST["ClientCode"];  //echo $code;
$scode = $_POST["SupplierCode"]; 
$name = $_POST["CompanyName"];  //echo $name;
$addr = $_POST["Address"];  //echo $addr;
$cnum = $_POST["ContactNo"];  //echo $cnum;
$email = $_POST["Email"];  //echo $email;
$remark = $_POST["Remark"];  //echo $remark;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_POST["buttonType"] == 'Update'){
    update($_POST["company"]);
}
else if($_POST["buttonType"] == 'Delete'){
    delete($_POST["company"]);
}
else{
    echo "Error";
}

function delete($type){
    global $conn,$ccode,$scode,$name,$addr,$cnum,$remark,$email;
    $flag=0;
    if($type =="supplier") {
        $sql1 =  "select * from supplier where SupplierCode like '".$scode."';";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            $flag = 1;
        }
        else{
            echo"No such supplier";
        }
        if($scode){
            $sql0 = "delete from supplier where SupplierCode like '%".$scode."%';";
        } 
        else if($name){
           $sql0 = "delete from supplier where CompanyName like '%".$name."%';";
        }       
    }
    else {
        $sql1 =  "select * from client where ClientCode like '".$ccode."';";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            $flag = 1;
        }
        else{
            echo"No such client";
        }
        if($ccode){         
           $sql0 = "delete from client where ClientCode like '%".$ccode."%';";
        } 
        else if($name){
           $sql0 = "delete from client where CompanyName like '%".$name."%';";
        }  
    }
    
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

function update($type){
    global $conn,$scode,$ccode,$name,$addr,$cnum,$remark,$email; 
    $flag=0;
    if($type =="supplier")   {
        $sql1 =  "select * from supplier where SupplierCode like '".$scode."';";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            $flag = 1;
        }
        else{
            echo"No such supplier";
        }
        if($name && $addr ){           
            $sql0 = "update supplier set CompanyName = '".$name."', Address = '".$addr."' where SupplierCode like '%".$scode."%';";
        } 
        else if($email && $addr) {
            $sql0 = "update supplier set Email = '".$email."' ,Address = '".$addr."'where SupplierCode like '%".$scode."%';";
        }
        else if($cnum && $addr) {
            $sql0 = "update supplier set ContactNo = '".$cnum."',Address = '".$addr."' where SupplierCode like '%".$scode."%';";
        }
        else if($name){
            $sql0 = "update supplier set CompanyName = '".$name."' where SupplierCode like '%".$scode."%';";
        } 
        else if($addr) {
            $sql0 = "update supplier set Address = '".$addr."' where SupplierCode like '%".$scode."%';";
        } 
        else if($email) {
            $sql0 = "update supplier set Email = '".$email."' where SupplierCode like '%".$scode."%';";
        } 
        else if($cnum) {
            $sql0 = "update supplier set ContactNo = '".$cnum."' where SupplierCode like '%".$scode."%';";
        } 
        else if($remark) {
            $sql0 = "update supplier set Remark = '".$remark."' where SupplierCode like '%".$scode."%';";
        }       
    }
    else {
        $sql1 =  "select * from client where ClientCode like '".$ccode."';";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            $flag = 1;
        }
        else{
            echo"No such client";
        }
        if($name && $addr ){
            $sql0 = "update client set CompanyName = '".$name."', Address = '".$addr."' where ClientCode like '%".$ccode."%';";
        }
        else if($email && $addr) {
            $sql0 = "update client set Email = '".$email."' ,Address = '".$addr."'where ClientCode like '%".$ccode."%';";
        }
        else if($cnum && $addr) {
            $sql0 = "update client set ContactNo = '".$cnum."',Address = '".$addr."' where ClientCode like '%".$ccode."%';";
        }
        else if($name){
            $sql0 = "update client set CompanyName = '".$name."' where ClientCode like '%".$ccode."%';";
        } 
        else if($addr) {
            $sql0 = "update client set Address = '".$addr."' where ClientCode like '%".$ccode."%';";
        } 
        else if($email) {
            $sql0 = "update client set Email = '".$email."' where ClientCode like '%".$ccode."%';";
        } 
        else if($cnum) {
            $sql0 = "update client set ContactNo = '".$cnum."' where ClientCode like '%".$ccode."%';";
        } 
        else if($remark) {
            $sql0 = "update client set Remark = '".$remark."' where ClientCode like '%".$ccode."%';";
        } 
        
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
/*


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
