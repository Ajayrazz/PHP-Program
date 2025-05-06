<?php
// Define the abstract class
abstract class Character {
    protected $name;
    protected $level;

    // Constructor to initialize properties
    public function __construct($name, $level) {
        $this->name = $name;
        $this->level = $level;
    }

    // Abstract method
    abstract public function attack();
}

// Warrior class
class Warrior extends Character {
    public function attack() {
        echo "{$this->name} performs a powerful physical attack at level {$this->level}!\n";
    }
}

// Mage class
class Mage extends Character {
    public function attack() {
        echo "{$this->name} casts a mighty magic spell at level {$this->level}!\n";
    }
}

// Create objects and test
$warrior = new Warrior("Thor", 10);
$mage = new Mage("Merlin", 12);

$warrior->attack(); // Output: Thor performs a powerful physical attack at level 10!
$mage->attack();    // Output: Merlin casts a mighty magic spell at level 12!
?>
