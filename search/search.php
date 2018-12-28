<!DOCTYPE html>
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
 
  $ItemCode = $_POST["ItemCode"];
 
  $BatchNo = $_POST["BatchNo"];
  echo
  "<table class=\"table\">
        <tr>
        <th>Search Deadline</th>
        </tr>
          <tbody>
        <tr> <td>ItemCode</td> <td>BatchNo</td> <td>ExpiredDate</td>  <td>Days</td>  </tr>
         ";

  //button "search"
 
  if($_POST["buttonType"] == 'Search'){
 
      search($_POST["search"]);
  }
  else if ($_POST["buttonType"] == 'Show All'){
      show();
  }
  function show(){
      global $conn,$ItemCode,$search,$BatchNo;
      $sql_show = "select  * from batch  where   ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 90 DAY) ;" ;
      $result_show = mysqli_query($conn, $sql_show);
      $getDate = date("y-m-d");
      while($row = mysqli_fetch_assoc($result_show)){
          $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
          $difff = strtotime($diff);
          $difff/=86400;
          $a = round($difff,0);
          
          echo
          "
          <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
      
          
          
      }    
      echo "
        </tbody>
      </table>";
  }

  
  function search($type){
      global $conn,$ItemCode,$search,$BatchNo;
    $getDate = date("y-m-d");
    if(!empty($ItemCode)){
    if($type == "One Week"){
  
        $sql_d = "select * from batch where ItemCode = '".$ItemCode."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 7 DAY)  ;" ;
        $result_d = mysqli_query($conn, $sql_d);

            while($row = mysqli_fetch_assoc($result_d)){
                $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                $difff = strtotime($diff);
                $difff/=86400;
                $a = round($difff,0);
          
              echo
              "
    <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
         
       
            }
            echo"
          </tbody>
          </table>";
    }
  else if($type == "Two Weeks"){
               
      $sql_d = "select * from batch where ItemCode = '".$ItemCode."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 14 DAY)    ;" ;
                $result_d = mysqli_query($conn, $sql_d);
                
                while($row = mysqli_fetch_assoc($result_d)){
                    $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                    $difff = strtotime($diff);
                    $difff/=86400;
                    $a = round($difff,0);
                  
                        echo
                      
                        "
    <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
                    
                }
                echo"
          </tbody>
          </table>";
            }
            else if($type == "One Month"){
        
                $sql_d = "select * from batch where ItemCode = '".$ItemCode."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 30 DAY)    ;" ;
                    $result_d = mysqli_query($conn, $sql_d);
                    
                    while($row = mysqli_fetch_assoc($result_d)){
                        //1970-01-01
                        $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                        $difff = strtotime($diff);
                        $difff/=86400;
                        $a = round($difff,0);
                       
                          
                            echo
                            "
             <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
                   }
                   echo " </tbody>
            </table>";
                    
                    
            }
            
           else if($type == "Three Months"){

               $sql_d = "select * from batch where ItemCode = '".$ItemCode."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 90 DAY)    ;" ;
                $result_d = mysqli_query($conn, $sql_d);
                
                while($row = mysqli_fetch_assoc($result_d)){
                    //1970-01-01
                    $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                    $difff = strtotime($diff);
                    $difff/=86400;
                    $a = round($difff,0);
                        echo
                        "
              <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
                    
                }
                echo " </tbody>
            </table>";
            }
    }
        
    else if(!empty($BatchNo)){
        if($type == "One Week"){
            
            $sql_d = "select * from batch where BatchNo = '".$BatchNo."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 7 DAY)    ;" ;
            $result_d = mysqli_query($conn, $sql_d);
            
            while($row = mysqli_fetch_assoc($result_d)){
                $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                $difff = strtotime($diff);
                $difff/=86400;
                $a = round($difff,0);
                
                echo
                "
             <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
     
            }
             echo " </tbody>
            </table>";
        }
        else if($type == "Two Weeks"){
            
            $sql_d = "select * from batch where BatchNo = '".$BatchNo."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 14 DAY)    ;" ;
            $result_d = mysqli_query($conn, $sql_d);
            
            while($row = mysqli_fetch_assoc($result_d)){
                $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                $difff = strtotime($diff);
                $difff/=86400;
                $a = round($difff,0);
                
                    echo
                    
                    "
             <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
                
            }
            echo " </tbody>
            </table>";
        }
        else if($type == "One Month"){
            
            $sql_d = "select * from batch where BatchNo = '".$BatchNo."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 30 DAY)    ;" ;
            $result_d = mysqli_query($conn, $sql_d);
            
            while($row = mysqli_fetch_assoc($result_d)){
                //1970-01-01
                $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                $difff = strtotime($diff);
                $difff/=86400;
                $a = round($difff,0);
               
                    
                    echo
                    "
              <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
                
            }
            echo " </tbody>
            </table>";

        }
        
        else if($type == "Three Months"){
            
            $sql_d = "select * from batch where BatchNo = '".$BatchNo."' AND ExpiredDate between curdate() AND DATE_ADD(curdate(), INTERVAL 90 DAY)    ;" ;
            $result_d = mysqli_query($conn, $sql_d);
            
            while($row = mysqli_fetch_assoc($result_d)){
                //1970-01-01
                $diff = date ("y-m-d" , strtotime($row["ExpiredDate"])-strtotime($getDate));
                $difff = strtotime($diff);
                $difff/=86400;
                $a = round($difff,0);
     
                    echo
                    "
            <td>".$row["ItemCode"]."</td><td>".$row["BatchNo"]."</td> <td>".$row["ExpiredDate"]."</td> <td>".$a."</td><tr>";
 
      
                
            }  
            echo " </tbody>
            </table>";
        }
        
        
    }

  }
  
  
  
?>
</div>

</body>
</html>
