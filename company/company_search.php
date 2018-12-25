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
$code = $_POST["Code"];  //echo $code;
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
    global $conn,$code,$name,$addr,$cnum,$remark,$email;   
    $sql = "insert into ".$type." values ('".$code."', '".$name."', '".$addr."', '".$cnum."', '".$email."', '".$remark."');";
        //$result = mysqli_query($conn, $sql);
    echo $sql;   
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

function search($type){
    global $conn,$code;
    if($type == "supplier"){          
        
        $sql1 = "select * from supplier where SupplierCode = '".$code."';";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
            while($row = mysqli_fetch_assoc($result1)){
                echo
                "<table class=\"table\">
            <thead>
            <tr>
            <th>Supplier Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr> <td>Client Code : </td><td>".$row["SupplierCode"]."</td></tr>
            <tr> <td>Company Name :</td><td>".$row["CompanyName"]."</td></tr>
            <tr> <td>Address :</td><td>".$row["Address"]."</td></tr>
            <tr> <td>Contact Number :</td><td>".$row["ContactNo"]."</td></tr>
            <tr> <td>Email :</td><td>".$row["Email"]."</td></tr>
            <tr> <td>Remark :</td><td>".$row["Remark"]."</td></tr>
            </tbody>
            </table>";
            }
        } else {
            echo "Failed to search Supplier record";
          }
    }
    else if($type == "client"){
        $sql0 = "select * from client where ClientCode = '".$code."';";
        $result0 = mysqli_query($conn, $sql0);
        if (mysqli_num_rows($result0) > 0 ) {
            while($row = mysqli_fetch_assoc($result0)) {
                echo            
            "<table class=\"table\">
            <thead>
            <tr>
            <th>Client Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr> <td>Client Code : </td><td>".$row["ClientCode"]."</td></tr>
            <tr> <td>Company Name :</td><td>".$row["CompanyName"]."</td></tr>
            <tr> <td>Address :</td><td>".$row["Address"]."</td></tr>
            <tr> <td>Contact Number :</td><td>".$row["ContactNo"]."</td></tr>
            <tr> <td>Email :</td><td>".$row["Email"]."</td></tr>
            <tr> <td>Remark :</td><td>".$row["Remark"]."</td></tr>
            </tbody>
            </table>";
            }
        }else {
            echo "Failed to search Client record";
        }
        
    }
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
