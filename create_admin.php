<?php
$pdo = new PDO('mysql:host=mysql-3cd37ed5-phoebeabante18.j.aivencloud.com;port=16717;dbname=defaultdb', 'avnadmin', getenv('DB_PASSWORD') ?: '', [PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false]);
$username = 'admin';
$password = password_hash('password123', PASSWORD_BCRYPT);
$email = 'admin@example.com';
$role = 'admin';
$stmt = $pdo->prepare('INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)');
$stmt->execute([$username, $password, $email, $role]);
echo "Created admin\n";
