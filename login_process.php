<?php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password']; // No need to sanitize, as it will be hashed

// Verify email and password against database
// Assuming $conn is your MySQL database connection
$stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Start session and store user ID
        session_start();
        $_SESSION['user_id'] = $row['id'];
        // Redirect to student details page or any other protected page
        header("Location: student_details.php");
        exit();
    } else {
        // Incorrect password
        $error = "Incorrect email or password.";
    }
} else {
    // Email not found
    $error = "Incorrect email or password.";
}

// Display error message if authentication fails
echo htmlspecialchars($error);
?>