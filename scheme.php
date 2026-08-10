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
            transition: 0.3s; border-left: 5px solid var(--primary);
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
            margin-bottom: 10px;
        }
        .badge-income { background: #d4edda; color: #155724; }
        .badge-insurance { background: #fff3cd; color: #856404; }
        .badge-loan { background: #cce5ff; color: #004085; }
        .badge-land { background: #f8d7da; color: #721c24; }
        .badge-tech { background: #e2e3e5; color: #383d41; }

        .scheme-details {
            background: #f9f9f9; padding: 20px; border-radius: 10px; margin-top: 15px;
        }
        .scheme-details h4 {
            color: var(--dark); font-size: 1rem; margin-bottom: 10px;
        }
        .scheme-details ul {
            margin-left: 20px; margin-bottom: 15px;
        }
        .scheme-details li {
            margin-bottom: 5px; color: #555; font-size: 0.9rem;
        }
        .scheme-details .btn {
            display: inline-block; padding: 10px 20px; border-radius: 5px; text-decoration: none;
            font-weight: bold; font-size: 0.9rem; margin-top: 10px;
        }
        .btn-apply {
            background: var(--primary); color: white;
        }
        .btn-apply:hover {
            background: var(--dark);
        }

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
            <h1>🏛️ Government Schemes</h1>
            <p>Apply for subsidies and government support schemes</p>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <h3>10</h3>
                <p>Total Schemes</p>
            </div>
            <div class="stat-card">
                <h3>5</h3>
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

        <div class="search-filter">
            <input type="text" id="searchScheme" placeholder="🔍 Search scheme name..." onkeyup="filterSchemes()">
            <select id="categoryFilter" onchange="filterSchemes()">
                <option value="">📂 All Categories</option>
                <option value="income">Income Support</option>
                <option value="insurance">Insurance</option>
                <option value="loan">Loan Support</option>
                <option value="land">Land Development</option>
                <option value="tech">Technology</option>
            </select>
        </div>

        <div class="scheme-categories">
            <button class="category-btn active" onclick="filterByCategory('all')">All</button>
            <button class="category-btn" onclick="filterByCategory('income')">Income Support</button>
            <button class="category-btn" onclick="filterByCategory('insurance')">Insurance</button>
            <button class="category-btn" onclick="filterByCategory('loan')">Loan Support</button>
            <button class="category-btn" onclick="filterByCategory('land')">Land Development</button>
            <button class="category-btn" onclick="filterByCategory('tech')">Technology</button>
        </div>

        <div class="schemes-grid" id="schemesGrid">
            <!-- 1. PM-KISAN -->
            <div class="scheme-card" data-category="income">
                <div class="icon">👨‍🌾</div>
                <h3>PM-KISAN Samman Nidhi</h3>
                <p>Income support of ₹6,000 per year to small and marginal farmers in 3 installments.</p>
                <span class="badge badge-income">Income Support</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Ownership Documents</li>
                        <li>Aadhaar Card</li>
                        <li>Bank Account Details</li>
                        <li>Mobile Number</li>
                        <li>Caste Certificate (if applicable)</li>
                    </ul>
                    <a href="https://pmkisan.gov.in" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            <!-- 2. PMFBY -->
            <div class="scheme-card" data-category="insurance">
                <div class="icon">🛡️</div>
                <h3>Pradhan Mantri Fasal Bima Yojana</h3>
                <p>Crop insurance scheme to protect farmers against crop failure due to natural calamities.</p>
                <span class="badge badge-insurance">Insurance</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Records (7/12 Extract)</li>
                        <li>Aadhaar Card</li>
                        <li>Bank Account Passbook</li>
                        <li>Seed Purchase Receipt</li>
                        <li>Farm Location Details</li>
                    </ul>
                    <a href="https://pmfby.gov.in" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            <!-- 3. KCC -->
            <div class="scheme-card" data-category="loan">
                <div class="icon">💳</div>
                <h3>Kisan Credit Card (KCC)</h3>
                <p>Short term credit support for farmers for cultivation and other expenses.</p>
                <span class="badge badge-loan">Loan Support</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Ownership Documents</li>
                        <li>Aadhaar Card</li>
                        <li>Passport Size Photos</li>
                        <li>Bank Account Details</li>
                        <li>Crop Details</li>
                    </ul>
                    <a href="https://agriwelfare.gov.in/en/Major" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            <!-- 4. Soil Health Card -->
            <div class="scheme-card" data-category="land">
                <div class="icon">🌱</div>
                <h3>Soil Health Card Scheme</h3>
                <p>Provides information on nutrient status of soil to farmers for better crop planning.</p>
                <span class="badge badge-land">Land Development</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Ownership Documents</li>
                        <li>Aadhaar Card</li>
                        <li>Mobile Number</li>
                        <li>Bank Account Details</li>
                    </ul>
                    <a href="https://soilhealth.dac.gov.in" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            <!-- 5. PMKSY -->
            <div class="scheme-card" data-category="land">
                <div class="icon">💧</div>
                <h3>Pradhan Mantri Krishi Sinchai Yojana</h3>
                <p>Improves farm productivity through efficient water management and irrigation.</p>
                <span class="badge badge-land">Land Development</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Ownership Documents</li>
                        <li>Aadhaar Card</li>
                        <li>Bank Account Details</li>
                        <li>Water Source Details</li>
                        <li>Farm Location Map</li>
                    </ul>
                    <a href=" https://agriwelfare.gov.in/en/Major" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            <!-- 6. e-NAM -->
            <div class="scheme-card" data-category="tech">
                <div class="icon">🌐</div>
                <h3>e-NAM (National Agricultural Market)</h3>
                <p>Online trading platform for agricultural commodities across India.</p>
                <span class="badge badge-tech">Technology</span>
                <div class="scheme-details">
                    <h4>📋 Documents Required:</h4>
                    <ul>
                        <li>Land Ownership Documents</li>
                        <li>Aadhaar Card</li>
                        <li>Bank Account Details</li>
                        <li>Mobile Number</li>
                        <li>Farmer Registration</li>
                    </ul>
                    <a href="https://enam.gov.in/web/?utm_source=chatgpt.com" target="_blank" class="btn btn-apply">📝 Apply Now</a>
                </div>
            </div>

            