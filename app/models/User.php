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
}
