<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - BNK</title>
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

        .contact-section {
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px;
        }

        .contact-info {
            background: white; padding: 40px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        .contact-info h2 { color: var(--dark); font-size: 2rem; margin-bottom: 30px; }
        .info-item {
            display: flex; align-items: center; margin-bottom: 25px; padding: 15px;
            background: #f9f9f9; border-radius: 10px; transition: 0.3s;
        }
        .info-item:hover { transform: translateX(5px); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .info-item .icon {
            font-size: 2rem; color: var(--primary); margin-right: 20px;
        }
        .info-item h3 { color: var(--dark); font-size: 1.1rem; margin-bottom: 5px; }
        .info-item p { color: #666; }

        .contact-form {
            background: white; padding: 40px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }
        .contact-form h2 { color: var(--dark); font-size: 2rem; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--dark); font-weight: 500; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 5px;
            font-size: 1rem; transition: 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none; border-color: var(--primary); box-shadow: 0 0 5px rgba(46, 204, 113, 0.3);
        }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .submit-btn {
            width: 100%; padding: 15px; background: var(--primary); color: white;
            border: none; border-radius: 5px; font-size: 1.1rem; font-weight: bold;
            cursor: pointer; transition: 0.3s;
        }
        .submit-btn:hover { background: var(--dark); transform: translateY(-2px); }

        .map-section {
            background: white; padding: 40px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); margin-bottom: 40px;
        }
        .map-section h2 { color: var(--dark); font-size: 2rem; margin-bottom: 20px; text-align: center; }
        .map-container {
            width: 100%; height: 400px; background: #e0e0e0; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .map-placeholder { text-align: center; color: #666; }
        .map-placeholder i { font-size: 4rem; color: var(--primary); margin-bottom: 15px; }

        .social-section {
            background: white; padding: 40px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1); margin-bottom: 40px;
        }
        .social-section h2 { color: var(--dark); font-size: 2rem; margin-bottom: 20px; text-align: center; }
        .social-icons {
            display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;
        }
        .social-icon {
            width: 60px; height: 60px; background: var(--primary); color: white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; transition: 0.3s; text-decoration: none;
        }
        .social-icon:hover { background: var(--dark); transform: translateY(-5px); }

        footer { background: #222; color: white; text-align: center; padding: 20px; margin-top: 50px; }

        @media (max-width: 768px) {
            .contact-section { grid-template-columns: 1fr; }
            .page-header h1 { font-size: 2rem; }
            .social-icons { gap: 15px; }
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
            <a href="about.php">About Us</a>
            <a href="contact.php" class="active">Contact Us</a>
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
            <h1>📞 Contact Us</h1>
            <p>We'd love to hear from you! Get in touch with us.</p>
        </div>

        <!-- Success/Error Messages -->
        <?php if(isset($_GET['success'])): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                <i>✅</i> <?php echo $_GET['success']; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error'])): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center;">
                <i>❌</i> <?php echo $_GET['error']; ?>
            </div>
        <?php endif; ?>

        <div class="contact-section">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2>📍 Get In Touch</h2>
                
                <div class="info-item">
                    <div class="icon">📍</div>
                    <div>
                        <h3>Address</h3>
                        <p>456 Farm Market Road, Solapur, Maharashtra - 413001</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon">📞</div>
                    <div>
                        <h3>Phone</h3>
                        <p>+91 98765 43210</p>
                        <p>+91 12345 67890</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon">📧</div>
                    <div>
                        <h3>Email</h3>
                        <p>info@agritech.com</p>
                        <p>support@agritech.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon">🕐</div>
                    <div>
                        <h3>Working Hours</h3>
                        <p>Monday - Saturday: 9:00 AM - 6:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon"></div>
                    <!-- <div>
                        <h3>Support ID</h3>
                        <p>AGRI-2023-001</p>
                    </div> -->
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h2>✉️ Send Message</h2>
                <form action="send_contact.php" method="POST">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number" required>
                    </div>

                    <div class="form-group">
                        <label>Subject *</label>
                        <input type="text" name="subject" placeholder="What is this regarding?" required>
                    </div>

                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" placeholder="Write your message here..." required></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label>Department *</label>
                        <select name="department" required>
                            <option value="">Select Department</option>
                            <option value="general">General Inquiry</option>
                            <option value="support">Technical Support</option>
                            <option value="schemes">Government Schemes</option>
                            <option value="market">Market Prices</option>
                            <option value="guidance">Crop Guidance</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div> -->

                    <button type="submit" class="submit-btn">📤 Send Message</button>
                </form>
            </div>
        </div>

        <!-- Map Section - SOLAPUR -->
        <div class="map-section">
            <h2>🗺️ Our Location</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.789012345678!2d75.9123!3d17.6590!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c0c0c0c0c0c0%3A0x0c0c0c0c0c0c0c0c!2sSolapur%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Social Media Section -->
        <!-- <div class="social-section">
            <h2>🌐 Follow Us</h2>
            <div class="social-icons">
                <a href="#" class="social-icon">📘</a>
                <a href="#" class="social-icon">🐦</a>
                <a href="#" class="social-icon">📸</a>
                <a href="#" class="social-icon">💼</a>
                <a href="#" class="social-icon">📺</a>
                <a href="#" class="social-icon">📱</a>
            </div> -->
        </div>
    </div>

    <footer>
        <p>&copy; 2023 BNK Hackathon Project | Built for Farmers</p>
    </footer>
</body>
</html>