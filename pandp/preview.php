<?php
  $x=explode(',',$_GET['x']);
  // print_r($x);
  if (isset($_POST['publish'])){
    $username = "root"; 
    $password = ""; 
    $database = "pbl";
    $conn=mysqli_connect("localhost",$username,$password,$database);
    copy('p1.html', 'left.html');
    copy('p2.html', 'right.html');
    echo "
    <script>
      window.open('final.html', '_blank');
    </script>";
    if ($x[0]=='achieve')
      $query="UPDATE `achievement` SET `publish` = 'Yes' WHERE `type` = '$x[1]' AND `regdno` = '$x[2]' AND `name` = '$x[3]' AND `event` = '$x[4]' AND `date` = '$x[5]' AND `area` = '$x[6]' AND `achievement` = '$x[7]'";
    else
      $query="UPDATE `event` SET `status` = 'Yes' WHERE `type` = '$x[1]' AND `name` = '$x[2]' AND `date` = '$x[3]' AND `stime` = '$x[4]' AND `location` = '$x[5]' ";
    // echo $query;
    $r=mysqli_query($conn,$query);
    // header("Location: publish.php");
  }
?>

  <html>
    <head>
      <style>
        .box{
            width:50%;
            float:left; 
        }
        .menu{
            width:50%;
            float:left; 
        }
        .head{
            width:100%;
            height:10%;
        }
      </style>
    </head>
  
     <body>
  <div name='head'>
  <h3>(Preview)</h3>
    <h1 align="center" style="font-family:cursive;">Information technology</h1>
    
  </div>
  <div class="menu">
  <iframe src="p1.html" name="iframe_a" frameborder="1" scrolling="no" width="100%" height="90%" >
    <p>Your browser does not support iframes.</p>
  </iframe>
  </div>
  <div class="box">
  <iframe src="p2.html" name="iframe_b" frameborder="1" scrolling="no" width="100%" height="90%">
    <p>Your browser does not support iframes.</p>
  </iframe>
  </div>
  <form action="#" method="post">
  <input type="submit" value="publish" name="publish" onclick="openw()">
  </form>
  </body>

  </html>