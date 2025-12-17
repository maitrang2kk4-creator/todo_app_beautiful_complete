<?php
// Bài 9: Lớp sinh viên
class Student {
    public $name;
    public $id;

    function __construct($name, $id){
        $this->name = $name;
        $this->id = $id;
    }

    function display(){
        echo "Tên sinh viên: $this->name <br>";
        echo "Mã sinh viên: $this->id <br>";
    }
}

$sv = new Student("Trang Mai", "SV001");
$sv->display();
?>