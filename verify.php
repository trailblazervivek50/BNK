<!DOCTYPE html>
<html lang="en">
<head>
<title>Seed / Fertilizer Verification</title>
<link rel="stylesheet" href="style.css">
</head>
    <style>
        .navbar {
    background: white; padding: 1rem 5%; display: flex; justify-content: space-between;
    align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;
}
body{
font-family: Arial, sans-serif;
background:#f3f6f2;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

.verify-container{
background:white;
width:550px;
padding:50px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
text-align:center;
}

.verify-container h1{
font-size:34px;
margin-bottom:10px;
}

.verify-container p{
font-size:18px;
color:#666;
margin-bottom:30px;
}

input{
width:100%;
padding:15px;
margin:12px 0;
font-size:16px;
border:1px solid #ccc;
border-radius:6px;
}

button{
width:100%;
padding:15px;
font-size:18px;
background:linear-gradient(to right,#2e7d32,#66bb6a);
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

button:hover{
opacity:0.9;
}

#result{
margin-top:20px;
font-size:18px;
font-weight:bold;
}

</style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo"><i class="fas fa-leaf"></i> BNK</a>
        <div class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="scheme.php">Govt Schemes</a>
            <a href="guidance.php">Crop Guidance</a>
            <a href="prediction.php">Disease prediction</a>
            <a href="market.php">Market Price</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="btn-login" style="background:#e74c3c;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>
<div class="verify-container">

<h1>Seed / Fertilizer Verification</h1>
<p>Check if the agricultural product is genuine</p>

<input type="text" id="product" placeholder="Product Name">

<input type="text" id="brand" placeholder="Brand Name">

<input type="text" id="batch" placeholder="Batch Number">

<button onclick="verifyProduct()">Verify Product</button>

<div id="result"></div>

</div>

<script>

function verifyProduct(){

let product = document.getElementById("product").value.toLowerCase();
let brand = document.getElementById("brand").value.toLowerCase();
let batch = document.getElementById("batch").value.toLowerCase();

/* Sample database */

let database = [
{product:"urea fertilizer", brand:"iffco", batch:"iffco2024"},
{product:"dap fertilizer", brand:"tata chemicals", batch:"dap123"},
{product:"hybrid tomato seeds", brand:"mahyco", batch:"seed456"}
];

let found = false;

for(let i=0;i<database.length;i++){

if(product == database[i].product &&
brand == database[i].brand &&
batch == database[i].batch){

found = true;
break;

}

}

if(found){

document.getElementById("result").innerHTML =
"✅ Genuine Product Verified";
document.getElementById("result").style.color="green";

}else{

document.getElementById("result").innerHTML =
"❌ Product Not Found – Possible Fake Product";
document.getElementById("result").style.color="red";

}

}

</script>

</body>
</html>