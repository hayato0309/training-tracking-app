<?php

declare(strict_types=1);
session_start();

require_once dirname(__FILE__) . '/connect.php';
require_once dirname(__FILE__) . '/classes/TrainingSchedule.php';

if ($_POST['submit'] === 'submit') {

    $monday = $_POST['monday'];
    $tuesday = $_POST['tuesday'];
    $wednesday = $_POST['wednesday'];
    $thursday = $_POST['thursday'];
    $friday = $_POST['friday'];
    $saturday = $_POST['saturday'];
    $sunday = $_POST['sunday'];

    $trainingSchedule = new TrainingSchedule($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);

    // それぞれのトレーニング内容が1文字以上200文字以下かを確認
    foreach ($trainingSchedule as $key => $value) {
        $trainingPart = $trainingSchedule->escape($value);
        $trainingPart = $trainingSchedule->validateTrainingScheduleStrLength($trainingPart);

        if ($trainingPart === false) {
            $_SESSION['trainingScheduleError'] = 'Training schedule must be 1-200 characters.';
            header('Location: index.php');
            return;
        }
    }

    // それぞれのトレーニング内容が1文字以上200文字以下の条件を満たした場合、以下のSQLを実行
    $statement = $pdo->prepare('UPDATE training_schedule SET monday = :monday, tuesday = :tuesday, wednesday = :wednesday, thursday = :thursday, friday = :friday, saturday = :saturday, sunday = :sunday, created_at = CURRENT_TIMESTAMP');
    $statement->bindValue(':monday', $_POST['monday'], PDO::PARAM_STR);
    $statement->bindValue(':tuesday', $_POST['tuesday'], PDO::PARAM_STR);
    $statement->bindValue(':wednesday', $_POST['wednesday'], PDO::PARAM_STR);
    $statement->bindValue(':thursday', $_POST['thursday'], PDO::PARAM_STR);
    $statement->bindValue(':friday', $_POST['friday'], PDO::PARAM_STR);
    $statement->bindValue(':saturday', $_POST['saturday'], PDO::PARAM_STR);
    $statement->bindValue(':sunday', $_POST['sunday'], PDO::PARAM_STR);
    $statement->execute();
} else {
    return;
}

header('Location: index.php');
