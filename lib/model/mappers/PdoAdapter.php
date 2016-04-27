<?php

class PdoAdapter implements IDatabaseAdapter {
    
    /**
     * Pdo object reference.
     */
    private $pdo;
    
    /**
     * Config object reference.
     */
    private $config;
    
    /**
     * Set the object parameters.
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
        $this->connect();
    }
    
    /**
     * Connect to the database using settings stored in the configuration object.
     */
    public function connect() {
        if ($this->pdo) {
            return;
        }
        $dbHost = $this->config->getSetting('dbHost');
        $dbName = $this->config->getSetting('dbName');
        $dbUser = $this->config->getSetting('dbUser');
        $dbPass = $this->config->getSetting('dbPassword');
        
        try {
            $dsn = 'mysql:host=' . $dbHost . ';dbname=' . $dbName;
            $this->pdo = new PDO($dsn, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            print("Cannot connect to the server\n");
            print("Error code: " . $e->getCode() . "\n");
            print("Error message: " . $e->getMessage() . "\n");
        }
    }
    
    /**
     * Disconnect database connection.
     */
    public function disconnect() {
        $this->pdo = null;
    }
    
    /**
     * Get database connection.
     * @return PDO 
     * @throws PDOException
     */
    public function getDb() {
        if ($this->pdo === null) {
            throw new PDOException('There is no PDO object for use');
        }
        return $this->pdo;
    }
}
