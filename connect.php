<?php

declare(strict_types=1);

try {
    $pdo = new PDO('mysql:host=localhost; dbname=training_tracking_app; charset=utf8mb4', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // echo '接続に成功しました。';
} catch (PDOException $e) {
    echo '接続に失敗しました。';
}
