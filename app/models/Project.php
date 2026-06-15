<?php

class Project
{
    private $conn;

    public function all()
    {
        $this->conn = Database::connect();
        $this->ensureTable();

        $sql = "SELECT id, name, description, start_date, end_date, github, website, status, progress, stack, created_at
                FROM projects
                ORDER BY created_at DESC";
        $stmt = $this->conn->query($sql);

        return array_map([$this, 'formatProject'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function create($data)
    {
        $this->conn = Database::connect();
        $this->ensureTable();

        $sql = "INSERT INTO projects (name, description, start_date, end_date, github, website, status, progress, stack)
                VALUES (:name, :description, :start_date, :end_date, :github, :website, :status, :progress, :stack)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', Security::cleanString($data['name'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':description', Security::cleanString($data['description'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':start_date', Security::cleanString($data['start_date'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':end_date', Security::cleanString($data['end_date'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':github', Security::cleanString($data['github'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':website', Security::cleanString($data['website'] ?? ''), PDO::PARAM_STR);
        $stmt->bindValue(':status', Security::cleanString($data['status'] ?? 'Dang lam'), PDO::PARAM_STR);
        $stmt->bindValue(':progress', max(0, min(100, (int) ($data['progress'] ?? 0))), PDO::PARAM_INT);
        $stmt->bindValue(':stack', Security::cleanString($data['stack'] ?? ''), PDO::PARAM_STR);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function ensureTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS projects (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(150) NOT NULL,
            description TEXT NULL,
            start_date DATE NULL,
            end_date DATE NULL,
            github VARCHAR(255) NULL,
            website VARCHAR(255) NULL,
            status VARCHAR(80) NOT NULL DEFAULT 'Dang lam',
            progress TINYINT UNSIGNED NOT NULL DEFAULT 0,
            stack VARCHAR(255) NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY projects_status_index (status),
            KEY projects_created_at_index (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->conn->exec($sql);
    }

    private function formatProject($project)
    {
        $project['stack'] = array_values(array_filter(array_map('trim', explode(',', $project['stack'] ?? ''))));

        return $project;
    }
}
