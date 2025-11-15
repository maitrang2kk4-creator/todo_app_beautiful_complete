<?php
session_start();
require __DIR__ . '/../config/db.php';
if (!isset($_SESSION['user_id'])) { header('Location: ../auth/login.php'); exit; }
$user_id = $_SESSION['user_id'];
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: ../index.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ? AND user_id = ? LIMIT 1');
$stmt->execute([$id, $user_id]);
$task = $stmt->fetch();
if (!$task) { $_SESSION['msg'] = 'Công việc không tồn tại.'; header('Location: ../index.php'); exit; }
if (isset($_GET['action']) && $_GET['action'] === 'complete') {
    $u = $pdo->prepare('UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?');
    $u->execute(['completed', $id, $user_id]);
    $_SESSION['msg'] = 'Đã đánh dấu hoàn thành.';
    header('Location: ../index.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $due_date = $_POST['due_date'] ?: null;
    $status = in_array($_POST['status'] ?? '', ['pending','in_progress','completed']) ? $_POST['status'] : 'pending';
    if ($title === '') { $error = 'Tiêu đề không được để trống.'; }
    else {
        $u = $pdo->prepare('UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ? AND user_id = ?');
        $u->execute([$title, $description ?: null, $due_date, $status, $id, $user_id]);
        $_SESSION['msg'] = 'Cập nhật công việc thành công.';
        header('Location: ../index.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sửa công việc</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h3>Sửa công việc</h3>
    <?php if($error): ?><div style="color:#8b0000;"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
      <div class="input"><label>Tiêu đề</label><input name="title" value="<?= htmlspecialchars($task['title']) ?>" required></div>
      <div class="input"><label>Mô tả</label><textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea></div>
      <div class="input"><label>Ngày hạn</label><input name="due_date" type="date" value="<?= htmlspecialchars($task['due_date']) ?>"></div>
      <div class="input"><label>Trạng thái</label>
        <select name="status">
          <option value="pending" <?= $task['status']=='pending' ? 'selected':'' ?>>Pending</option>
          <option value="in_progress" <?= $task['status']=='in_progress' ? 'selected':'' ?>>In Progress</option>
          <option value="completed" <?= $task['status']=='completed' ? 'selected':'' ?>>Completed</option>
        </select>
      </div>
      <div style="display:flex; gap:8px; margin-top:8px;">
        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
        <a class="btn btn-ghost" href="../index.php">Hủy</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
