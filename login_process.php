<?php
session_start();

// Dummy user data (replace with database queries)
$users = [
    'user@example.com' => ['password' => 'password123', 'role' => 'user'],
    'admin@example.com' => ['password' => 'admin123', 'role' => 'administrator']
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists and password is correct
    if (array_key_exists($email, $users) && $users[$email]['password'] == $password) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $users[$email]['role'];

        header("Location: student_details.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
<?php
// Start or resume session
session_start();

// Generate CSRF token if it doesn't exist
if (!isset($_SESSION['_csrf'])) {
    $_SESSION['_csrf'] = bin2hex(random_bytes(32)); // Generate a random CSRF token
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!empty($_POST['_csrf']) && hash_equals($_SESSION['_csrf'], $_POST['_csrf'])) {
        // CSRF token is valid, process form data securely
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Example: Authenticate user and handle login
        // Implement your application logic here...

        echo "Form submitted successfully!";
    } else {
        // CSRF token is invalid
        http_response_code(403);
        die("CSRF token validation failed!");
    }
}
?>

</html>
