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
$scode = $_POST["SupplierCode"];  //echo $scode;
$ccode = $_POST["ClientCode"];
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

//detect button "insert" or "search"
if($_POST["buttonType"] == 'Insert'){
    insert($_POST["company"]);
}
else if($_POST["buttonType"] == 'Search'){
    search($_POST["company"]);
}
else{
    echo "Error";
}

function insert($type){
    global $conn,$ccode,$scode,$name,$addr,$cnum,$remark,$email;   
    if($type == "supplier"){
        $sql = "insert into supplier values ('".$scode."', '".$name."', '".$addr."', '".$cnum."', '".$email."', '".$remark."');";
    } else {
        $sql = "insert into client values ('".$ccode."', '".$name."', '".$addr."', '".$cnum."', '".$email."', '".$remark."');";
      }
 
        //$result = mysqli_query($conn, $sql);
    echo $sql;   
    if ($conn->query($sql) === TRUE) {
        echo "<script>
             alert('New record created successfully');
             window.history.go(-1);
        </script>";
    } else {
        /*echo "<script>
             alert('Error : Failed to create new record');
               window.history.go(-1);
        </script>";
        */echo $conn->error;
        
    }
}

function search($type){
    global $conn,$scode,$ccode;

    if($type == "supplier"){               
        $sql0 = "select * from supplier where SupplierCode = '".$scode."';";   
        $result0 = mysqli_query($conn, $sql0);
        if (mysqli_num_rows($result0) > 0 ) {
            echo
            "<table class=\"table\">
            <thead>
            <tr>
            <th>Supplier Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr> <td>Supplier Code </td> <td>Company Name </td> <td>Address </td> <td>Contact Number </td> <td>Email </td>  <td>Remark </td> </tr> ";
            
            while($row = mysqli_fetch_assoc($result0)) {
                echo
                "
            <td>".$row['SupplierCode']."</td><td>".$row['CompanyName']."</td><td>".$row['Address']."</td><td>".$row['ContactNo']."</td><td>".$row['Email']."</td><td>".$row['Remark']."</td></tr>
            </tbody>
            </table>";
            }
        }
    }
    else if($type == "client"){
        $sql0 = "select * from client where ClientCode = '".$ccode."';";
        $result0 = mysqli_query($conn, $sql0);
        if (mysqli_num_rows($result0) > 0 ) {
            echo
            "<table class=\"table\">
            <thead>
            <tr>
            <th>Client Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr> <td>Client Code </td> <td>Company Name </td> <td>Address </td> <td>Contact Number </td> <td>Email </td>  <td>Remark </td> </tr> ";
            
            while($row = mysqli_fetch_assoc($result0)) {
                echo
                "
            <td>".$row['ClientCode']."</td><td>".$row['CompanyName']."</td><td>".$row['Address']."</td><td>".$row['ContactNo']."</td><td>".$row['Email']."</td><td>".$row['Remark']."</td></tr>
            </tbody>
            </table>";
            }
    }
    

   }
}

mysqli_close($conn);
?> 
</div>

</body>
</html>