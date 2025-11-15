<?php
session_start();
require 'config/db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$status_filter = $_GET['status'] ?? '';
$search = trim($_GET['q'] ?? '');
$order = ($_GET['order'] ?? 'due_date') === 'created_at' ? 'created_at' : 'due_date';
$order_dir = ($_GET['dir'] ?? 'asc') === 'desc' ? 'DESC' : 'ASC';

$query = "SELECT * FROM tasks WHERE user_id = :uid";
$params = ['uid' => $user_id];

if ($status_filter && in_array($status_filter, ['pending','in_progress','completed'])) {
    $query .= " AND status = :status";
    $params['status'] = $status_filter;
}
if ($search !== '') {
    $query .= " AND title LIKE :search";
    $params['search'] = '%' . $search . '%';
}

$query .= " ORDER BY $order $order_dir";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - ToDo App</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
  <div class="header">
    <div class="brand">
      <div class="logo"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7h16v10H4z" fill="#fff" opacity="0.3"/></svg></div>
      <div class="app-title">ToDo App</div>
    </div>
    <div class="nav">
      <div style="font-weight:600; color:#07406a;">Hello, <?= htmlspecialchars($_SESSION['username']) ?></div>
      <a class="btn btn-ghost" href="tasks/add_task.php">+ Thêm</a>
      <a class="btn btn-ghost" href="auth/logout.php">Đăng xuất</a>
    </div>
  </div>

  <div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:8px;">
      <div>
        <form method="get" class="search-row">
          <input name="q" placeholder="Tìm kiếm tiêu đề" value="<?= htmlspecialchars($search) ?>">
          <select name="status">
            <option value="">Tất cả</option>
            <option value="pending" <?= $status_filter==='pending' ? 'selected':'' ?>>Pending</option>
            <option value="in_progress" <?= $status_filter==='in_progress' ? 'selected':'' ?>>In Progress</option>
            <option value="completed" <?= $status_filter==='completed' ? 'selected':'' ?>>Completed</option>
          </select>
          <select name="order">
            <option value="due_date" <?= $order==='due_date' ? 'selected':'' ?>>Hạn</option>
            <option value="created_at" <?= $order==='created_at' ? 'selected':'' ?>>Ngày tạo</option>
          </select>
          <select name="dir">
            <option value="asc" <?= $order_dir==='ASC' ? 'selected':'' ?>>Tăng dần</option>
            <option value="desc" <?= $order_dir==='DESC' ? 'selected':'' ?>>Giảm dần</option>
          </select>
          <button class="btn btn-primary">Lọc</button>
        </form>
      </div>
    </div>
    <div class="dashboard-layout">

    <!-- 🌈 Illustration bên trái -->
    <div class="dashboard-illustration">
        <img src="assets/cute_illustration.svg">
    </div>

    <!-- 📘 Nội dung bảng -->
    <div class="dashboard-content">

        <div class="card-strong">

            <h3 style="margin-bottom: 14px; color:#7a3e55;">
                🌸 Danh sách công việc của bạn
            </h3>

    <?php if (count($tasks) === 0): ?>
      <div class="empty">Chưa có công việc nào. Hãy thêm công việc mới!</div>
    <?php else: ?>
      <table class="table">
        <thead>
          <tr><th>Tiêu đề</th><th>Mô tả</th><th>Hạn</th><th>Trạng thái</th><th>Hành động</th></tr>
        </thead>
        <tbody>
        <?php foreach($tasks as $task): ?>
          <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= nl2br(htmlspecialchars($task['description'])) ?></td>
            <td><?= htmlspecialchars($task['due_date']) ?></td>
            <td>
              <span class="badge <?= htmlspecialchars($task['status']) ?>"><?= htmlspecialchars($task['status']) ?></span>
            </td>
            <td class="actions">
              <a class="btn btn-ghost" href="tasks/edit_task.php?id=<?= $task['id'] ?>">Sửa</a>
              <a class="btn btn-ghost" href="tasks/delete_task.php?id=<?= $task['id'] ?>" onclick="return confirm('Xóa công việc này?')">Xóa</a>
              <?php if($task['status'] !== 'completed'): ?>
                <a class="btn btn-primary" href="tasks/edit_task.php?id=<?= $task['id'] ?>&action=complete">Hoàn thành</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</div>
</body>
</html>
