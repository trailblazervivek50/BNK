<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - AgriConnect</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo"><i class="fas fa-leaf"></i> AgriConnect</a>
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

    <div class="container">
        <div class="hero">
            <div>
                <h1>Smart Farming for India</h1>
                <p>Get real-time market prices, crop guidance, and government schemes.</p>
            </div>
        </div>

        <h2 style="margin-bottom: 20px;">Quick Access</h2>
        <div class="grid-3">
            <div class="card">
                <h3><i class="fas fa-leaf"></i> Crop Guidance</h3>
                <p>Get expert advice on planting, watering, and harvesting your crops.</p>
                <br>
                <a href="guidance.php" class="btn-login">View Guidance</a>
            </div>
            <div class="card">
                <h3><i class="fas fa-money-bill-wave"></i> Market Prices</h3>
                <p>Check the latest mandi rates for Wheat, Rice, Corn, and more.</p>
                <br>
                <a href="market.php" class="btn-login">Check Prices</a>
            </div>
            <div class="card">
                <h3><i class="fas fa-hand-holding-usd"></i> Govt Schemes</h3>
                <p>Apply for subsidies and government support schemes easily.</p>
                <br>
                <a href="schemes.php" class="btn-login">View Schemes</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 AgriConnect Hackathon Project</p>
    </footer>
</body>
</html>