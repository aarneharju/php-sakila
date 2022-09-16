<?php
include 'databaseCredentials.php';


$charset = 'utf8mb4';
$dataSourceName = "mysql: host=$server, dbname=$database, charset=$charset";
$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false
];

try {
    $databaseConnection = new PDO($dataSourceName, $username, $password, $options);
    echo "Database connection functional.";
} catch (\PDOException $exception) {
    throw new \PDOException($exception->getMessage(), (int)$exception->getCode());
}
