<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Guidance - BNK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo"><i class="fas fa-leaf"></i> BNK</a>
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
            <h1><i class="fas fa-seedling"></i> Crop Guidance</h1>
            <p>Expert advice for better farming and higher yields</p>
        </div>

        <!-- Crop Selection -->
        <div class="crop-selector">
            <h2>Select Your Crop</h2>
            <div class="crop-grid">
                <div class="crop-card" onclick="showCropInfo('wheat')">
                    <i class="fas fa-wheat"></i>
                    <h3>Wheat</h3>
                </div>
                <div class="crop-card" onclick="showCropInfo('rice')">
                    <i class="fas fa-water"></i>
                    <h3>Rice</h3>
                </div>
                <div class="crop-card" onclick="showCropInfo('corn')">
                    <i class="fas fa-sun"></i>
                    <h3>Corn</h3>
                </div>
                <div class="crop-card" onclick="showCropInfo('cotton')">
                    <i class="fas fa-cloud"></i>
                    <h3>Cotton</h3>
                </div>
            </div>
        </div>

        <!-- Crop Information Display -->
        <div id="cropInfo" class="crop-info-box hidden">
            <div class="info-header">
                <h2 id="cropName">Crop Name</h2>
                <span class="season-badge">Season: <span id="cropSeason"></span></span>
            </div>
            <div class="info-content">
                <div class="info-section">
                    <h3><i class="fas fa-calendar"></i> Planting Time</h3>
                    <p id="plantingTime"></p>
                </div>
                <div class="info-section">
                    <h3><i class="fas fa-tint"></i> Water Requirement</h3>
                    <p id="waterReq"></p>
                </div>
                <div class="info-section">
                    <h3><i class="fas fa-temperature-high"></i> Temperature</h3>
                    <p id="temperature"></p>
                </div>
                <div class="info-section">
                    <h3><i class="fas fa-leaf"></i> Soil Type</h3>
                    <p id="soilType"></p>
                </div>
                <div class="info-section">
                    <h3><i class="fas fa-tools"></i> Fertilizer</h3>
                    <p id="fertilizer"></p>
                </div>
                <div class="info-section">
                    <h3><i class="fas fa-bug"></i> Common Diseases</h3>
                    <p id="diseases"></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 BNK Hackathon Project | Built for Farmers</p>
    </footer>

    <script>
        const cropData = {
            wheat: {
                name: "Wheat",
                season: "Winter (Oct-Mar)",
                planting: "October to December",
                water: "4-5 irrigations during growth",
                temp: "15-25°C",
                soil: "Loamy soil with good drainage",
                fertilizer: "NPK 150-40-40 kg/hectare",
                diseases: "Rust, Blight, Smut"
            },
            rice: {
                name: "Rice",
                season: "Kharif (Jun-Oct)",
                planting: "June to July",
                water: "Continuous flooding required",
                temp: "20-35°C",
                soil: "Clay loam with water retention",
                fertilizer: "NPK 120-60-40 kg/hectare",
                diseases: "Blast, Brown Spot, Bacterial Blight"
            },
            corn: {
                name: "Corn (Maize)",
                season: "Summer (Mar-Jun)",
                planting: "March to June",
                water: "Regular irrigation needed",
                temp: "21-27°C",
                soil: "Well-drained loamy soil",
                fertilizer: "NPK 120-60-40 kg/hectare",
                diseases: "Leaf Blight, Stem Borer, Rust"
            },
            cotton: {
                name: "Cotton",
                season: "Kharif (Jun-Oct)",
                planting: "June to July",
                water: "4-6 irrigations",
                temp: "21-30°C",
                soil: "Black cotton soil preferred",
                fertilizer: "NPK 120-60-40 kg/hectare",
                diseases: "Boll Rot, Leaf Curl, Aphids"
            }
        };

        function showCropInfo(crop) {
            const info = cropData[crop];
            document.getElementById('cropName').innerText = info.name;
            document.getElementById('cropSeason').innerText = info.season;
            document.getElementById('plantingTime').innerText = info.planting;
            document.getElementById('waterReq').innerText = info.water;
            document.getElementById('temperature').innerText = info.temp;
            document.getElementById('soilType').innerText = info.soil;
            document.getElementById('fertilizer').innerText = info.fertilizer;
            document.getElementById('diseases').innerText = info.diseases;
            document.getElementById('cropInfo').classList.remove('hidden');
        }
    </script>
</body>
</html>