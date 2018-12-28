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
          $sql_check_so = "select * from sale_order where SONo = '".$SONo."';";
          $result_check_so = mysqli_query($conn, $sql_check_so);
          if(mysqli_num_rows($result_check_so) > 0){
            $flag = 1;
          }
          else{
            echo"<script>alert('NO such sale_order')</script>";
          }
        //update_purchase_order_date
        $sql_u_so = "update sale_order SET Date = '".$date."' where SONo = '".$SONo."';";
        }
        else if(!empty($itemcode) && !empty($batch)){
          if(!empty($qty)){
            $sql_check_sobi = "select * from so_detail where SONo = '".$SONo."' AND ItemCode = '".$itemcode."' AND BatchNo = '".$batch."';";
            $result_check_sobi = mysqli_query($conn, $sql_check_sobi);
            if(mysqli_num_rows($result_check_sobi) > 0){
              $flag = 1;
            }
            else{
              echo"No such order";
            }
            //update qty
            $sql_u_so = "update so_detail SET Qty = '".$qty."' WHERE SONo = '".$SONo."' AND ItemCode = '".$itemcode."' AND BatchNo = '".$batch."';";
          }
        }
        else if(!empty($client)){
          $sql_check_so = "select * from sale_order where SONo = '".$SONo."';";
          $result_check_so = mysqli_query($conn, $sql_check_so);
          if(mysqli_num_rows($result_check_so) > 0){
            $flag = 1;
          }
          else{
            echo"<script>alert('NO such sale_order')</script>";
          }
        //update_purchase_order_supplier
        $sql_u_so = "update sale_order SET ClientCode = '".$client."' WHERE SONo = '".$SONo."';";
        }
        else if(!empty($employee)){
          $sql_check_so = "select * from sale_order where SONo = '".$SONo."';";
          $result_check_so = mysqli_query($conn, $sql_check_so);
          if(mysqli_num_rows($result_check_so) > 0){
            $flag = 1;
          }
          else{
            echo"<script>alert('NO such sale_order')</script>";
          }
        //update_purchase_order_employee
        $sql_u_so = "update sale_order SET EmployeeCode = '".$employee."' WHERE SONo = '".$SONo."';";
        }
      }
      else{
        echo"<script>alert('NO such SONo')</script>";
      }

      if($flag == 1){
        $result_so = mysqli_query($conn, $sql_u_so);
        if ($result_so) {
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
  }

  function delet($type){
    $flag = 0;
    global $conn,$PONo,$SONo,$client,$supplier,$employee;
    if($type == "purchase"){
      //delete_purchase
      if(!empty($PONo)){
        $sql_check_po = "select * from po_detail where PONo = '".$PONo."';";
        $result_check_po = mysqli_query($conn, $sql_check_po);
          if(mysqli_num_rows($result_check_po) > 0){
          $flag = 1;
          $sql_d_p = "delete from purchase_order where PONo = '".$PONo."';";
          $result_d_p = mysqli_query($conn, $sql_d_p);
          while($row = mysqli_fetch_assoc($result_check_po)){
            $sql_d_b = "delete from batch where BatchNo = '".$row["BatchNo"]."';";
            $result_d_b = mysqli_query($conn, $sql_d_b);
          }
        }
        else{
          echo"<script>alert('NO such purchase_order')</script>";
        }
      }
      else{
        echo"<script>alert('Please input PONo to delete')</script>";
      }

      if($flag == 1){
        if ($result_d_p && $result_d_b) {
          echo "<script>
                   alert('Delete record successfully');
                   window.history.go(-1);
              </script>";
      } else {
          echo"<script>
                   alert('Error : Failed to delete a record');
                     window.history.go(-1);
              </script>" ;
        }
      }
    }
    else if($type == "sale"){
      if(!empty($SONo)){
        $sql_check_so = "select * from sale_order where SONo = '".$SONo."';";
        $result_check_so = mysqli_query($conn, $sql_check_so);
          if(mysqli_num_rows($result_check_so) > 0){
          $flag = 1;
          $sql_d_s = "delete from sale_order where SONo = '".$SONo."';";
          $result_d_s = mysqli_query($conn, $sql_d_s);
        }
        else{
          echo"<script>alert('NO such sale_order')</script>";
        }
      }
      else{
        echo"<script>alert('Please input SONo to delete')</script>";
      }

      if($flag == 1){
        if ($result_d_s) {
            echo "<script>
                     alert('Delete record successfully');
                     window.history.go(-1);
                </script>";
        } else {
            echo"<script>
                     alert('Error : Failed to delete a record');
                       window.history.go(-1);
                </script>" ;
        }
      }
    }
  }
?>
</div>

</body>
</html>
