<?php
class Car {
    public $make;
    public $model;
    public $year;

    // Constructor to initialize the properties
    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Method to display car details
    public function displayCarDetails() {
        echo "Car Make: " . $this->make . "<br>";
        echo "Car Model: " . $this->model . "<br>";
        echo "Car Year: " . $this->year . "<br><br>";
    }

    // Method to check if the car is vintage (older than 20 years)
    public function isVintage() {
        $currentYear = date("Y");
        $age = $currentYear - $this->year;
        return $age > 20;
    }
}

// Creating Car objects
$car1 = new Car("Toyota", "Corolla", 2000);
$car2 = new Car("Tesla", "Model 3", 2021);

// Display details and vintage status for Car 1
echo "<h3>Car 1 Details:</h3>";
$car1->displayCarDetails();
echo "Is Car 1 Vintage? " . ($car1->isVintage() ? "Yes" : "No") . "<br><br>";

// Display details and vintage status for Car 2
echo "<h3>Car 2 Details:</h3>";
$car2->displayCarDetails();
echo "Is Car 2 Vintage? " . ($car2->isVintage() ? "Yes" : "No") . "<br>";
?>
