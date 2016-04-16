<?php

/**
 * Handling database connection
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbConnection {

    private $conn;
    private $configFile;

    function __construct($configFile) {
        $this->configFile = $configFile;
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        include_once $this->configFile;

        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // returing connection resource
        return $this->conn;
    }

}

?>
