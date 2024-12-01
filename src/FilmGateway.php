<?php

class FilmGateway {

    private PDO $conn;

    public function __construct(Database $database) {

        $this->conn = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT *
                FROM film";
        
        $stmt = $this->conn->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row["include_adult_content"] = (bool) $row["include_adult_content"];
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data) 
    {
        $sql = "INSERT INTO film (title, description, rating, include_adult_content, film_language, release_date, running_time, starring, directed_by, screenplay_by, img)
                VALUES (:title, :description, :rating, :include_adult_content, :film_language, :release_date, :running_time, :starring, :directed_by, :screenplay_by, :img)";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $data["description"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":rating", $data["rating"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":include_adult_content", (bool) ($data["include_adult_content"] ?? false), PDO::PARAM_BOOL);
        $stmt->bindValue(":film_language", $data["film_language"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":release_date", $data["release_date"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":running_time", $data["running_time"] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(":starring", $data["starring"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":directed_by", $data["directed_by"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":screenplay_by", $data["screenplay_by"] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(":img", $data["img"] ?? null, PDO::PARAM_STR);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    /**
     * @param string $id
     * @return array|false
     */
    public function get(string $id)
    {
        $sql = "SELECT *
                FROM film
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data !== false) {
            $data["include_adult_content"] = (bool) $data["include_adult_content"];
        }
        
        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE film
                SET title = :title, description = :description, rating = :rating, include_adult_content = :include_adult_content, film_language = :film_language, release_date = :release_date, running_time = :running_time, starring = :starring, directed_by = :directed_by, screenplay_by = :screenplay_by, img = :img
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $new["title"] ?? $current["title"], PDO::PARAM_STR);
        $stmt->bindValue(":description", $new["description"] ?? $current["description"], PDO::PARAM_STR);
        $stmt->bindValue(":rating", $new["rating"] ?? $current["rating"], PDO::PARAM_INT);
        $stmt->bindValue(":include_adult_content", $new["include_adult_content"] ?? $current["include_adult_content"], PDO::PARAM_BOOL);
        $stmt->bindValue(":film_language", $new["film_language"] ?? $current["film_language"], PDO::PARAM_STR);
        $stmt->bindValue(":release_date", $new["release_date"] ?? $current["release_date"], PDO::PARAM_STR);
        $stmt->bindValue(":running_time", $new["running_time"] ?? $current["running_time"], PDO::PARAM_INT);
        $stmt->bindValue(":starring", $new["starring"] ?? $current["starring"], PDO::PARAM_STR);
        $stmt->bindValue(":directed_by", $new["directed_by"] ?? $current["directed_by"], PDO::PARAM_STR);
        $stmt->bindValue(":screenplay_by", $new["screenplay_by"] ?? $current["screenplay_by"], PDO::PARAM_STR);
        $stmt->bindValue(":img", $new["img"] ?? $current["img"], PDO::PARAM_STR);
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM film
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
}