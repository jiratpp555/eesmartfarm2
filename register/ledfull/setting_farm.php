<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Setting</title>

</head>
<body>

<link rel="stylesheet" href="CSS/style.css">    
    <div>   
    </div> 
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
    


    <form action="setting_farm_confirm.php"> 

    <h1>Photo</h1>
  <label>Select group:</label>
  <input type="number" min="1" max="6" id="photo_group" name="photo_group" class="photo_group" method="get" >
  <input type="checkbox" name="check_photo_group" >All<br><br>
  <input type="submit" class="send_btn" value="Send"><br><br><br>
    </form> 

    <form action="setting_farm_confirm.php"> 
    <h1>Water</h1>
  <label>Select group:</label>
  <input type="number" min="1" max="6" id="water_group" name="water_group" method="get" >
  <input type="checkbox" method="get" name="check_water_group">All<br>
  <!-- <input type="submit" class="send_btn" value="Send"><br><br> -->

  <label>Select device:</label>
  <input type="number" min="1" max="8" id="water_device" name="water_device" method="get" >
  <input type="checkbox" method="get" name="check_water_device">All<br><br>
  <input type="submit" class="send_btn" value="Send"><br><br>

    </form>

    <form action="setting_farm_confirm.php">
    <h1>Humidity</h1> 
  <label>Select group:</label>
  <input type="number" min="1" max="6" id="humidity_group" name="humidity_group" method="get" >
  <input type="checkbox" method="get" name="check_humidity" id="check_humidity">All<br>
  
  percent: <input type="number" min="1" max="100" id="percent" name="percent" method="get" required> %<br>

  interval: <input type="number" min="1" max="1000" id="interval" name="interval" method="get" required> minutes<br><br>

  <input type="submit" class="send_btn" value="Send"><br><br>
    </form>

    <br><br><br>
    <input type=button class="backbtn" onClick='window.history.back()' value='Back'>

</body>
</html>