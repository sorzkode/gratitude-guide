<?php

// Define database connection constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'youre_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'user_password');

// Create a connection function
function getDbConnection()
{
    try {
        // Create a new PDO instance
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);

        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set default fetch mode to associative array
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Disable emulation of prepared statements
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    } catch (PDOException $e) {
        // Log the error securely (don't expose details to users)
        error_log("Database Connection Error: " . $e->getMessage());

        // Return false on connection failure
        return false;
    }
}

// Function to test the database connection
function testDbConnection()
{
    try {
        $pdo = getDbConnection();
        if ($pdo) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        return false;
    }
}

// Function to sanitize input (additional layer of security)
function sanitizeInput($input)
{
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// Optional: Test the connection when this file is accessed directly
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    if (testDbConnection()) {
        die("Database connection successful!");
    } else {
        die("Database connection failed!");
    }
}
