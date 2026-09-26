<?php
/**
 * ZeroStudios Book - CLI Database Sync / Seeder Tool
 * 
 * Usage:
 *   php db_sync.php
 */

if (php_sapi_name() !== 'cli') {
    die("This script can only be run from the command line (CLI).\n");
}

echo "====================================================\n";
echo "   ZeroStudios Book - Database Setup & Sync Tool\n";
echo "====================================================\n\n";

// 1. Read CodeIgniter Database Config
defined('ENVIRONMENT') or define('ENVIRONMENT', 'development');
defined('BASEPATH') or define('BASEPATH', __DIR__ . '/system/');
require_once __DIR__ . '/application/config/database.php';

if (!isset($db['default'])) {
    die("[!] Error: Could not load database configuration from application/config/database.php\n");
}

$config = $db['default'];
$host = $config['hostname'] ?: 'localhost';
$user = $config['username'] ?: 'root';
$pass = $config['password'] ?? '';
$database = $config['database'] ?: 'zerostudios';

echo "[*] Connecting to MySQL at '{$host}' as '{$user}'...\n";

try {
    $pdo = new PDO("mysql:host={$host};charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "[✓] Connected to MySQL successfully.\n";

    // 2. Create or Reset Database
    echo "[*] Preparing database '{$database}'...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    $pdo->exec("USE `{$database}`;");
    echo "[✓] Database '{$database}' is ready.\n";

    // 3. Read and Execute zerostudio.sql
    $sqlFile = __DIR__ . '/zerostudio.sql';
    if (!file_exists($sqlFile)) {
        die("[!] Error: SQL file not found at {$sqlFile}\n");
    }

    echo "[*] Importing schema and clean seed data from zerostudio.sql...\n";
    $sql = file_get_contents($sqlFile);
    
    // Drop existing tables first to prevent duplicate table errors
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $pdo->exec("DROP TABLE IF EXISTS `{$table}`");
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    // Execute import
    $pdo->exec($sql);
    echo "[✓] All tables and data imported successfully!\n\n";

    // 4. Print Summary
    echo "====================================================\n";
    echo " [✓] SETUP COMPLETE!\n";
    echo "====================================================\n";
    echo " Admin Login Details:\n";
    echo " - URL      : http://localhost/zerostudios.book/login/dashboard\n";
    echo " - Username : admin\n";
    echo " - Password : 123\n";
    echo "====================================================\n\n";

} catch (Exception $e) {
    echo "\n[!] Database Error: " . $e->getMessage() . "\n";
    exit(1);
}
