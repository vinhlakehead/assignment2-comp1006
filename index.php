<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if(isLoggedIn()) {
    redirect('/dashboard.php');
}

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $error = 'Please fill all fields';
    } else {
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            redirect('/dashboard.php');
        } else {
            $error = 'Invalid credentials';
        }
    }
}

require_once 'includes/header.php';
?>

<h1>Login</h1>

<?php if($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label>Username:</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="/register.php">Register here</a></p>

<?php require_once 'includes/footer.php'; ?>