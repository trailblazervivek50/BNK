<?php
include 'config.php';
$error = "";
$success = "";

if (isset($_POST['register'])) {

    // Clean input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } 
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } 
    else {

        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already registered!";
        } 
        else {

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user using prepared statement
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! Please login.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - AgriConnect</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar">
    <a href="index.php" class="logo">AgriConnect</a>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </div>
</nav>

<div class="form-box">

<h2 style="text-align:center; margin-bottom:20px;">Register as Farmer</h2>

<?php if($error): ?>
<p style="color:red; text-align:center; margin-bottom:15px;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if($success): ?>
<p style="color:green; text-align:center; margin-bottom:15px;"><?php echo $success; ?></p>
<?php endif; ?>

<form method="POST">

<div class="form-group">
<label>Full Name</label>
<input type="text" name="name" placeholder="Enter your name" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" placeholder="Enter your email" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" placeholder="Enter password" required>
</div>

<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="confirm_password" placeholder="Confirm password" required>
</div>

<button type="submit" name="register" class="btn-submit">Register</button>

</form>

<p style="margin-top:15px; text-align:center;">
Already have an account? <a href="login.php">Login</a>
</p>

</div>

</body>
</html>