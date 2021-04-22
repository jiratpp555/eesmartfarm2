<!DOCTYPE html>
<html lang="en">

<script src="https://sdk.amazonaws.com/js/aws-sdk-2.0.0-rc10.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOT Smartfarm</title>
    <?php echo "<br><br><br>"; ?>
    <img class="kmitlphoto" src="image/kmitl.png" > <!-- KMITL Photo Sign -->
    <h1 class="title">IOT Smartfarm</h1>
    <h2 class="title">LED Controller</h2>
</head>

<body>

    <link rel="stylesheet" href="CSS/style.css">    
    <div>   
    </div> 
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">


   

<p class="font">Electronics Engineering KMITL</p>
<!-- <p><a href="index.php?logout='1'" style="color: red;">Log out</a></p> -->

</body>
</html>

<!-- LED part -->
<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST['text'])):
    $output = '';
    $filename = 'led.txt';
    if (!file_exists($filename)):
        $myfile = fopen($filename, "w");
    endif;
    file_put_contents($filename, $_POST['text']);   
    $output = array("File content created");
    die(json_encode($output));
else:
?>


<?php

    $n = 'Take a photo'; //must match with button line (line 55)
    $f = 'LED turned off'; //must match with button line (line 56)
   

/*for ($x = 1; $x <= 2; $x++):*/
?>

    <button class="onbtn" id="button" type="button" value="<?php echo $n; ?>">Take a photo</button> <!-- must match with line 48-->
   <!-- <button class="offbtn" id="button" type="button" value="<?php echo $f; ?>">Turn off LED</button> <!-- must match with line 49-->  


<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>     
<script>
$(document).on('click','#button',function(e) {
    var my_text = $(this).val();

    $.ajax({
        type: "POST",
        dataType:"json",
        url: window.location.href,
        data: "text=" + my_text,
        beforeSend: function (data) {
            alert('Success');
        },
    });     
});
</script>


<?php endif; ?> 
<!-- End of LED part -->




<!-- create date form for select photo's date -->
    <form action="photo.php">
  <p class="font">Select your date to show photo<br> </p>
  <input type="date" id="photo" class="photo" name="photo" method="get" required>
  <input class="submit" type="submit">
    </form>

<div class="next">
   
</div>

<!-- create date form for select moisture's date -->
<form action="moisture.php">
  <p class="font">Select your date to show moisture and temperature<br> </p>
  <input type="date" id="moisture" class="photo" name="moisture" method="get" required>
  <input class="submit" type="submit">
    </form>


<!-- Settings page -->
<form action="setting_farm.php">
    <input type="submit" class="setting_farm_btn" value="Settings" />
</form>    
    


<div class="next">
   
</div>
    


    
  
   