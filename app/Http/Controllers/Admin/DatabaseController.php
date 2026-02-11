<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
    public function download(): Response
    {
        $connection = config('database.default');
        $config = config("database.connections.{$connection}");
        $databaseName = $config['database'] ?? 'database';
        $filename = 'backup_' . $databaseName . '_' . date('Y-m-d_His') . '.sql';
        
        // Generate SQL manually (works for both MySQL and PostgreSQL)
        return $this->generateManualBackup($filename, $connection);
    }
    
    private function generateManualBackup(string $filename, string $connection): Response
    {
        $config = config("database.connections.{$connection}");
        $databaseName = $config['database'] ?? 'database';
        $driver = $config['driver'] ?? 'mysql';
        
        $sql = "-- Database Backup: {$databaseName}\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Database Driver: {$driver}\n\n";
        
        // Get list of tables based on database driver
        if ($driver === 'pgsql') {
            // PostgreSQL
            try {
                $tables = DB::select("SELECT tablename FROM pg_tables WHERE schemaname = 'public' ORDER BY tablename");
                $tableNames = array_map(function ($table) {
                    return $table->tablename;
                }, $tables);
            } catch (\Exception $e) {
                // Fallback: Get tables from information_schema
                $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");
                $tableNames = array_map(function ($table) {
                    return $table->table_name;
                }, $tables);
            }
            
            $sql .= "BEGIN;\n\n";
        } else {
            // MySQL
            try {
                $tables = DB::select('SHOW TABLES');
                $tableKey = "Tables_in_{$databaseName}";
                $tableNames = array_map(function ($table) use ($tableKey) {
                    return $table->$tableKey;
                }, $tables);
            } catch (\Exception $e) {
                // Fallback: Get from information_schema
                $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = ?", [$databaseName]);
                $tableNames = array_map(function ($table) {
                    return $table->table_name;
                }, $tables);
            }
            
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
        }
        
        foreach ($tableNames as $tableName) {
            $sql .= "-- Table: {$tableName}\n";
            
            // Get table data
            try {
                $rows = DB::table($tableName)->get();
                
                if ($rows->count() > 0) {
                    // Get columns from first row
                    $columns = array_keys((array) $rows->first());
                    
                    if ($driver === 'pgsql') {
                        $sql .= "INSERT INTO \"{$tableName}\" (\"" . implode('", "', $columns) . "\") VALUES\n";
                    } else {
                        $sql .= "LOCK TABLES `{$tableName}` WRITE;\n";
                        $sql .= "INSERT INTO `{$tableName}` (`" . implode('`, `', $columns) . "`) VALUES\n";
                    }
                    
                    $values = [];
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        $rowValues = [];
                        foreach ($columns as $col) {
                            $value = $rowArray[$col] ?? null;
                            if ($value === null) {
                                $rowValues[] = 'NULL';
                            } elseif (is_bool($value)) {
                                $rowValues[] = $driver === 'pgsql' ? ($value ? 'true' : 'false') : ($value ? '1' : '0');
                            } elseif (is_numeric($value) && !is_string($value)) {
                                $rowValues[] = $value;
                            } else {
                                // Escape single quotes and backslashes
                                $escaped = str_replace(['\\', "'"], ['\\\\', "''"], (string) $value);
                                $rowValues[] = "'{$escaped}'";
                            }
                        }
                        
                        $values[] = '(' . implode(',', $rowValues) . ')';
                    }
                    
                    $sql .= implode(",\n", $values) . ";\n";
                    
                    if ($driver !== 'pgsql') {
                        $sql .= "UNLOCK TABLES;\n";
                    }
                    $sql .= "\n";
                } else {
                    $sql .= "-- No data in table {$tableName}\n\n";
                }
            } catch (\Exception $e) {
                $sql .= "-- Error reading table {$tableName}: " . $e->getMessage() . "\n\n";
            }
        }
        
        if ($driver === 'pgsql') {
            $sql .= "COMMIT;\n";
        } else {
            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";
        }
        
        return response($sql, 200, [
            'Content-Type' => 'application/sql',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
