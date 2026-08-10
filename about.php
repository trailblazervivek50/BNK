<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BNK</title>
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

        .page-header { text-align: center; margin-bottom: 40px; }
        .page-header h1 { color: var(--dark); font-size: 3rem; margin-bottom: 10px; }
        .page-header p { color: #666; font-size: 1.2rem; }

        .about-section {
            background: white; border-radius: 15px; padding: 40px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .about-section h2 { color: var(--dark); font-size: 2rem; margin-bottom: 20px; }
        .about-section p { color: #555; line-height: 1.8; margin-bottom: 15px; }

        .mission-vision {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 30px;
        }
        .mv-card {
            background: white; padding: 30px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border-left: 5px solid var(--primary);
        }
        .mv-card h3 { color: var(--dark); font-size: 1.5rem; margin-bottom: 15px; }
        .mv-card p { color: #555; line-height: 1.6; }

        .team-section {
            background: white; border-radius: 15px; padding: 40px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); margin-bottom: 30px;
        }
        .team-section h2 { color: var(--dark); font-size: 2rem; margin-bottom: 30px; text-align: center; }
        .team-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;
        }
        .team-card {
            text-align: center; padding: 20px; border-radius: 10px; background: #f9f9f9;
        }
        .team-card .avatar {
            width: 100px; height: 100px; background: var(--primary); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;
            font-size: 2.5rem; color: white;
        }
        .team-card h3 { color: var(--dark); margin-bottom: 5px; }
        .team-card p { color: #666; font-size: 0.9rem; }

        .stats-section {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;
        }
        .stat-card {
            background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;
        }
        .stat-card h3 { color: var(--dark); font-size: 2.5rem; margin-bottom: 5px; }
        .stat-card p { color: #666; font-size: 1rem; }

        .features-section {
            background: white; border-radius: 15px; padding: 40px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); margin-bottom: 30px;
        }
        .features-section h2 { color: var(--dark); font-size: 2rem; margin-bottom: 30px; text-align: center; }
        .features-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;
        }
        .feature-card {
            text-align: center; padding: 25px; border-radius: 10px; background: #f9f9f9;
            transition: 0.3s;
        }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
        .feature-card .icon { font-size: 3rem; color: var(--primary); margin-bottom: 15px; }
        .feature-card h3 { color: var(--dark); margin-bottom: 10px; }
        .feature-card p { color: #666; line-height: 1.6; }

        footer { background: #222; color: white; text-align: center; padding: 20px; margin-top: 50px; }

        @media (max-width: 768px) {
            .page-header h1 { font-size: 2rem; }
            .mission-vision { grid-template-columns: 1fr; }
            .team-grid { grid-template-columns: 1fr; }
            .features-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">🌾 BNK</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="guidance.php">Crop Guidance</a>
            <a href="market.php">Market Price</a>
            <a href="schemes.php">Govt Schemes</a>
            <a href="about.php" class="active">About Us</a>
            <a href="contact.php">Contact Us</a>
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
            <h1>👨‍💻 About Us</h1>
            <p>Empowering Farmers with Technology</p>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <h3>5000+</h3>
                <p>Active Farmers</p>
            </div>
            <div class="stat-card">
                <h3>28</h3>
                <p>States Covered</p>
            </div>
            <div class="stat-card">
                <h3>50+</h3>
                <p>Crops Tracked</p>
            </div>
            <div class="stat-card">
                <h3>100+</h3>
                <p>Schemes Available</p>
            </div>
        </div>

        <div class="about-section">
            <h2>🌱 Who We Are</h2>
            <p>
                BNK is a revolutionary agricultural platform designed to empower farmers across India with 
                cutting-edge technology and real-time information. We believe that every farmer deserves access to 
                the latest market prices, expert crop guidance, and government schemes to maximize their productivity 
                and profitability.
            </p>
            <p>
                Our mission is to bridge the gap between traditional farming practices and modern technology, 
                making agriculture more efficient, sustainable, and profitable for farmers of all scales.
            </p>
        </div>

        <div class="mission-vision">
            <div class="mv-card">
                <h3>🎯 Our Mission</h3>
                <p>
                    To provide farmers with accessible, affordable, and accurate agricultural information 
                    and services that help them make informed decisions and improve their livelihoods.
                </p>
            </div>
            <div class="mv-card">
                <h3>👁️ Our Vision</h3>
                <p>
                    To create a digitally empowered agricultural ecosystem where every farmer has access 
                    to the tools and information needed to thrive in the modern farming landscape.
                </p>
            </div>
        </div>

        <div class="features-section">
            <h2>✨ What We Offer</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon">📊</div>
                    <h3>Market Prices</h3>
                    <p>Real-time mandi rates from across India to help farmers get the best prices for their produce.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🌾</div>
                    <h3>Crop Guidance</h3>
                    <p>Expert advice on planting, watering, fertilizing, and harvesting for optimal crop yields.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🏛️</div>
                    <h3>Govt Schemes</h3>
                    <p>Information about government subsidies and schemes to support farmers financially.</p>
                </div>
                <div class="feature-card">
                    <div class="icon">🤖</div>
                    <h3>AI Disease Detection</h3>
                    <p>Upload crop images and get instant disease detection with AI-powered technology.</p>
                </div>
            </div>
        </div>

        <!-- <div class="team-section">
            <h2>👥 Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-card">
                    <div class="avatar">👨‍💻</div>
                    <h3>Rahul Kumar</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-card">
                    <div class="avatar">👩‍💻</div>
                    <h3>Priya Sharma</h3>
                    <p>Lead Developer</p>
                </div>
                <div class="team-card">
                    <div class="avatar">👨‍🔬</div>
                    <h3>Amit Patel</h3>
                    <p>Agriculture Expert</p>
                </div>
                <div class="team-card">
                    <div class="avatar">👩‍🎨</div>
                    <h3>Sneha Singh</h3>
                    <p>UI/UX Designer</p>
                </div>
            </div> -->
        </div>
    </div>

    <footer>
        <p>&copy; 2023 BNK Hackathon Project | Built for Farmers</p>
    </footer>
</body>
</html>