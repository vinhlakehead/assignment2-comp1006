<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if(isLoggedIn()) {
    redirect('/dashboard.php');
}

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if(empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill all fields';
    } elseif($password !== $confirm) {
        $error = 'Passwords do not match';
    } elseif(strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Check if user exists
        $stmt = $db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if($stmt->fetch()) {
            $error = 'Username or email already exists';
        } else {
            // Create user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)")
               ->execute([$username, $email, $hash]);
            
            redirect('/index.php');
        }
    }
}

require_once 'includes/header.php';
?>

<h1>Register</h1>

<?php if($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>
    </div>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="/index.php">Login here</a></p>

<?php require_once 'includes/footer.php'; ?>