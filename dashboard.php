<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if(!isLoggedIn()) {
    redirect('/index.php');
}

require_once 'includes/header.php';
?>

<h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
<p>You're logged in to your account.</p>

<a href="/logout.php">Logout</a>

<?php require_once 'includes/footer.php'; ?>