<?php
class Person {
    protected $name;
    protected $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getInfo() {
        return "Name: {$this->name}, Age: {$this->age}";
    }
}

class Employee extends Person {
    private $employeeId;
    private $position;
    private $studentId;

    public function __construct($name, $age, $employeeId, $position, $studentId) {
        parent::__construct($name, $age);
        $this->employeeId = $employeeId;
        $this->position = $position;
        $this->studentId = $studentId;
    }

    public function getEmployeeInfo() {
        return "Employee ID: {$this->employeeId}, Position: {$this->position}, Student ID: {$this->studentId}";
    }
}


$employee = new Employee("John Doe", 25, "E12345", "Manager", "S6789");
echo $employee->getInfo() . "\n"; // Output person's details
echo $employee->getEmployeeInfo() . "\n"; // Output employee's details
