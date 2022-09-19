<?php

class DatabaseConnection
{
    private $server;
    private $username;
    private $password;
    private $database;
    private $charset = 'utf8mb4';

    public function __construct()
    {
        include 'includes/databasecredentials.inc.php';
        // echo "server: $servername";
        $this->server = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    protected function connect()
    {
        $dataSourceName = "mysql: host=" . $this->server . ";dbname=" . $this->database . ";charset=" . $this->charset;
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false
        ];

        try {
            return new PDO($dataSourceName, $this->username, $this->password, $options);
            // echo '<p class="debug-info">Database connection functional.</p>';
        } catch (\PDOException $exception) {
            throw new \PDOException($exception->getMessage(), (int)$exception->getCode());
        }
    }
}
