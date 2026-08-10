<?php 
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "agri_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$success = "";
$error = "";
$resultMessage = "Waiting for scan...";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['detect'])) {
    $image = $_FILES['imageUpload']['name'];
    $symptom = $_POST['symptom'];
    $date = date('Y-m-d H:i:s');
    
    // Create uploads folder if not exists
    if (!file_exists("uploads")) {
        mkdir("uploads", 0777, true);
    }
    
    // Save image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    
    if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $target_file)) {
        // Simulate AI Detection Logic
        $disease = "";
        $treatment = "";
        
        if ($symptom == "yellow") {
            $disease = "Yellow Rust";
            $treatment = "Use fungicide spray (Tebuconazole)";
        } elseif ($symptom == "white") {
            $disease = "Powdery Mildew";
            $treatment = "Apply sulfur-based treatment";
        } elseif ($symptom == "holes") {
            $disease = "Insect Attack";
            $treatment = "Use insecticide spray (Neem Oil)";
        } elseif ($symptom == "brown") {
            $disease = "Leaf Blight";
            $treatment = "Remove affected leaves immediately";
        } else {
            $disease = "Unknown";
            $treatment = "Consult an agricultural expert";
        }
        
        // Save to database
        $sql = "INSERT INTO disease_reports (image, symptom, detection_date, disease, treatment) 
                VALUES ('$image', '$symptom', '$date', '$disease', '$treatment')";
        
        if (mysqli_query($conn, $sql)) {
            $success = "✅ Image uploaded and saved successfully!";
            $resultMessage = "<strong>Disease Detected:</strong> $disease<br><br><strong>Treatment:</strong> $treatment";
        } else {
            $error = "❌ Database error: " . mysqli_error($conn);
        }
    } else {
        $error = "❌ Failed to upload image!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>

<title>AI Disease Detection</title>

<!-- <link rel="stylesheet" href="d.css"> -->

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

        .ai-disease {
            background: white; padding: 40px; border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .ai-disease h1 { color: var(--dark); font-size: 2rem; margin-bottom: 10px; }
        .ai-disease p { color: #666; margin-bottom: 30px; }

        .scanner {
            display: flex; flex-direction: column; gap: 20px; max-width: 600px; margin: 0 auto;
        }
        .scanner input[type="file"] {
            padding: 15px; border: 2px dashed var(--primary); border-radius: 10px; cursor: pointer;
        }
        .image-preview {
            width: 100%; height: 300px; border: 2px solid #ddd; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
        }
        .image-preview img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .scanner select {
            padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;
        }
        .scanner button {
            padding: 15px; background: var(--primary); color: white; border: none; border-radius: 5px;
            font-size: 1.1rem; font-weight: bold; cursor: pointer; transition: 0.3s;
        }
        .scanner button:hover { background: var(--dark); transform: translateY(-2px); }

        .result-card {
            background: #f9f9f9; padding: 30px; border-radius: 10px; margin-top: 30px;
            border-left: 5px solid var(--primary);
        }
        .result-card h2 { color: var(--dark); margin-bottom: 15px; }
        .result-card p { color: #555; font-size: 1.1rem; }
        .result-card .success { color: #27ae60; font-weight: bold; }
        .result-card .error { color: #e74c3c; font-weight: bold; }

        footer { background: #222; color: white; text-align: center; padding: 20px; margin-top: 50px; }

        @media (max-width: 768px) {
            .scanner { max-width: 100%; }
            .image-preview { height: 200px; }
        }
    </style>

</head>

<body>

<header>

<div class="navbar">

<div class="logo">Agriculture portal</div>

<nav>

    <a href="index.php" class="active">Home</a>
    <a href="schemes.php">Govt Schemes</a>
    <a href="guidance.php">Crop Guidance</a>
    <a href="disease.php" class="active">Disease prediction</a>
    <a href="market.php">Market Price</a>
    <a href="about.php">About</a>
    <a href="contact.php">Contact</a>

</nav>

</div>

</header>

<div class="container">

<section class="ai-disease">

<h1>AI Crop Disease Detector</h1>

<p>Upload a crop leaf image to detect disease instantly.</p>


<div class="scanner">

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" id="imageUpload" name="imageUpload" accept="image/*" onchange="previewImage(event)" required>

    <div class="image-preview">
        <img id="preview" src="images/leaf.png">
    </div>

    <select id="symptom" name="symptom" required>
        <option value="">Select Symptom</option>
        <option value="yellow">Yellow Spots</option>
        <option value="white">White Powder</option>
        <option value="holes">Leaf Holes</option>
        <option value="brown">Brown Patches</option>
        <option value="wilt">Leaf Wilt</option>
        <option value="mold">Fungal Mold</option>
    </select>

    <button type="submit" name="detect">Scan Disease</button>
</form>

</div>


<div class="result-card">

<h2>Detection Result</h2>

<?php if($success): ?>
    <p class="success"><?php echo $success; ?></p>
<?php endif; ?>

<?php if($error): ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<p id="result"><?php echo $resultMessage; ?></p>

</div>

</section>

</div>

<footer>

<p>© 2026 Smart Agriculture Portal | Developed for Farmers</p>

</footer>

<!-- JAVASCRIPT CODE -->
<script>
    // Image Preview Function
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>