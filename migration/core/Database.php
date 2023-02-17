<?php
/*
 * this class is only for the Migrationsystem
 * todo: implement extra dbuser only for migrations
 * todo: implement migrationfunctionalitiy in extra container
 */
namespace core;
class Database
{
    public string $migrationDir;
    public \PDO $pdo;

    public function __construct(array $config, $mig = '../migrations/')    {
        $this->migrationDir = $mig;
        $dsn = $config['dsn'] ?? 'fuck';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function applyMigration()    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigration = array();
        $files = scandir($this->migrationDir);
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration)  {
            if ($migration === '.' || $migration === '..')  {
                continue;
            }
            require_once $this->migrationDir.$migration;
            var_dump(pathinfo($migration, PATHINFO_FILENAME));
            $className = pathinfo($migration,PATHINFO_FILENAME);
            $instance = new $className($this);
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }
    public function testConnection() : array {
        $statement = $this->pdo->prepare("SHOW TABLES");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function createMigrationTable() : bool{
        if ($this->pdo->exec('CREATE TABLE IF NOT EXISTS migrations (
    id INT,
    migration VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB'))  return true;
        return false;
    }
    public function getAppliedMigrations() : array  {
        $statement = $this->pdo->prepare("SELECT * FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
    private function saveMigrations(array $migrations) : void  {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO (migrations) VALUES $str");
        $statement->execute();
    }
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }
}