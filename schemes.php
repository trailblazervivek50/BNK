<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Govt Schemes - AgriConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary: #2ecc71;
            --dark: #27ae60;
            --light: #f4f4f4;
            --text: #333;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: var(--light); color: var(--text); }

        .navbar {
            background: white; padding: 1rem 5%; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;
        }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--dark); text-decoration: none; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: var(--text); font-weight: 500; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .btn-login { background: var(--primary); color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; }

        .container { max-width: 1200px; margin: 2rem auto; padding: 0 20px; }

        .page-header { text-align: center; margin-bottom: 30px; }
        .page-header h1 { color: var(--dark); font-size: 2.5rem; margin-bottom: 10px; }
        .page-header p { color: #666; font-size: 1.1rem; }

        .search-filter {
            display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;
        }
        .search-filter input, .search-filter select {
            padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; flex: 1; min-width: 200px;
        }

        .scheme-categories {
            display: flex; gap: 10px; margin-bottom: 30px; flex-wrap: wrap;
        }
        .category-btn {
            padding: 10px 20px; border: 2px solid var(--primary); background: white; color: var(--primary);
            border-radius: 25px; cursor: pointer; font-weight: 500; transition: 0.3s;
        }
        .category-btn:hover, .category-btn.active {
            background: var(--primary); color: white;
        }

        .schemes-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 25px; margin-bottom: 40px;
        }

        .scheme-card {
            background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            cursor: pointer; transition: 0.3s; border-left: 5px solid var(--primary);
        }
        .scheme-card:hover {
            transform: translateY(-5px); box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }
        .scheme-card .icon {
            font-size: 2.5rem; color: var(--primary); margin-bottom: 15px;
        }
        .scheme-card h3 {
            color: var(--dark); font-size: 1.3rem; margin-bottom: 10px;
        }
        .scheme-card p {
            color: #666; font-size: 0.95rem; margin-bottom: 15px;
        }
        .scheme-card .badge {
            display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold;
        }
        .badge-income { background: #d4edda; color: #155724; }
        .badge-insurance { background: #fff3cd; color: #856404; }
        .badge-loan { background: #cce5ff; color: #004085; }
        .badge-land { background: #f8d7da; color: #721c24; }
        .badge-tech { background: #e2e3e5; color: #383d41; }

        .scheme-details {
            background: white; border-radius: 15px; padding: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-top: 20px; display: none;
        }
        .scheme-details.active { display: block; }
        .scheme-details .detail-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
        }
        .scheme-details .detail-header h2 { color: var(--dark); }
        .close-btn {
            background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 5px;
            cursor: pointer; font-size: 1.2rem;
        }
        .scheme-details .detail-content {
            line-height: 1.8; color: #555;
        }
        .scheme-details .detail-content ul {
            margin-left: 20px; margin-top: 10px;
        }
        .scheme-details .detail-content li {
            margin-bottom: 8px;
        }
        .apply-btn {
            display: inline-block; background: var(--primary); color: white; padding: 12px 30px;
            border-radius: 5px; text-decoration: none; font-weight: bold; margin-top: 20px;
        }
        .apply-btn:hover { background: var(--dark); }

        .stats-section {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;
        }
        .stat-card {
            background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;
        }
        .stat-card h3 { color: var(--dark); font-size: 2rem; margin-bottom: 5px; }
        .stat-card p { color: #666; font-size: 0.9rem; }

        footer { background: #222; color: white; text-align: center; padding: 20px; margin-top: 50px; }

        @media (max-width: 768px) {
            .schemes-grid { grid-template-columns: 1fr; }
            .search-filter { flex-direction: column; }
            .search-filter input, .search-filter select { width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo"><i class="fas fa-leaf"></i> AgriConnect</a>
        <div class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="scheme.php">Govt Schemes</a>
            <a href="guidance.php">Crop Guidance</a>
            <a href="disease.php">Disease prediction</a>
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
            <h1><i class="fas fa-hand-holding-usd"></i> Government Schemes</h1>
            <p>Apply for subsidies and government support schemes</p>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <h3>25+</h3>
                <p>Total Schemes</p>
            </div>
            <div class="stat-card">
                <h3>15</h3>
                <p>Income Support</p>
            </div>
            <div class="stat-card">
                <h3>5000+</h3>
                <p>Beneficiaries</p>
            </div>
            <div class="stat-card">
                <h3>₹5000Cr</h3>
                <p>Total Subsidy</p>
            </div>
        </div>

        <!-- <div class="search-filter">
            <input type="text" id="searchScheme" placeholder="🔍 Search scheme name..." onkeyup="filterSchemes()">
            <select id="categoryFilter" onchange="filterSchemes()">
                <option value="">📂 All Categories</option>
                <option value="income">Income Support</option>
                <option value="insurance">Insurance</option>
                <option value="loan">Loan Support</option>
                <option value="land">Land Development</option>
                <option value="tech">Technology</option>
            </select>
        </div> -->

        <div class="scheme-categories">
            <button class="category-btn active" onclick="filterByCategory('all')">All</button>
            <!-- <button class="category-btn" onclick="filterByCategory('income')">Income Support</button>
            <button class="category-btn" onclick="filterByCategory('insurance')">Insurance</button>
            <button class="category-btn" onclick="filterByCategory('loan')">Loan Support</button>
            <button class="category-btn" onclick="filterByCategory('land')">Land Development</button>
            <button class="category-btn" onclick="filterByCategory('tech')">Technology</button> -->
        </div>

        <div class="schemes-grid" id="schemesGrid">
            <!-- PM-KISAN -->
            <div class="scheme-card" onclick="showSchemeDetails('pmkisan')">
                <div class="icon"><i class="fas fa-hand-holding-dollar"></i></div>
                <h3>PM-KISAN Samman Nidhi</h3>
                <p>Income support of ₹6,000 per year to small and marginal farmers in 3 installments.</p>
                <span class="badge badge-income">Income Support</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfby')">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Pradhan Mantri Fasal Bima Yojana</h3>
                <p>Crop insurance scheme to protect farmers against crop failure due to natural calamities.</p>
                <span class="badge badge-insurance">Insurance</span>
            </div>

            <!-- KCC -->
            <div class="scheme-card" onclick="showSchemeDetails('kcc')">
                <div class="icon"><i class="fas fa-credit-card"></i></div>
                <h3>Kisan Credit Card (KCC)</h3>
                <p>Short term credit support for farmers for cultivation and other expenses.</p>
                <span class="badge badge-loan">Loan Support</span>
            </div>

            <!-- Soil Health Card -->
            <div class="scheme-card" onclick="showSchemeDetails('soil')">
                <div class="icon"><i class="fas fa-leaf"></i></div>
                <h3>Soil Health Card Scheme</h3>
                <p>Provides information on nutrient status of soil to farmers for better crop planning.</p>
                <span class="badge badge-land">Land Development</span>
            </div>

            <!-- PMKSY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmsky')">
                <div class="icon"><i class="fas fa-water"></i></div>
                <h3>Pradhan Mantri Krishi Sinchai Yojana</h3>
                <p>Improves farm productivity through efficient water management and irrigation.</p>
                <span class="badge badge-land">Land Development</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-seedling"></i></div>
                <h3>Pradhan Mantri Fasal Bima Yojana</h3>
                <p>Comprehensive crop insurance covering pre and post-harvest losses.</p>
                <span class="badge badge-insurance">Insurance</span>
            </div>

            <!-- e-NAM -->
            <div class="scheme-card" onclick="showSchemeDetails('enam')">
                <div class="icon"><i class="fas fa-globe"></i></div>
                <h3>e-NAM (National Agricultural Market)</h3>
                <p>Online trading platform for agricultural commodities across India.</p>
                <span class="badge badge-tech">Technology</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-tractor"></i></div>
                <h3>Subsidy on Agricultural Machinery</h3>
                <p>50% subsidy on tractors, harvesters, and other farm machinery.</p>
                <span class="badge badge-tech">Technology</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-home"></i></div>
                <h3>Pradhan Mantri Awas Yojana (Gramin)</h3>
                <p>Financial assistance for building houses in rural areas.</p>
                <span class="badge badge-income">Income Support</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-briefcase"></i></div>
                <h3>Pradhan Mantri Mudra Yojana</h3>
                <p>Loans up to ₹10 lakhs for non-corporate, non-farm small businesses.</p>
                <span class="badge badge-loan">Loan Support</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                <h3>Pradhan Mantri Kaushal Vikas Yojana</h3>
                <p>Skill development program for farmers and rural youth.</p>
                <span class="badge badge-tech">Technology</span>
            </div>

            <!-- PMFBY -->
            <div class="scheme-card" onclick="showSchemeDetails('pmfb')">
                <div class="icon"><i class="fas fa-umbrella"></i></div>
                <h3>Pradhan Mantri Suraksha Bima Yojana</h3>
                <p>Accident insurance scheme with premium of ₹12 per year.</p>
                <span class="badge badge-insurance">Insurance</span>
            </div>
        </div>

        <!-- Scheme Details Modal -->
        <div id="schemeDetails" class="scheme-details">
            <div class="detail-header">
                <h2 id="schemeTitle">Scheme Title</h2>
                <button class