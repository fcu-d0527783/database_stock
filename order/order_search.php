<!DOCTYPE html>
<html>
<head>
  <title>進出貨</title>
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

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $SONo = $_POST["SONo"];
  $PONo = $_POST["PONo"];
  $date = $_POST["Date"];
  $client = $_POST["ClientCode"];
  $supplier = $_POST["SupplierCode"];
  $employee = $_POST["EmployeeCode"];

  //detect button "insert" or "search"
  if($_POST["buttonType"] == 'Insert'){
    insert($_POST["order"]);
  }
  else if($_POST["buttonType"] == 'Search'){
    search($_POST["order"]);
  }
  else{
    echo "Error";
  }

  function insert($type){
    if($type == "purchase"){

    }
    else if($type == "sale"){

    }
  }

  function search($type){
    global $conn,$PONo;
    if($type == "purchase"){
      $sql_s_p = "select * from purchase_order where PONo = '".$PONo."';";
      $result_s_p = mysqli_query($conn, $sql_s_p);
      if(mysqli_num_rows($result_s_p) > 0){
        while($row = mysqli_fetch_assoc($result_s_p)){
          echo
          "<table class=\"table\">
          <thead>
          <tr>
          <th>Purchase Order</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>PNo : </td><td>".$row["PONo"]."</td></tr>
          <tr> <td>Date :</td><td>".$row["Date"]."</td></tr>
          <tr> <td>SupplierCode :</td><td>".$row["SupplierCode"]."</td></tr>
          <tr> <td>EmployeeCode :</td><td>".$row["EmployeeCode"]."</td></tr>
          </tbody>
          </table>";
        }
      }
    }
    else if($type == "sale"){

    }
  }
?>
</div>

</body>
</html>
