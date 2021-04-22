<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Data</title>

    <script src="https://unpkg.com/axios/dist/axios.min.js">
</script>
</head>

<body>
    <link rel="stylesheet" href="CSS/style.css">    
    <div>   
    </div> 
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">   

    <h1>Do you want to confirm this setup?</h1>

    <?php
          
        if(empty($_GET['check_photo_group'])) {
            //check if photo group empty
            if(empty($_GET['photo_group'])){
                echo "You didn't select group photo" . "<br>";
            }
            else{
            echo 'Take photo on group  ' .$_GET['photo_group'] ."<br><br>";
            $photo_group = $_GET['photo_group'] ;
            }   
        }
        else{
            echo 'Function take all photo is   ' . $_GET["check_photo_group"] .'.<br>';
            $photo_all = 1;
        }


        //check if water group or water device empty
        if(empty($_GET['check_water_group'])){
            if(empty($_GET['water_group'])){
                echo "You didn't select water group." . "<br>";
            }
            else {
                if(empty($_GET['check_water_device'])){
                    if(empty($_GET['water_device'])){
                        echo "You didn't select water device." . "<br>";
                    }
                    else{
                        echo 'Turn on water on group: ' .$_GET['water_group'] . '  , device: ' .$_GET['water_device']  . "<br><br>";
                        $water_group = $_GET['water_group'] ;
                        $water_device = $_GET['water_device'] ;
                }
                }
                else{
                    echo 'Open water at all device on group: ' . $_GET['water_group'] . '<br>';
                    $water_device_all = 1;
                    $water_group = $_GET['water_group'] ;
                }
            }
        }
        else {
            echo 'open water all groups.' . "<br>";
            $water_group_all = 1;
        }
        

        //check if humidity is empty
        if(empty($_GET['percent'])){
            echo "You didn't set your humidity. ";
        }
        else{
            if(empty($_GET['check_humidity'])){
                echo 'Humidity not check all' . '<br>';
                echo 'You have select humidity on group: ' .$_GET['humidity_group'] . ',  humidity is ' .$_GET['percent'] . ' percent ' . 'and  interval is ' .$_GET['interval'] . ' minutes' ;
                $humidity_group = $_GET['humidity_group'] ;
                $percent = $_GET['percent'] ;
                $interval = $_GET['interval'] ;
            }
            else{
                echo 'Set all groups with percent: ' . $_GET['percent'] . ' % ' .'  and interval is: ' . $_GET['interval'] . ' minutes';
                $percent = $_GET['percent'] ;
                $interval = $_GET['interval'] ;
                $humidity_group_all = 1;
            }
        }




        if(empty($photo_all)){
            if(empty($_GET['photo_group'])){
                $photo_group = -10;
            }
        }
        else {
            $photo_group = 1000;
        }

        if(empty($water_group_all)) {
            if(empty($_GET['water_group'])) {
                $water_group = -10;
                $water_device = -10;
            }
            else {
                if(empty($water_device_all)) {
                    if(empty($_GET['water_device'])) {
                        $water_group = -10;
                        $water_device = -10;
                    }
                }
                else {
                    $water_device = 1000;
                }
            }
        }
        else{
            $water_group = 1000;
            $water_device = 1000;
        }

        if(empty($humidity_group_all)) {
            if(empty($_GET['humidity_group'])) {
                $humidity_group = -10;
                $percent = -10;
                $interval = -10;
            }
        }
        else {
            $humidity_group = 1000;
        }

        
        // if(empty($_GET['humidity_group']) ) {
        //     $humidity_group = -10;
        // }
        // if(empty($_GET['percent']) ) {
        //     $percent = -10;
        // }
        // if(empty($_GET['interval']) ) {
        //     $interval = -10;
        // }
        
        
    ?>

<script>
    function getfarm() {
        photo_group = "<?php echo $photo_group; ?>";
        water_group = "<?php echo $water_group; ?>";
        water_device = "<?php echo $water_device; ?>";
        humidity_group = "<?php echo $humidity_group; ?>";
        percent = "<?php echo $percent; ?>";
        interval = "<?php echo $interval; ?>";
      
    const res = axios.get('http://localhost:3000/sqs', { params: { photo_group : photo_group, water_group: water_group, water_device: water_device, humidity_group: humidity_group, percent: percent, interval: interval }}) 
    alert('clicked') 
    }
  
</script>
    <br>
    <input type="button" class="confirm_btn" onclick="getfarm()" value="Confirm" />
    

    <br><br><br>
    <input type=button class="backbtn" onClick='window.history.back()' value='Go Back'>

</body>
</html>
