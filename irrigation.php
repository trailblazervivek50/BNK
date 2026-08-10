```php
<?php
session_start();

/* Default Motor Status */
if(!isset($_SESSION['motor'])){
    $_SESSION['motor'] = "OFF";
}

/* Simulated Soil Moisture Level */
$moisture = rand(30,80);

/* Motor Control */
if(isset($_POST['on'])){
    $_SESSION['motor'] = "ON";
}

if(isset($_POST['off'])){
    $_SESSION['motor'] = "OFF";
}

$motor = $_SESSION['motor'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Smart Irrigation System</title>

<style>

body{
font-family: Arial;
background:#eef2f3;
text-align:center;
margin:0;
}

.navbar{
background:#27ae60;
color:white;
padding:15px;
font-size:22px;
}

.container{
background:white;
width:420px;
margin:auto;
margin-top:60px;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

.status{
font-size:20px;
margin:20px 0;
}

.moisture{
font-size:18px;
color:#444;
}

button{
padding:12px 20px;
margin:10px;
font-size:16px;
border:none;
cursor:pointer;
border-radius:5px;
}

.on{
background:#2ecc71;
color:white;
}

.off{
background:#e74c3c;
color:white;
}

</style>

</head>

<body>

<div class="navbar">
Smart Irrigation Control
</div>

<div class="container">

<h2>Farm Motor Control</h2>

<div class="moisture">
Soil Moisture Level: <b><?php echo $moisture; ?>%</b>
</div>

<div class="status">
Motor Status:
<b style="color:<?php echo ($motor=='ON')?'green':'red'; ?>">
<?php echo $motor; ?>
</b>
</div>

<form method="POST">

<button class="on" name="on">Turn ON Motor</button>

<button class="off" name="off">Turn OFF Motor</button>

</form>

</div>

</body>
</html>
```
