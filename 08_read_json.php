<?php
// Bài 8: Đọc JSON
$json = '{"name":"Trang","age":20,"school":"Hệ thống thông tin"}';
$data = json_decode($json, true);

echo "<h2>Thông tin JSON:</h2>";
echo "Tên: " . $data['name'] . "<br>";
echo "Tuổi: " . $data['age'] . "<br>";
echo "Ngành: " . $data['school'];
?>