<?php
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($page) {
    header("Location: $page");
    exit;
}
?>