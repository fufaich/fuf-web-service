<?php
try {
    $db = new PDO(
        "pgsql:host=postgres;dbname=app_db",
        "app_user",
        "secret"
    );
    echo "Connected to PostgreSQL!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}