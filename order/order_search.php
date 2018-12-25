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
  $expiredDate = $_POST["ExpiredDate"];
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
    global $conn,$PONo,$SONo,$date,$itemcode,$batch,$qty,$client,$supplier,$employee,$expiredDate;
    if($type == "purchase"){
      //insert_purchase_order
      $sql_i_po = "insert into purchase_order values ('".$PONo."', '".$date."', '".$supplier."', '".$employee."');";
      //insert_po_detail
      $sql_i_pd = "insert into po_detail values ('".$PONo."', '".$itemcode."', '".$batch."', '".$qty."');";
      //insert_batch
      $sql_i_batch = "insert into batch values ('".$batch."', '".$itemcode."', '".$expiredDate."');";

      $result_po = mysqli_query($conn, $sql_i_po);
      $result_pbatch = mysqli_query($conn, $sql_i_batch);
      $result_pd = mysqli_query($conn, $sql_i_pd);

      if ($result_po && $result_pd && $result_pbatch) {
          echo "<script>
                   alert('New record created successfully');
                   window.history.go(-1);
              </script>";
      }
      else {
          echo "<script>
                   alert('Error : Failed to create new record');
                     window.history.go(-1);
              </script>" ;
      }
    }
    else if($type == "sale"){
      //insert_sale_order
      $sql_i_so = "insert into sale_order values ('".$SONo."', '".$date."', '".$client."', '".$employee."');";
      //insert_so_detail
      $sql_i_sd = "insert into so_detail values ('".$SONo."', '".$itemcode."', '".$batch."', '".$qty."');";
      //check Quantity
      $sql_q = "select Balance
                from stkbalancebybatch
                where ItemCode ='".$itemcode."' AND BatchNo = '".$batch."';";
      $result = mysqli_query($conn, $sql_q);
      $row = mysqli_fetch_assoc($result);
      if($row['Balance'] >= $qty){
        $result_so = mysqli_query($conn, $sql_i_so);
        $result_sd = mysqli_query($conn, $sql_i_sd);

        if ($result_so && $result_sd) {
            echo "<script>
                     alert('New record created successfully');
                     window.history.go(-1);
                </script>";
        }
        else {
            echo "<script>
                     alert('Error : Failed to create new record');
                       window.history.go(-1);
                </script>" ;
        }
      }
      else{
        echo "Error! LOW STOCK";
      }
    }
  }

  function search($type){
    global $conn,$PONo,$SONo,$client,$supplier,$employee;
    if($type == "purchase"){
      //search_purchase
      if(!empty($PONo)){
        $sql_s_p = "select * from purchase_order AS P, po_detail AS D where P.PONo = '".$PONo."' AND P.PONo = D.PONo;";
        $result_s_p = mysqli_query($conn, $sql_s_p);
      }
      else if(!empty($supplier)){
        $sql_s_p = "select * from purchase_order AS P, po_detail AS D where P.SupplierCode = '".$supplier."' AND P.PONo = D.PONo;";
        $result_s_p = mysqli_query($conn, $sql_s_p);
      }
      else if(!empty($employee)){
        $sql_s_p = "select * from purchase_order AS P, po_detail AS D where P.EmployeeCode = '".$employee."' AND P.PONo = D.PONo;";
        $result_s_p = mysqli_query($conn, $sql_s_p);
      }
      else{
        echo "<script>
                 alert('Nothing input');
            </script>";
      }

      if(mysqli_num_rows($result_s_p) > 0){
        echo
        "<table class=\"table\">
        <tr>
        <th>Purchase Order</th>
        </tr>
          <tbody>
        <tr> <td>PONo</td> <td>Date</td> <td>ItemCode</td> <td>BatchNo</td> <td>Quantity</td>  <td>SupplierCode</td> <td>EmployeeCode</td> </tr>
         ";
        while($row = mysqli_fetch_assoc($result_s_p)){
          echo
          "
          <td>".$row["PONo"]."</td><td>".$row["Date"]."</td> <td>".$row["ItemCode"]."</td> <td>".$row["BatchNo"]."</td>
          <td>".$row["Qty"]."</td><td>".$row["SupplierCode"]."</td><td>".$row["EmployeeCode"]."</td></tr>
          ";
        }
        echo"
        </tbody>
        </table>";
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
