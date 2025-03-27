<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Auth</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <?php if(isLoggedIn()): ?>
            <a href="/dashboard.php">Dashboard</a>
            <a href="/logout.php">Logout</a>
        <?php else: ?>
            <a href="/register.php">Register</a>
            <a href="/index.php">Login</a>
        <?php endif; ?>
    </nav>
    <div class="container"></div>