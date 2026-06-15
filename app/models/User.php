<?php

class User
{
    private $conn;

    public function findByEmail($email)
    {
        $this->conn = Database::connect();
        $email = Security::cleanEmail($email);

        if (!Security::isValidEmail($email)) {
            return false;
        }

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $this->conn = Database::connect();

        $sql = "SELECT id, name, email, role, status, created_at FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function logActivity($userId, $action, $description = '')
    {
        $this->conn = Database::connect();
        $this->ensureActivityTable();

        $sql = "INSERT INTO user_activities (user_id, action, description, ip_address, user_agent)
                VALUES (:user_id, :action, :description, :ip_address, :user_agent)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', (int) $userId, PDO::PARAM_INT);
        $stmt->bindValue(':action', Security::cleanString($action), PDO::PARAM_STR);
        $stmt->bindValue(':description', Security::cleanString($description), PDO::PARAM_STR);
        $stmt->bindValue(':ip_address', $_SERVER['REMOTE_ADDR'] ?? '', PDO::PARAM_STR);
        $stmt->bindValue(':user_agent', substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function dashboardStats($userId)
    {
        $this->conn = Database::connect();
        $this->ensureActivityTable();

        $user = $this->findById($userId);

        $totalSql = "SELECT COUNT(*) FROM user_activities WHERE user_id = :user_id";
        $totalStmt = $this->conn->prepare($totalSql);
        $totalStmt->bindValue(':user_id', (int) $userId, PDO::PARAM_INT);
        $totalStmt->execute();
        $totalActivities = (int) $totalStmt->fetchColumn();

        $monthSql = "SELECT
                        DATE_FORMAT(created_at, '%Y-%m') AS month_key,
                        MONTH(created_at) AS month_number,
                        YEAR(created_at) AS year_number,
                        COUNT(*) AS total
                    FROM user_activities
                    WHERE user_id = :user_id
                    GROUP BY month_key, month_number, year_number
                    ORDER BY month_key ASC";
        $monthStmt = $this->conn->prepare($monthSql);
        $monthStmt->bindValue(':user_id', (int) $userId, PDO::PARAM_INT);
        $monthStmt->execute();
        $activityByMonth = $monthStmt->fetchAll(PDO::FETCH_ASSOC);

        $recentSql = "SELECT action, description, created_at
                    FROM user_activities
                    WHERE user_id = :user_id
                    ORDER BY created_at DESC
                    LIMIT 8";
        $recentStmt = $this->conn->prepare($recentSql);
        $recentStmt->bindValue(':user_id', (int) $userId, PDO::PARAM_INT);
        $recentStmt->execute();

        $bestMonth = null;
        foreach ($activityByMonth as $month) {
            if ($bestMonth === null || (int) $month['total'] > (int) $bestMonth['total']) {
                $bestMonth = $month;
            }
        }

        return [
            'user' => $user,
            'total_activities' => $totalActivities,
            'activity_by_month' => $activityByMonth,
            'best_month' => $bestMonth,
            'recent_activities' => $recentStmt->fetchAll(PDO::FETCH_ASSOC),
        ];
    }

    private function ensureActivityTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS user_activities (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED NOT NULL,
            action VARCHAR(80) NOT NULL,
            description VARCHAR(255) NULL,
            ip_address VARCHAR(45) NULL,
            user_agent VARCHAR(255) NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_activities_user_month_index (user_id, created_at),
            CONSTRAINT user_activities_user_id_foreign
                FOREIGN KEY (user_id) REFERENCES users (id)
                ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->conn->exec($sql);
    }
}
