<?php
class Validator {
    public static function validateEmail($email): bool
    {
        // Implement email validation logic
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword($password): bool
    {
        // Implement password validation logic (e.g., minimum length, complexity)
        return strlen($password) >= 8;
    }
}

// Usage:
$email = "user@example.com";
if (Validator::validateEmail($email)) {
    echo "Valid email address.\n";
} else {
    echo "Invalid email address.\n";
}

$password = "password123";
if (Validator::validatePassword($password)) {
    echo "Valid password.\n";
} else {
    echo "Invalid password.\n";
}

