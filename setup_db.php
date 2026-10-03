<?php
$env = static function ($key) {
    $value = $_ENV[$key] ?? getenv($key);
    if ($value === false || $value === null || $value === '') {
        throw new RuntimeException("Missing required environment variable: {$key}");
    }
    return $value;
};

$host = $env('DB_HOST');
$port = $env('DB_PORT');
$user = $env('DB_USERNAME');
$pass = $env('DB_PASSWORD');
$db = $env('DB_DATABASE');

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$caFile = $_ENV['DB_SSL_CA'] ?? getenv('DB_SSL_CA');
if ($caFile !== false && $caFile !== null && $caFile !== '') {
    if (!is_file($caFile) || !is_readable($caFile)) {
        throw new RuntimeException('Configured MySQL CA certificate is missing or unreadable.');
    }
    $options[PDO::MYSQL_ATTR_SSL_CA] = $caFile;
    if (defined('PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT')) {
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
    }
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully\n";
    
    $queries = [
        "CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            product_name VARCHAR(100),
            description TEXT,
            price DECIMAL(10,2),
            quantity INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        )",
        "INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')"
    ];
    
    foreach ($queries as $query) {
        $pdo->exec($query);
        echo "Executed query successfully.\n";
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
