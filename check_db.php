<?php
$pdo = new PDO('mysql:host=mysql-3cd37ed5-phoebeabante18.j.aivencloud.com;port=16717;dbname=defaultdb', 'avnadmin', getenv('DB_PASSWORD') ?: '', [PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false]);
$stmt = $pdo->query('SHOW TABLES');
print_r($stmt->fetchAll(PDO::FETCH_COLUMN));
