﻿<!DOCTYPE html>
<html>
<head>
  <title>便捷查詢</title>
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
  $type = $_POST["search"];
  $ItemCode = $_POST["ItemCode"];
  $ExpiredDate = $_POST["ExpiredDate"];
  $BatchNo = $_POST["BatchNo"];


  //button "search"
 
  if($_POST["buttonType"] == 'Search'){
    search($_POST["search"]);
  }


  
  function search($type){
    global $conn,$ItemCode,$search;
    $getDate = date("y-m-d");
    if($type == "One Weak"){
    //echo strtotime($sql_deadline);
        $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
        $result_d = mysqli_query($conn, $sql_d);
        
            while($row = mysqli_fetch_assoc($result_d)){
            //1970-01-01
             $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
            $difff = strtotime($diff);
            $difff/=86400;

          if($difff <= 7 ){
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
            <tr> <td>Days</td><td>".$difff."</td></tr>

          </tbody>
          </table>";
            }
            }
    }
  else if($type == "Two Weaks"){
               
                $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
                $result_d = mysqli_query($conn, $sql_d);
                
                while($row = mysqli_fetch_assoc($result_d)){
                    //1970-01-01
                    $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                    $difff = strtotime($diff);
                    $difff/=86400;
                    
                    if($difff > 7 && $difff <= 14 ){
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
           <tr> <td>Days</td><td>".$difff."</td></tr>
          </tbody>
          </table>";
                    }
                }
            }
            else if($type == "One Month"){
        
                    $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
                    $result_d = mysqli_query($conn, $sql_d);
                    
                    while($row = mysqli_fetch_assoc($result_d)){
                        //1970-01-01
                        $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                        $difff = strtotime($diff);
                        $difff/=86400;
                        
                        if($difff > 15 && $difff <= 30 ){
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
           <tr> <td>Days</td><td>".$difff."</td></tr>                  
          </tbody>
          </table>";
                        }
                    }
                    
            }
            
           else if($type == "Three Months"){

                $sql_d = "select * from batch where ItemCode = '".$ItemCode."';" ;
                $result_d = mysqli_query($conn, $sql_d);
                
                while($row = mysqli_fetch_assoc($result_d)){
                    //1970-01-01
                    $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                    $difff = strtotime($diff);
                    $difff/=86400;
                    
                    if($difff > 30 && $difff <= 90 ){
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
          <tr> <td>Days</td><td>".$difff."</td></tr>               
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
