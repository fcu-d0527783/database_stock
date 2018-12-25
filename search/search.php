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

  $ItemCode = $_POST["ItemCode"];
  $ExpiredDate = $_POST["ExpiredDate"];
  $BatchNo = $_POST["BatchNo"];


  //button "search"
 
  if($_POST["buttonType"] == 'Search'){
    search($_POST["search"]);
  }


  
  function search($type){
    global $conn,$ItemCode;
    $getDate = date("y-m-d");
    
    //echo $getDate;
    //
    $sql_deadline  = "select ExpiredDate from batch where ItemCode = '".$ItemCode."';" ;
    
    //echo strtotime($sql_deadline);
        $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
        $result_d = mysqli_query($conn, $sql_d);
        
            while($row = mysqli_fetch_assoc($result_d)){
 
           $deadline = (strtotime($row["ExpiredDate"])- strtotime($getDate));
           echo "******************";
           
           echo date("Y-m-d ",strtotime($row["ExpiredDate"]));

          if(strtotime($row["ExpiredDate"])- strtotime($getDate) <= 7*86400 ){
                  echo
                "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>

          </tbody>
          </table>";
            }
        }
        
    //
    /*
    $sql_deadline = "select ExpiredDate from batch where ItemCode = '".$ItemCode."';" ;
    $result_deadline = mysqli_query($conn, $sql_deadline);
    $sql_ItemCode = "select * from batch AS B , produce AS P where ItemCode = '".$ItemCode."' AND B.ItemCode = p.ItemCode;" ;
    $result_deadline = mysqli_query($conn, $sql_ItemCode);
    
        while($row = mysqli_fetch_assoc($result_deadline)){
            echo
            "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>
        
          </tbody>
          </table>";
        }
    */
    $sql_deadline = $sql_deadline = "select ExpiredDate from batch where ItemCode = '".$ItemCode."';" ;
    if($type == "Seven Days"){
        echo $getDate;
      $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
      $result_d = mysqli_query($conn, $sql_d);
      if(strtotime($sql_deadline)- strtotime($getDate) <= 7*86400 ){
        while($row = mysqli_fetch_assoc($result_d)){
          echo
          "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>
          
          </tbody>
          </table>";
        }
      }
    }
    else if($type == "Fifteen Days"){
        $sql_deadline = "select ExpiredDate from batch where ItemCode = '".$ItemCode."';" ;
        $result_deadline = mysqli_query($conn, $sql_deadline);
        if(strtotime(mysqli_num_rows($result_deadline)) - strtotime($getDate) <= 15*86400 ){
            while($row = mysqli_fetch_assoc($result_deadline)){
                echo
                "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>
            
          </tbody>
          </table>";
            }
        }
    }
    else if($type == "One Month"){
        $sql_deadline = "select ExpiredDate from batch where ItemCode = '".$ItemCode."';" ;
        $result_deadline = mysqli_query($conn, $sql_deadline);
        if(strtotime(mysqli_num_rows($result_deadline)) - strtotime($getDate) <= 30*86400 ){
            while($row = mysqli_fetch_assoc($result_deadline)){
                echo
                "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>
            
          </tbody>
          </table>";
            }
        }
    }else if($type == "Three Months"){
        $sql_deadline = "select ExpiredDate from batch where ItemCode = '".$ItemCode."', ;" ;
        $result_deadline = mysqli_query($conn, $sql_deadline);
        if(strtotime(mysqli_num_rows($result_deadline)) - strtotime($getDate) <= 90*86400 ){
            while($row = mysqli_fetch_assoc($result_deadline)){
                echo
                "<table class=\"table\">
          <thead>
          <tr>
          <th>Search Deadline</th>
          </tr>
          </thead>
          <tbody>
          <tr> <td>ItemCode : </td><td>".$row["ItemCode"]."</td></tr>
          <tr> <td>BatchNo :</td><td>".$row["BatchNo"]."</td></tr>
          <tr> <td>ExpiredDate :</td><td>".$row["ExpiredDate"]."</td></tr>
            
          </tbody>
          </table>";
            }
        }
    }
  }
?>
</div>

</body>
</html>
