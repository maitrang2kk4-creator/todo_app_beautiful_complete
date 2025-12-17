<head> 
	<link href = "css/my.css" rel= "stylesheet">
</head>
<body>
<?php
//Lập trình hướng đối tượng 
 class Car 
 {  //biến cục bộ
	private $name;
	private $price;
	// Phương thức
	public function __construct ($name, $price)
	{
		$this->name = $name;
		$this->price = $price;
	}
	public function getName () {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getPrice() {
		return $this->price;
	}
	public function setPrice ($price) {
		$this->price  = $price ;
	}
	public function displayCar() {
		echo "<h2 style = 'color : red'>";
		echo "Car name: " . $this->name. "<br>";
		echo "Price : " . $this->price. "$<br>";
		echo "</h2>";
	}
	public function drawTable($cars) {
		echo "<table>";
		echo "<tr>";
			echo "<th> Name </th>";
			echo "<th> Price </th>";
		echo"</tr>";
		foreach ($cars as $car)
			echo "<tr>";
				echo "<td>" . $this->name. "</td>";
				echo "<td>" . $this->price. "</td>";
			echo "</tr>";
		echo "</table>";
	}
	
 }
	/*$car = new Car() ; //khai bao doi tuong cars
	$car->setName("HONDA");
	$car->setPrice(20000);
	$car->displayCar();
	echo "<p>Display car in a table <br></p>";
	$car ->drawTable();
	
	//$car = new Car("toyota", 15000);
	*/
	$cars = [
	new Car ("Toyota", 20000),
	new Car ("volvo", 15000),
	new Car ("Misubishi", 30000)
	];
	//var_dump($cars);
	//duyet mang cac doi tuong 
	foreach ($cars as $car) {
		$car->displayCar();
		echo "<hr>";
	}
	
	
?>
</body>
</head>  ffgffg   huen 