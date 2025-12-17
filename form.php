<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
</head>
<body>
    <h2>Thêm người dùng mới</h2>
    <form action="insert_user.php" method="POST">
        <label>Tên người dùng:</label><br>
        <input type="text" name="uname" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
