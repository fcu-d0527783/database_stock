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
  $itemcode = $_POST["ItemCode"];
  $batch = $_POST["BatchNo"];
  $qty = $_POST["Qty"];
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
    global $conn,$PONo,$SONo,$date,$itemcode,$batch,$qty,$client,$supplier,$employee;
    if($type == "purchase"){
      //insert_purchase_order
      $sql_i_po = "insert into purchase_order values ('".$PONo."', '".$date."', '".$supplier."', '".$employee."');";
      //insert_po_detail
      $sql_i_pd = "insert into po_detail values ('".$PONo."', '".$itemcode."', '".$batch."', '".$qty."');";
      $result_po = mysqli_query($conn, $sql_i_po);
      $result_pd = mysqli_query($conn, $sql_i_pd);

      if ($conn->query($sql_i_pd) == TRUE && $conn->query($sql_i_po) == TRUE) {
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
    else if($type == "sale"){

    }
  }

  function search($type){
    global $conn,$PONo,$SONo;
    if($type == "purchase"){
      //search_purchase
      $sql_s_p = "select * from purchase_order AS P, po_detail AS D where P.PONo = '".$PONo."' AND P.PONo = D.PONo;";
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
          <tr> <td>PONo : </td><td>".$row["PONo"]."</td></tr>
          <tr> <td>Date :</td><td>".$row["Date"]."</td></tr>
          <tr> <td>ItemCode :</td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>Quantity :</td><td>".$row["Qty"]."</td></tr>
          <tr> <td>SupplierCode :</td><td>".$row["SupplierCode"]."</td></tr>
          <tr> <td>EmployeeCode :</td><td>".$row["EmployeeCode"]."</td></tr>
          </tbody>
          </table>";
        }
      }
      else{
        echo "Search failed";
      }
    }
    else if($type == "sale"){
      //search_sale
      $sql_s_s = "select * from sale_order AS S,so_detail AS D where S.SONo = '".$SONo."' AND D.SONo = S.SONo;";
      $result_s_s = mysqli_query($conn, $sql_s_s);
      if(mysqli_num_rows($result_s_s) > 0){
        while($row = mysqli_fetch_assoc($result_s_s)){
          echo
          "<table class=\"table\">
          <thead>
          <tr>
          <th>Purchase Order</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>SNo : </td><td>".$row["SONo"]."</td></tr>
          <tr> <td>Date :</td><td>".$row["Date"]."</td></tr>
          <tr> <td>ItemCode :</td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>Quantity :</td><td>".$row["Qty"]."</td></tr>
          <tr> <td>ClientCode :</td><td>".$row["ClientCode"]."</td></tr>
          <tr> <td>EmployeeCode :</td><td>".$row["EmployeeCode"]."</td></tr>
          </tbody>
          </table>";
        }
      }
      else{
        echo "Search failed";
      }
    }
  }
?>
</div>

</body>
</html>
