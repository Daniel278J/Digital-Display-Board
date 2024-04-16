<?php
    $host="localhost";
    $user="root";
    $password="";
    $db='pbl';
    $conn=mysqli_connect($host,$user,$password,$db);

    if (isset($_POST['submit'])){
        $type=$_POST['type'];
        $regdno=$_POST['regdno'];
        $name=$_POST['name'];
        $event=$_POST['event'];
        $date=$_POST['date'];
        $area=$_POST['area'];
        $achievement=$_POST['achievement'];
        $query="insert into achievement values('$type','$regdno','$name','$event','$date','$area','$achievement','No');";
        $result=mysqli_query($conn,$query);
        
        $target_dir = "../Achievement pics/";
        $fileex=substr(basename($_FILES['uploadfile']['name']),strrpos(basename($_FILES['uploadfile']['name']),"."));
        $target_file = $target_dir . $date . $event . $regdno . $fileex;
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
        if ($result) {
            echo "Sucessfully Inserted.";
        }
        else {
            echo "Insertion Failed";
        }
        
        exit();
    }
?>
<html>
    <head>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel="stylesheet" href="./style.css">
    </head>
    <body style="background-color:#dde5f4;">
        <br><br><br><br>
        <div class="login" align="center" style="background-image:url('hi.jpg');">
            <h2 align="center" style="background-color:#4ce9fc;">Enter the Achievement Details</h2>
            <form method="post" action="#" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Event Type:</td>
                        <td><select name="type" id="type" onchange="display()">
                            <option selected disabled>Select Type</option>
                            <?php
                                $query="SELECT DISTINCT(Type) from achievement;";
                                $result=mysqli_query($conn,$query);
                                for ($i=0; $i < mysqli_num_rows($result); $i++) { 
                                    $row=mysqli_fetch_array($result);
                                    echo "<option value='$row[0]'>$row[0]</option>";
                                }
                            ?>
                            <option>Others</option>
                            <input type="text" name="type" id="ty" style="display:none">
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Regd. No. :</td>
                        <td><input type="text" name="regdno" placeholder="XX331A12XX"required></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" placeholder="name"required></td>
                    </tr>
                    <tr>
                        <td>Event Name:</td>
                        <td><input type="text" name="event" required></td>
                    </tr>
                    <tr>
                        <td>Date of the event:</td>
                        <td><input type="date" name="date" required></td>
                    </tr>
                    <tr>
                        <td>Location of the event:</td>
                        <td>
                            <input type="text" name="area" required></td>
                        </td>
                    </tr>
                    <tr>
                        <td>Achievement in the event:</td>
                        <td>
                            <select name="achievement">
                                <option selected disabled>Select Achievement</option>
                                <option value="first">First</option>
                                <option value="second">Second</option>
                                <option value="Third">Third</option>
                                <option value="participate">participation</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>upload file (if any)(Only JPEG/JPG):</td>
                        <td>
                            <input type="file" name="uploadfile" accept="image/jpeg"></td>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="submit" style="border-radius: 6px;padding:6px;background-color: #129eeb;color:azure; border: none;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);text-decoration: none;">
            </form>
        </div>
        <script>
            function display(){
                var type= document.getElementById("type");
                if ((type.value)=='Others'){
                    document.getElementById("ty").style.display='block';
                    document.getElementById("ty").value='';
                }
                else{
                    document.getElementById("ty").style.display='none';
                    document.getElementById("ty").value=(type.value);
                }
            }
        </script>
    </body>
</html>