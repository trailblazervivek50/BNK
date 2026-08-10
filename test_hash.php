<?php
// Test Password Hashing
$password = "mySecurePass123";
$hashed = password_hash($password, PASSWORD_DEFAULT);

echo "<h3>Password Hashing Test</h3>";
echo "<p>Original Password: " . $password . "</p>";
echo "<p>Hashed Password: " . $hashed . "</p>";
echo "<p>Verification: " . (password_verify($password, $hashed) ? "✅ YES" : "❌ NO") . "</p>";
?>