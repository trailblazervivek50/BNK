```php
<?php
$city = "Pune";
$apiKey = "6c7d273da8d3db6103337cc0fa1a3bc7"; 

$url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=".$apiKey;

$response = file_get_contents($url);
$data = json_decode($response, true);

$temp = $data['main']['temp'];
$humidity = $data['main']['humidity'];
$weather = $data['weather'][0]['main'];

$advice = "";

/* Smart Farming Advice */

if($weather == "Rain"){
    $advice = "Rain expected today. Avoid irrigation and protect crops.";
}
elseif($temp > 35){
    $advice = "Temperature is very high. Irrigate crops in evening.";
}
elseif($humidity > 80){
    $advice = "High humidity detected. Risk of fungal disease.";
}
else{
    $advice = "Weather conditions are suitable for normal farming activities.";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>BNK Weather Advisory</title>

<style>

body{
font-family: Arial;
background:#eef6f1;
margin:0;
text-align:center;
}

.navbar{
background:#27ae60;
color:white;
padding:15px;
font-size:22px;
}

.container{
background:white;
width:450px;
margin:auto;
margin-top:60px;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

.weather{
font-size:20px;
margin:12px;
}

.advice{
margin-top:20px;
padding:15px;
background:#eafaf1;
border-left:5px solid green;
font-size:18px;
}

</style>

</head>

<body>

<div class="navbar">
BNK Weather Advisory
</div>

<div class="container">

<h2>🌦 Live Weather Report</h2>

<div class="weather">
Temperature: <?php echo $temp; ?> °C
</div>

<div class="weather">
Humidity: <?php echo $humidity; ?> %
</div>

<div class="weather">
Weather Condition: <?php echo $weather; ?>
</div>

<div class="advice">
<b>Farmer Advice:</b><br>
<?php echo $advice; ?>
</div>

</div>

</body>
</html>
```
