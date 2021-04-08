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
          echo 'Picture on   ' .$_GET['photo'] .'   list' ."<br><br><br>";
      ?>
    </div>
    
<?php


//connect with s3
require './aws.phar';

use Aws\S3\S3Client;

$s3 = S3Client::factory(array( 
  'credentials' => array(
  'key'    => 'AKIAVUA7V5RRDBZRGUTB',
  'secret' => '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',
  ),
  'region' => 'ap-southeast-1',
  'signature' => 'v4',
  'version' => 'latest',
));

$bucket = 'iotsmartfarm';

$objects = $s3->getIterator('ListObjects', array(
  "Bucket" => $bucket,
));

echo "<br>";
?>


<?php

//check datetime
foreach ($objects as $object) { //order images using function foreach
  
  $last_modified = $object['LastModified'];
  $key = $object['Key'];
  
  
  date_default_timezone_set("Asia/Bangkok");
//   echo gettype($_GET['photo']);
  $date_check = date_create($_GET['photo']); //date that we choose in website
//   echo date_format($date_check,"Y/m/d"). "<br>";
  
  $temp = date_timezone_set($last_modified,timezone_open("Asia/Bangkok")); //set timezone +0:00 to +7:00
//   echo date($temp). "<br>";

  $diff = date_diff($date_check,$temp); //check date diff 
  //echo $diff->format("%R%a"). "<br>"; //diff of days
  ?>



  <?php
  if($diff->format("%R%a") === "+0"){
      echo '<img class="display_picture" src="https://iotsmartfarm.s3-ap-southeast-1.amazonaws.com/'.$key.'" 
      onclick="onClick(this)" style="cursor:pointer" ></img> '."<br>"; //display picture from s3
      echo $key ."<br>";
      echo date_format($object['LastModified'],"H:i:s") . "<br><br>";
  }
//   echo $diff->format("%a"). "<br>";
   //selected picture key
}
  ?>

<div id="modal01" class="w3-modal" onclick="this.style.display='none'">
  <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
  <div class="w3-modal-content w3-animate-zoom">
    <img id="img01" style="width:100%">
  </div>
</div>

<script>
function onClick(element) {
  document.getElementById("img01").src = element.src ;
  document.getElementById("modal01").style.display = "block";
}
</script>

<!-- create back button -->
  <input type=button class="backbtn" onClick='window.history.back()' value='Back'>  

</body>
</html>

