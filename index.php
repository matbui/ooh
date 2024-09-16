<?php
require_once 'src/controllers/SignupController.php';

$action = $_GET['action'] ?? '';

if ($action === 'signup') {
    SignupController::handleSignup();
} else {
    include 'public/index.html';
}

if (isset($_GET['action']) && $_GET['action'] == 'showUsers') {
    SignupController::showUsers();
}
?>
