<?php

class LibraryItem {
    protected string $title;
    protected string $itemNumber;
    protected bool $isAvailable = true;

    public function __construct($title, $itemNumber) {
        $this->title = $title;
        $this->itemNumber = $itemNumber;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getItemNumber(): string
    {
        return $this->itemNumber;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function checkOut(): bool
    {
        if ($this->isAvailable) {
            $this->isAvailable = false;
            return true;
        }
        return false;
    }

    public function returnItem(): void
    {
        $this->isAvailable = true;
    }
}

class Book extends LibraryItem {
    private string $author;

    public function __construct($title, $itemNumber, $author) {
        parent::__construct($title, $itemNumber);
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}

class DVD extends LibraryItem {
    private string $director;

    public function __construct($title, $itemNumber, $director) {
        parent::__construct($title, $itemNumber);
        $this->director = $director;
    }

    public function getDirector(): string
    {
        return $this->director;
    }
}

class Student {
    private $studentId;
    private $name;
    private $borrowedItems = [];

    public function __construct($studentId, $name) {
        $this->studentId = $studentId;
        $this->name = $name;
    }

    public function getStudentInfo() {
        return "Student ID: {$this->studentId}, Name: {$this->name}";
    }

    public function checkOutItem(LibraryItem $item): bool
    {
        if ($item->checkOut()) {
            $this->borrowedItems[] = $item;
            return true;
        }
        return false;
    }

    public function returnItem(LibraryItem $item): void
    {
        $item->returnItem();
        $key = array_search($item, $this->borrowedItems);
        if ($key !== false) {
            unset($this->borrowedItems[$key]);
        }
    }

    public function getBorrowedItems(): array
    {
        return $this->borrowedItems;
    }
}

// Library Management
class LibraryManager {
    private $libraryItems = [];

    public function addItem(LibraryItem $item): void
    {
        $this->libraryItems[] = $item;
    }

    public function getAvailableItems(): array
    {
        $availableItems = [];
        foreach ($this->libraryItems as $item) {
            if ($item->isAvailable()) {
                $availableItems[] = $item;
            }
        }
        return $availableItems;
    }
}


$book1 = new Book("The Great Gatsby", "B123", "F. Scott Fitzgerald");
$dvd1 = new DVD("Inception", "D456", "Christopher Nolan");
$student1 = new Student("S12345", "Alice");

$libraryManager = new LibraryManager();
$libraryManager->addItem($book1);
$libraryManager->addItem($dvd1);

echo "Available Items:\n";
$availableItems = $libraryManager->getAvailableItems();
foreach ($availableItems as $item) {
    echo "{$item->getTitle()} ({$item->getItemNumber()})\n";
}

echo "\n{$student1->getStudentInfo()} checks out:\n";
$student1->checkOutItem($book1);
$student1->checkOutItem($dvd1);

echo "Available Items after check-out:\n";
$availableItems = $libraryManager->getAvailableItems();
foreach ($availableItems as $item) {
    echo "{$item->getTitle()} ({$item->getItemNumber()})\n";
}

echo "\n{$student1->getStudentInfo()} has borrowed:\n";
$borrowedItems = $student1->getBorrowedItems();
foreach ($borrowedItems as $item) {
    echo "{$item->getTitle()} ({$item->getItemNumber()})\n";
}

// Student returns items
$student1->returnItem($book1);

echo "\n{$student1->getStudentInfo()} has borrowed after returning:\n";
$borrowedItems = $student1->getBorrowedItems();
foreach ($borrowedItems as $item) {
    echo "{$item->getTitle()} ({$item->getItemNumber()})\n";
}

