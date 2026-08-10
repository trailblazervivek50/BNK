<?php
include 'db_connect.php';

if(isset($_POST['submit']))
{
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (full_name,email,phone,subject,message)
            VALUES ('$name','$email','$phone','$subject','$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>