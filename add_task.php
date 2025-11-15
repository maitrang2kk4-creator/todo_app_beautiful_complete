<?php
session_start();
require __DIR__ . '/../config/db.php';
if (!isset($_SESSION['user_id'])) { header('Location: ../auth/login.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $due_date = $_POST['due_date'] ?: null;
    $user_id = $_SESSION['user_id'];
    if ($title === '') { $error = 'Tiêu đề không được để trống.'; }
    else {
        $stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)');
        $stmt->execute([$user_id, $title, $description ?: null, $due_date]);
        $_SESSION['msg'] = 'Thêm công việc thành công.';
        header('Location: ../index.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thêm công việc</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h3>Thêm công việc mới</h3>
    <?php if($error): ?><div style="color:#8b0000;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
      <div class="input"><label>Tiêu đề</label><input name="title" required></div>
      <div class="input"><label>Mô tả</label><textarea name="description"></textarea></div>
      <div class="input"><label>Ngày hạn</label><input name="due_date" type="date"></div>
      <div style="display:flex; gap:8px; margin-top:8px;">
        <button class="btn btn-primary" type="submit">Lưu</button>
        <a class="btn btn-ghost" href="../index.php">Hủy</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
