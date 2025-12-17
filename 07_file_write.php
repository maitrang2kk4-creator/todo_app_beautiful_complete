<?php
// Bài 7: Ghi nội dung vào file
$filename = "data.txt";
$content = "Xin chào! Đây là dữ liệu được ghi từ PHP.";

file_put_contents($filename, $content);

echo "<h2>Đã ghi nội dung vào file data.txt</h2>";
?>