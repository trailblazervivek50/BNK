
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Prices - AgriConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .market-table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
            overflow-x: auto;
        }

        .market-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .market-table thead {
            background: var(--primary);
            color: white;
        }

        .market-table th,
        .market-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .market-table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .market-table tbody tr:hover {
            background: #f9f9f9;
        }

        .market-table .price {
            font-weight: bold;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .market-table .trend {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .market-table .trend.up {
            background: #d4edda;
            color: #155724;
        }

        .market-table .trend.down {
            background: #f8d7da;
            color: #721c24;
        }

        .market-table .crop-icon {
            color: var(--primary);
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .market-search {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .market-search input,
        .market-search select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            flex: 1;
            min-width: 200px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-card h3 {
            color: var(--dark);
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .price-alert {
            margin-top: 30px;
            background: #fff8e1;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #f1c40f;
        }

        .price-alert h3 {
            color: #f39c12;
            margin-bottom: 15px;
        }

        .alert-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .alert-form input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            flex: 1;
            min-width: 150px;
        }

        .btn-submit {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .market-table th,
            .market-table td {
                padding: 8px 10px;
                font-size: 0.85rem;
            }
            .market-search {
                flex-direction: column;
            }
            .market-search input,
            .market-search select {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo"><i class="fas fa-leaf"></i> AgriConnect</a>
        <div class="nav-links">
              <a href="index.php" class="active">Home</a>
            <a href="schemes.php">Govt Schemes</a>
            <a href="guidance.php">Crop Guidance</a>
            <a href="prediction.html">Disease prediction</a>
            <a href="market.php">Market Price</a>
            <a href="about.php">About</a>
            <a href="contact.html">Contact</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="btn-login" style="background:#e74c3c;">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-chart-line"></i> Live Market Prices</h1>
            <p>Get real-time mandi rates from all states across India</p>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <h3>₹2,150</h3>
                <p>Average Wheat Price</p>
            </div>
            <div class="stat-card">
                <h3>₹3,400</h3>
                <p>Average Rice Price</p>
            </div>
            <div class="stat-card">
                <h3>28</h3>
                <p>States Covered</p>
            </div>
            <div class="stat-card">
                <h3>50+</h3>
                <p>Crops Available</p>
            </div>
        </div>

        <div class="market-search">
            <input type="text" id="searchCrop" placeholder="🔍 Search crop name..." onkeyup="filterMarket()">
            <select id="stateFilter" onchange="filterMarket()">
                <option value="">📍 All States</option>
                <option value="Punjab">Punjab</option>
                <option value="Haryana">Haryana</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Bihar">Bihar</option>
                <option value="West Bengal">West Bengal</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Telangana">Telangana</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Odisha">Odisha</option>
                <option value="Assam">Assam</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Kerala">Kerala</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
            </select>
        </div>

        <div class="market-table-container">
            <table class="market-table">
                <thead>
                    <tr>
                        <th>Crop</th>
                        <th>State</th>
                        <th>Mandi</th>
                        <th>Price (₹/Quintal)</th>
                        <th>Trend</th>
                        <th>Last Updated</th>
                    </tr>
                </thead>
                <tbody id="marketData">
                    <!-- CEREALS -->
                    <tr><td>🌾 Wheat</td><td>Punjab</td><td>Ludhiana</td><td class="price">₹2,150</td><td><span class="trend up">▲ +2.5%</span></td><td>Today</td></tr>
                    <tr><td>🌾 Wheat</td><td>Haryana</td><td>Gurugram</td><td class="price">₹2,100</td><td><span class="trend up">▲ +1.8%</span></td><td>Today</td></tr>
                    <tr><td>🌾 Wheat</td><td>Uttar Pradesh</td><td>Meerut</td><td class="price">₹2,050</td><td><span class="trend down">▼ -0.5%</span></td><td>Today</td></tr>
                    <tr><td>🌾 Wheat</td><td>Rajasthan</td><td>Jaipur</td><td class="price">₹2,000</td><td><span class="trend up">▲ +1.2%</span></td><td>Yesterday</td></tr>
                    <tr><td>🌾 Wheat</td><td>Madhya Pradesh</td><td>Indore</td><td class="price">₹1,950</td><td><span class="trend up">▲ +0.8%</span></td><td>Today</td></tr>
                    <tr><td>🌾 Wheat</td><td>Bihar</td><td>Patna</td><td class="price">₹1,900</td><td><span class="trend up">▲ +1.5%</span></td><td>Today</td></tr>
                    <tr><td>🌾 Wheat</td><td>Gujarat</td><td>Ahmedabad</td><td class="price">₹2,050</td><td><span class="trend down">▼ -0.3%</span></td><td>Yesterday</td></tr>
                    <tr><td>🌾 Wheat</td><td>West Bengal</td><td>Kolkata</td><td class="price">₹1,850</td><td><span class="trend up">▲ +2.0%</span></td><td>Today</td></tr>
                    
                    <tr><td>🍚 Rice</td><td>Punjab</td><td>Moga</td><td class="price">₹3,400</td><td><span class="trend down">▼ -1.2%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>West Bengal</td><td>Kolkata</td><td class="price">₹3,200</td><td><span class="trend up">▲ +2.0%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>Andhra Pradesh</td><td>Guntur</td><td class="price">₹3,300</td><td><span class="trend up">▲ +1.5%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>Tamil Nadu</td><td>Chennai</td><td class="price">₹3,100</td><td><span class="trend down">▼ -0.8%</span></td><td>Yesterday</td></tr>
                    <tr><td>🍚 Rice</td><td>Karnataka</td><td>Bangalore</td><td class="price">₹3,250</td><td><span class="trend up">▲ +1.0%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>Odisha</td><td>Bhubaneswar</td><td class="price">₹3,150</td><td><span class="trend up">▲ +1.8%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>Assam</td><td>Guwahati</td><td class="price">₹3,000</td><td><span class="trend up">▲ +2.2%</span></td><td>Today</td></tr>
                    <tr><td>🍚 Rice</td><td>Uttar Pradesh</td><td>Varanasi</td><td class="price">₹3,050</td><td><span class="trend down">▼ -0.5%</span></td><td>Yesterday</td></tr>
                    
                    <tr><td>🌽 Corn</td><td>Haryana</td><td>Gurugram</td><td class="price">₹1,850</td><td><span class="trend up">▲ +0.8%</span></td><td>Today</td></tr>
                    <tr><td>🌽 Corn</td><td>Uttar Pradesh</td><td>Varanasi</td><td class="price">₹1,800</td><td><span class="trend up">▲ +1.2%</span></td><td>Today</td></tr>
                    <tr><td>🌽 Corn</td><td>Madhya Pradesh</td><td>Indore</td><td class="price">₹1,750</td><td><span class="trend down">▼ -0.5%</span></td><td>Yesterday</td></tr>
                    <tr><td>🌽 Corn</td><td>Maharashtra</td><td>Akola</td><td class="price">₹1,800</td><td><span class="trend up">▲ +1.0%</span></td><td>Today</td></tr>
                    <tr><td>🌽 Corn</td><td>Karnataka</td><td>Bangalore</td><td class="price">₹1,780</td><td><span class="trend up">▲ +0.5%</span></td><td>Today</td></tr>
                    
                    <tr><td>☁️ Cotton</td><td>Maharashtra</td><td>Akola</td><td class="price">₹6,200</td><td><span class="trend up">▲ +1.5%</span></td><td>Today</td></tr>
                    <tr><td>☁️ Cotton</td><td>Gujarat</td><td>Surat</td><td class="price">₹8,200</td><td><span class="trend up">▲ +2.5%</span></td><td>Today</td></tr>