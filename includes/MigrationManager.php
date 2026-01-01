<?php

class MigrationManager {
    private $pdo;
    private $migrationsDir;

    public function __construct($pdo, $migrationsDir) {
        $this->pdo = $pdo;
        $this->migrationsDir = $migrationsDir;
    }

    public function ensureMigrationTableExists() {
        $sql = "CREATE TABLE IF NOT EXISTS sys_migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function getExecutedMigrations() {
        $stmt = $this->pdo->query("SELECT migration FROM sys_migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getMigrationFiles() {
        $files = scandir($this->migrationsDir);
        $migrations = [];
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $migrations[] = $file;
            }
        }
        sort($migrations); // Ensure order by filename
        return $migrations;
    }

    public function migrate() {
        $this->ensureMigrationTableExists();
        
        $executed = $this->getExecutedMigrations();
        $files = $this->getMigrationFiles();
        
        $newMigrations = array_diff($files, $executed);
        
        if (empty($newMigrations)) {
            echo "✅ Database is up to date.\n";
            return;
        }

        echo "🚀 Found " . count($newMigrations) . " new migrations.\n";

        foreach ($newMigrations as $file) {
            echo "Applying: $file... ";
            
            try {
                $sql = file_get_contents($this->migrationsDir . '/' . $file);
                
                // We execute the raw SQL. 
                // Note: PDO::exec handles multiple statements if strictly configured or if the driver allows.
                // For robustness with complex scripts (DELIMITER, prepared stmts), parsing might be needed,
                // but for this project's standard SQL, raw exec usually works fine.
                // If specific errors occur with multiple statements, we can split by semicolon.
                
                $this->pdo->exec($sql);
                
                // Log execution
                $stmt = $this->pdo->prepare("INSERT INTO sys_migrations (migration) VALUES (?)");
                $stmt->execute([$file]);
                
                echo "DONE.\n";
            } catch (PDOException $e) {
                echo "FAILED!\n";
                echo "❌ Error: " . $e->getMessage() . "\n";
                exit(1); 
            }
        }
        
        echo "🎉 All migrations executed successfully.\n";
    }
}
?>
