<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include any necessary files, such as database connection
include_once "includes/db_connection.php";

// Retrieve user information from session or database
$user_id = $_SESSION['user_id'];

// Query the database to get student details based on the user ID
$stmt = $conn->prepare("SELECT * FROM students WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch student details
if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    // Handle case where student details are not found
    $student = array(); // Empty array
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <!-- Include any necessary CSS files -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Welcome to Student Details Page</h1>
    <?php if (!empty($student)): ?>
        <h2>Hello <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
        <p>Matric No: <?php echo htmlspecialchars($student['matric no']); ?></p>
        <?php else: ?>
        <p>No student details found.</p>
    <?php endif; ?>

   
</body>
</html>