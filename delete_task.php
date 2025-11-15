<?php
session_start();
require __DIR__ . '/../config/db.php';
if (!isset($_SESSION['user_id'])) { header('Location: ../auth/login.php'); exit; }
$user_id = $_SESSION['user_id'];
$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
    $stmt->execute([$id, $user_id]);
    $_SESSION['msg'] = 'Đã xóa công việc.';
}
header('Location: ../index.php');
exit;
?>
