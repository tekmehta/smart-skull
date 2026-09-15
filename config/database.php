<?php
/**
 * Database Configuration File
 *
 * Use this file to set up your PDO or MySQLi database connection.
 * Currently uses placeholder values for your local XAMPP environment.
 */

$host = 'localhost';
$dbname = 'school_management_system'; // Change to your actual database name
$username = 'root';
$password = ''; // Default XAMPP has no password for root

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    // Uncomment the line below when your database is ready
    // $pdo = new PDO($dsn, $username, $password, $options);
    
} catch (PDOException $e) {
    // throw new PDOException($e->getMessage(), (int)$e->getCode());
    // For now, suppress errors since DB is not set up
}
?>
