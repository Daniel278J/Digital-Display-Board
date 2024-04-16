<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MVGR</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="./style.css">

</head>
<?php
    if (isset($_POST['submit'])){
        if ($_POST['uname']=='admin' && $_POST['password']=='admin'){
            header("Location: admin.html");
        }
        else {
            echo "Your have entered wrong credentials";
            exit();
        }
    }
?>

<body>
  <form action="#" method="post">
<!-- partial:index.partial.html -->
<div class="screen-1">
  <div class="image">
    <img src="MVGR Emblem.jpg" alt="mvgr" height="100px" width="130px" align="center">
  </div>
  <div class="email">
    <label for="email">Username</label>
    <div class="sec-2">
      <ion-icon name="mail-outline"></ion-icon>
      <input type="text" name="uname" placeholder="Username"/>
    </div>
  </div>
  <div class="password">
    <label for="password">Password</label>
    <div class="sec-2">
      <ion-icon name="lock-closed-outline"></ion-icon>
      <input class="pas" type="password" name="password" placeholder="Password"/>
      <ion-icon class="show-hide" name="eye-outline"></ion-icon>
    </div>
  </div>
  <button type="submit" class="login" name="submit" >Login </button>
  <div class="footer"><span>Signup</span><span>Forgot Password?</span></div>
</div>
</form>
</body>
</html>
