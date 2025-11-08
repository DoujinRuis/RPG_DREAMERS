<?php
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'None');

session_start();
session_save_path("/home/users/2/pigboat.jp-doujin-ruis/web/session");
session_set_cookie_params(['path' => '/']);

require_once 'db.php';

$username = $_POST['loginUsername'] ?? '';
$password = $_POST['loginPassword'] ?? '';

$stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    echo 'success';
    exit;
} else {
    echo 'failure';
    exit;
}
?>