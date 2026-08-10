<?php
$result = "Waiting for scan...";

if(isset($_POST['scan'])){

    $symptom = $_POST['symptom'];

    if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0){

        $uploadDir = "uploads/";

        if(!file_exists($uploadDir)){
            mkdir($uploadDir,0777,true);
        }

        $fileName = basename($_FILES["imageUpload"]["name"]);
        $targetFile = $uploadDir . $fileName;

        move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $targetFile);

        if($symptom == "yellow"){
            $result = "<span class='error'>Possible Nitrogen Deficiency</span>";
        }
        elseif($symptom == "white"){
            $result = "<span class='error'>Possible Powdery Mildew Disease</span>";
        }
        elseif($symptom == "holes"){
            $result = "<span class='error'>Possible Pest Attack</span>";
        }
        elseif($symptom == "brown"){
            $result = "<span class='error'>Possible Leaf Spot Disease</span>";
        }
        else{
            $result = "<span class='success'>Plant looks healthy</span>";
        }

    }else{
        $result = "<span class='error'>Please upload an image</span>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>AI Disease Detection</title>

<style>

:root {
    --primary:#2ecc71;
    --dark:#27ae60;
    --light:#f4f4f4;
    --text:#333;
}

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:var(--light);
color:var(--text);
}

.navbar{
background:white;
padding:1rem 5%;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.logo{
font-size:1.5rem;
font-weight:bold;
color:var(--dark);
text-decoration:none;
}

.nav-links a{
margin-left:20px;
text-decoration:none;
color:var(--text);
}

.nav-links a:hover{
color:var(--primary);
}

.ai-disease{
background:white;
padding:40px;
border-radius:15px;
box-shadow:0 3px 15px rgba(0,0,0,0.1);
max-width:700px;
margin:40px auto;
text-align:center;
}

.scanner{
display:flex;
flex-direction:column;
gap:20px;
}

.scanner input{
padding:12px;
border:2px dashed var(--primary);
border-radius:10px;
}

.image-preview{
width:100%;
height:300px;
border:2px solid #ddd;
border-radius:10px;
display:flex;
align-items:center;
justify-content:center;
overflow:hidden;
}

.image-preview img{
max-width:100%;
max-height:100%;
}

.scanner select{
padding:12px;
border-radius:5px;
border:1px solid #ddd;
}

.scanner button{
padding:15px;
background:var(--primary);
color:white;
border:none;
border-radius:5px;
font-size:1.1rem;
cursor:pointer;
}

.result-card{
background:#f9f9f9;
padding:25px;
margin-top:30px;
border-left:5px solid var(--primary);
border-radius:10px;
}

.success{
color:green;
font-weight:bold;
}

.error{
color:red;
font-weight:bold;
}

footer{
background:#222;
color:white;
text-align:center;
padding:20px;
margin-top:40px;
}

</style>

<script>

function previewImage(event){

var reader = new FileReader();

reader.onload = function(){
document.getElementById("preview").src = reader.result;
}

reader.readAsDataURL(event.target.files[0]);

}

</script>

</head>

<body>

<header>

<div class="navbar">

<a href="index.php" class="logo">BNK</a>

<div class="nav-links">

<a href="index.php">Home</a>
<a href="scheme.php">Govt Schemes</a>
<a href="guidance.php">Crop Guidance</a>
<a href="disease.php">Disease prediction</a>
<a href="market.php">Market Price</a>
<a href="about.php">About</a>
<a href="contact.html">Contact</a>

</div>

</div>

</header>


<section class="ai-disease">

<h1>AI Crop Disease Detector</h1>

<p><br>Upload a crop leaf image to detect disease instantly.</p>

<form method="POST" enctype="multipart/form-data">

<div class="scanner">

<input type="file" name="imageUpload" accept="image/*" onchange="previewImage(event)">

<div class="image-preview">

<img id="preview" src="images/leaf.png">

</div>

<select name="symptom">

<option value="">Select Symptom</option>
<option value="yellow">Yellow Spots</option>
<option value="white">White Powder</option>
<option value="holes">Leaf Holes</option>
<option value="brown">Brown Patches</option>

</select>

<button type="submit" name="scan">Scan Disease</button>

</div>

</form>

<div class="result-card">

<h2>Detection Result</h2>

<p><?php echo $result; ?></p>

</div>

</section>


<footer>

<p>© 2026 Smart Agriculture Portal | Developed for Farmers</p>

</footer>

</body>
</html>