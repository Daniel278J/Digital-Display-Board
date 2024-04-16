<?php
$data=$_GET['id'];
print_r($_GET);
$x=explode(',',$_GET['id']);
$text= "
<html>
    <head>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'><link rel='stylesheet' href='./style.css'>
    </head>
    <body style='background-color:#eaf6e2;'>
    <div class='main'>
        <div id='data' class='sub'>
            <table cellspacing=30>
                <tr>
                    <th>Event Type:</th>
                    <td>$x[0]</td>
                </tr>
                <tr>
                    <th>Regd. No.:</th>
                    <td>$x[1]</td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td>$x[2]</td>
                </tr>
                <tr>
                    <th>Event Name:</th>
                    <td>$x[3]</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>$x[4]</td>
                </tr>
                <tr>
                    <th>Location:</th>
                    <td>$x[5]</td>
                </tr>
                <tr>
                    <th>Achievement:</th>
                    <td>$x[6]</td>
                </tr>
            </table>
        </div>
    </body>
</html>";
    $myfile = fopen("p1.html", "w") or die("Unable to open file!");
    fwrite($myfile, $text);
    fclose($myfile);
    $pic="<html>
    <head>

    </head>
    <body>
        <img style='object-fit:contain;' src='$x[8]' alt='No image Preview' height='100%' width='100%'>
    </body>
    </html>";   
    $myfile = fopen("p2.html", "w") or die("Unable to open file!");
    fwrite($myfile, $pic);
    fclose($myfile);
    $data= 'achieve,'.$data;
    header("Location: preview.php?x=$data");
?>