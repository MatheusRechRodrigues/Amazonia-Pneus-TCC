<?php
function conect() {
    $host = 'localhost';
    $db   = 'amazoniapneus';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;amazoniapneus=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    
       
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        
        $pdo->exec('USE amazoniapneus');
        return $pdo;
         
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>