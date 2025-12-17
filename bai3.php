<?php
class Car {
    private $name;
    private $price;

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function displayCar(){
        echo "<h2 style='color:red'>";
        echo "Car name: " . $this->name . "<br>";
        echo "Price: " . $this->price . "<br>";
        echo "</h2>";
    }
}

// Khởi tạo đối tượng
$car = new Car();
$car->setName("Toyota");
$car->setPrice(50000);
$car->displayCar();
?>