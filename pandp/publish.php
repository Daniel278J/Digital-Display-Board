<?php
    $username = "root"; 
    $password = ""; 
    $database = "pbl";
    $conn=mysqli_connect("localhost",$username,$password,$database);
    $q="SELECT DISTINCT(type) from achievement";
    $at=mysqli_query($conn,$q);
    $q="SELECT DISTINCT(type) from event";
    $et=mysqli_query($conn,$q);
    $na=mysqli_num_rows($at);
    $ne=mysqli_num_rows($et);
    $ata=array();
    $eta=array();
    for ($i=0; $i < mysqli_num_rows($at); $i++) { 
        array_push($ata,mysqli_fetch_array($at)[0]);
    }
    for ($i=0; $i < mysqli_num_rows($et); $i++) { 
        array_push($eta,mysqli_fetch_array($et)[0]);
    }
    // print_r(mysqli_fetch_array($at));
?>
<html>
    <head>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <!-- <link rel="stylesheet" href="./style.css">  -->
    <style>
        * {
            font-family: "Poppins";
        }
        body {
            /* overflow-y: hidden; */
            /* display: flex; */
            justify-content: center;
            align-items: center;
            
        }
    </style>
    </head>
    <body>
        <br><br><br><br><br>
        <div class="login" align="center"  style="background-image:url('hello.jpg');">
            
            <form method="post" action="#">
                <table>
                    <tr>
                        <td>Select the financial year:</td>
                        <td><select id='date-dropdown' name="year" required></select></td>
                    </tr>
                    <tr>
                        <td>Type of Information:</td>
                        <td><select name="type" id="type" onchange="change()" required>
                            <option selected disabled value=''>Select Type</option>
                            <option value="event">Events</option>
                            <option value="achievement" >Achievements</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Category (Optional) :</td>
                        <td><select name="cat" id="cat" required></select></td>
                    </tr>
                    <tr>
                        <td rowspan="2" align="right"><input type="submit" name="submit" value="submit"><br><br></td>
                    </tr>

                </table>
              
                <script>
                    let catDropdown = document.getElementById('cat');
                    let catOption = document.createElement('option');
                    catOption.setAttribute('disabled','');
                    catOption.text = 'Select Category';
                    catOption.setAttribute('selected','selected');
                    catOption.setAttribute('value','');
                    catDropdown.add(catOption);
                    function change() {
                        document.getElementById("cat").innerHTML = "";
                        let catDropdown = document.getElementById('cat');
                        let catOption = document.createElement('option');
                        catOption.setAttribute('disabled','');
                        catOption.text = 'Select Category';
                        catOption.setAttribute('selected','selected');
                        catOption.setAttribute('value','');
                        catDropdown.add(catOption);
                        // Adding all
                        catOption = document.createElement('option');
                        catOption.text = 'All';
                        catOption.setAttribute('value','all');
                        catDropdown.add(catOption);
                        var e = document.getElementById("type");
                        var value = e.value;
                        if (value == 'event') {
                            var et = <?php echo json_encode($eta); ?>;
                            for (let i = 0; i < et.length; i++) {
                                let catOption = document.createElement('option');
                                catOption.text = et[i];
                                catOption.value = et[i];
                                catDropdown.add(catOption);
                            }
                        }
                        else {
                            var at = <?php echo json_encode($ata); ?>;
                            for (let i = 0; i < at.length; i++) {
                                let catOption = document.createElement('option');
                                catOption.text = at[i];
                                catOption.value = at[i];
                                catDropdown.add(catOption);
                            }
                        }
                        
                    }

                  let dateDropdown = document.getElementById('date-dropdown');
              
                  let currentYear = new Date().getFullYear();
                  let earliestYear = 2017;

                  let dateOption = document.createElement('option');
                  dateOption.text = 'Select financial year';
                  dateOption.setAttribute('disabled','');
                  dateOption.setAttribute('selected','selected');
                  dateOption.setAttribute('value','');
                  dateDropdown.add(dateOption);
                  
                  while (currentYear >= earliestYear) {
                    let dateOption = document.createElement('option');
                    dateOption.text = currentYear+"-"+(currentYear+1);
                    dateOption.value = currentYear;
                    dateDropdown.add(dateOption);
                    currentYear -= 1;
                  }
                  

                </script>
                
                
            </form>
        </div>
    </body>
</html>
<?php

    if (isset($_POST['submit'])){
        
        $year= $_POST['year'];
        $sdate=$year.'-06-01';
        $edate= ($year+1).'-04-31';
        $details= $_POST['type'];
        $cat=$_POST['cat'];
        $query="SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='pbl' AND TABLE_NAME='$details';";
        $columns=mysqli_query($conn,$query);

        echo "<br><center><table border='1' cellspacing='0' noresize cellpadding='13' style='width:80% ;  text-align=center ;'> 
                <tr>";
        for ($i=0; $i < mysqli_num_rows($columns); $i++) { 
            $row=mysqli_fetch_array($columns)['COLUMN_NAME'];
            echo "<td> <font face='Arial'>$row</font> </td>";
        }
        echo "<td><font face='Arial'>Image Preview</font> </td>";
        echo "<td><font face='Arial'>publish</font> </td>";
        echo "</tr>";
        if ($cat == 'all'){
            $query = "SELECT * FROM $details where `date` BETWEEN  '$sdate' AND '$edate'";
        }
        else {
            $query = "SELECT * FROM $details where `date` BETWEEN  '$sdate' AND '$edate' and `type`='$cat'";
        }
        
        if ($result=mysqli_query($conn,$query)){
            while ($row = mysqli_fetch_array($result)) {
                // print_r($row);
                $data='';
                $field=array();
                echo "<tr>";
                for ($j=0; $j < $i; $j++) { 
                    $data=$data.$row[$j].',';
                    echo "<td>$row[$j]</td>";
                }
                // $data=substr($data,0,-1);   
                if ($details=='achievement') {
                    $img=$row['date'].$row['event'].$row['regdno'];
                }
                
                else {
                    $img=$row['name'].$row['date'];
                }
                $dir="../".$details." pics"."/".$img."*";
                $img=glob($dir)[0];
                $data=$data.$img;
                // echo $data;
                echo "<td><input type='image' src='$img' alt='No image' height='50' width='70'></td>";
                // echo "<td></td>";
                if ($details=='achievement') {
                    echo "<td><button><a href='achieve.php?id=$data'>publish</a></button></td>
                    </tr></center>";
                }
                
                else {
                    echo "<td><button><a href='event.php?id=$data'>publish</a></button></td>
                    </tr></center>";
                }
                
            }
            $result->free();
        }
    } 
?>