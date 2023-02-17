<?php

use core\MigrationBase;
use core\Database;

class m0001 extends MigrationBase
{
    function __construct(Database $dbInstance)
    {
        $this->databaseInstance = $dbInstance;
    }

    function up()
    {
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,    
                lastname VARCHAR(255) NOT NULL,    
                status TINYINT DEFAULT 0,    
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            ) ENGINE=INNODB;";
        $this->databaseInstance->pdo->exec($SQL);
        // TODO: Implement up() method.
    }
    function down()
    {
        $SQL = "DROP TABLE users";
        $this->databaseInstance->pdo->exec($SQL);
        // TODO: Implement down() method.
    }
}