<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="CSS/photostyle.css">    
    <div>   
    </div> 
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <object data="https://iotsmartfarm.s3-ap-southeast-1.amazonaws.com/24f375109627185.Y3JvcCw4OTQsNzAwLDUzLDA.jpg"></object>  -->
    <div class="photo"> </div>
    <div class="selected_date">
      <?php
          echo 'Moisture on   ' .$_GET['moisture'] .'   list' ."<br><br><br>";
      ?>
    </div>
    



<?php
$servername = "database-2.ctwjgqaa6ssa.ap-southeast-1.rds.amazonaws.com";
$username = "adminpp";
$password = "Pploveminju2543";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully" . "<br>" . "<br>". "<br>";


$date = $_GET['moisture'];
echo date("Y/m/d",strtotime($date)); //test date that we select

$sql = "SELECT * FROM moisture WHERE date = '{$date}'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='table'>";
    echo "<table>";
    echo "<tr>" . "<td>  time</td>" . "<td>groups</td>" . "<td>dev1</td>" . "<td>dev2</td>" . "<td>dev3</td>" . "<td>dev4</td>" . "<td>dev5</td>" . "<td>dev6</td>" . "<td>dev7</td>" . "<td>dev8</td>" . "</tr>"; 
    while($row = mysqli_fetch_assoc($result)) {
    // echo "date: " . $row["date"] . " - Name: " . $row[""]. " . "<br>";

    echo "<tr>" . "<td>" . $row["time"]."</td>" . "<td>" . $row["groups"]. "</td>" . "<td>" . $row["dev1"]. "</td>" . "<td>" . $row["dev2"] ."</td>" . "<td>" . $row["dev3"] . "</td>" . "<td>" . $row["dev4"] . "</td>" . "<td>" . $row["dev5"] . "</td>" . "<td>" . $row["dev6"] . "</td>" . "<td>" . $row["dev7"] . "</td>" . "<td>" . $row["dev8"] . "</td>"  . "</tr>";
    
}
echo"</table>";
echo "</div>";
}
 else {
  echo "0 results";
}


$sqltemp = "SELECT * FROM temp WHERE date = '{$date}'";
$resulttemp = mysqli_query($conn, $sqltemp);

if (mysqli_num_rows($resulttemp) > 0) {
  echo "<div class='table'>";
  echo "<table>";
  echo "<tr>" . "<td> temp </td>" . "</tr>"; 
  while($row = mysqli_fetch_assoc($resulttemp)) {
  // echo "date: " . $row["date"] . " - Name: " . $row[""]. " . "<br>";

  echo "<tr>" . "<td>" . $row["temp"] . "</td>" . "</tr>";
  
}
echo"</table>";
echo "</div>";
}
else {
echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>

