<!DOCTYPE html>
<html>
<head>
  <title>進、出貨</title>
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
  if($_POST["buttonType"] == 'Update'){
    update($_POST["order"]);
  }
  else if($_POST["buttonType"] == 'Delete'){
    delet($_POST["order"]);
  }
  else{
    echo "Error";
  }

  function update($type){
    global $conn,$PONo,$SONo,$date,$itemcode,$batch,$qty,$client,$supplier,$employee,$expiredDate;
    $flag = 0;
    if($type == "purchase"){
      if(!empty($PONo)){
        if(!empty($date)){
          $sql_check_po = "select * from purchase_order where PONo = '".$PONo."';";
          //update_purchase_order_date
          $sql_u_po = "update purchase_order SET Date = '".$date."' where PONo = '".$PONo."';";

          $result_check_po = mysqli_query($conn, $sql_check_po);
          if(mysqli_num_rows($result_check_po) > 0){
            $flag = 1;
          }
          else{
            echo"No such purchase_order";
          }
        }
        else if(!empty($itemcode) && !empty($batch)){
          if(!empty($qty)){
            $sql_check_pobi = "select * from po_detail where PONo = '".$PONo."' AND ItemCode = '".$itemcode."' AND BatchNo = '".$batch."';";
            //update qty
            $sql_u_po = "update po_detail SET Qty = '".$qty."' WHERE PONo = '".$PONo."' AND ItemCode = '".$itemcode."' AND BatchNo = '".$batch."';";

            $result_check_pobi = mysqli_query($conn, $sql_check_pobi);
            if(mysqli_num_rows($result_check_pobi) > 0){
              $flag = 1;
            }
            else{
              echo"No such order";
            }
          }
        }
        else if(!empty($supplier)){
          $sql_check_po = "select * from purchase_order where PONo = '".$PONo."';";
          //update_purchase_order_supplier
          $sql_u_po = "update purchase_order SET SupplierCode = '".$supplier."' WHERE PONo = '".$PONo."';";

          $result_check_po = mysqli_query($conn, $sql_check_po);
          if(mysqli_num_rows($result_check_po) > 0){
            $flag = 1;
          }
          else{
            echo"No such purchase_order";
          }
        }
        else if(!empty($employee)){
          $sql_check_po = "select * from purchase_order where PONo = '".$PONo."';";
          //update_purchase_order_employee
          $sql_u_po = "update purchase_order SET EmployeeCode = '".$employee."' WHERE PONo = '".$PONo."';";

          $result_check_po = mysqli_query($conn, $sql_check_po);
          if(mysqli_num_rows($result_check_po) > 0){
            $flag = 1;
          }
          else{
            echo"No such purchase_order";
          }
        }
      }
      else if(!empty($batch) && !empty($itemcode)){
          if(!empty($expiredDate)){
            $sqp_check_bi = "select * from batch where BatchNo = '".$batch."' AND ItemCode = '".$itemcode."';";
            //change batch's expired date
            $sql_u_po = "update batch SET ExpiredDate = '".$expiredDate."' WHERE BatchNo = '".$batch."' AND ItemCode = '".$itemcode."';";

            $result_check_bi = mysqli_query($conn, $sqp_check_bi);
            if(mysqli_num_rows($result_check_pobi) > 0){
              $flag = 1;
            }
            else{
              echo"No such batch";
            }
          }
          else{
            echo"No BatchNO && Itemcode";
          }
      }
      else{
        echo"No PONo";
      }
      if($flag == 1){
        $result_po = mysqli_query($conn, $sql_u_po);
        if ($result_po) {
            echo "<script>
                     alert('New record created successfully');
                     window.history.go(-1);
                </script>";
        } else {
            echo"<script>
                     alert('Error : Failed to create new record'+'$conn->error');
                       window.history.go(-1);
                </script>" ;
        }
      }
    }
    else if($type == "sale"){
      if(!empty($SONo)){
        if(!empty($date)){
        //update_purchase_order_date
        $sql_u_so = "update sale_order SET Date = '".$date."' where SONo = '".$SONo."';";
        }
        else if(!empty($itemcode) && !empty($batch)){
          if(!empty($qty)){
            //update qty
            $sql_u_so = "update so_detail SET Qty = '".$qty."' WHERE SONo = '".$SONo."' AND ItemCode = '".$itemcode."' AND BatchNo = '".$batch."';";
          }
        }
        else if(!empty($client)){
        //update_purchase_order_supplier
        $sql_u_so = "update sale_order SET ClientCode = '".$client."' WHERE SONo = '".$SONo."';";
        }
        else if(!empty($employee)){
        //update_purchase_order_employee
        $sql_u_so = "update sale_order SET EmployeeCode = '".$employee."' WHERE SONo = '".$SONo."';";
        }
      }
      else{
        echo"No SONo";
      }
      $result_so = mysqli_query($conn, $sql_u_so);
      if ($result_so) {
          echo "<script>
                   alert('New record created successfully');
                   window.history.go(-1);
              </script>";
      } else {
          /*echo"<script>
                   alert('Error : Failed to create new record');
                     window.history.go(-1);
              </script>" ;*/
              echo $conn->error;
      }
    }
  }

  function delet($type){
    global $conn,$PONo,$SONo,$client,$supplier,$employee;
    if($type == "purchase"){
      //delete_purchase
      if(!empty($PONo)){
        $sql_d_p = "select * from purchase_order AS P, po_detail AS D where P.PONo = '".$PONo."' AND P.PONo = D.PONo;";
        $result_d_p = mysqli_query($conn, $sql_d_p);
      }
      else if(!empty($supplier)){
        $sql_d_p = "select * from purchase_order AS P, po_detail AS D where P.SupplierCode = '".$supplier."' AND P.PONo = D.PONo;";
        $result_d_p = mysqli_query($conn, $sql_d_p);
      }
      else if(!empty($employee)){
        $sql_d_p = "select * from purchase_order AS P, po_detail AS D where P.EmployeeCode = '".$employee."' AND P.PONo = D.PONo;";
        $result_d_p = mysqli_query($conn, $sql_d_p);
      }

      if(mysqli_num_rows($result_d_p) > 0){
        echo
        "<table class=\"table\">
        <tr>
        <th>Purchase Order</th>
        </tr>
          <tbody>
        <tr> <td>PONo</td> <td>Date</td> <td>ItemCode</td> <td>BatchNo</td> <td>Quantity</td>  <td>SupplierCode</td> <td>EmployeeCode</td> </tr>
         ";
        while($row = mysqli_fetch_assoc($result_d_p)){
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
      //delete_sale
      $sql_d_s = "select * from sale_order AS S,so_detail AS D where S.SONo = '".$SONo."' AND D.SONo = S.SONo;";
      $result_d_s = mysqli_query($conn, $sql_d_s);
      if(mysqli_num_rows($result_d_s) > 0){
        while($row = mysqli_fetch_assoc($result_d_s)){
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
