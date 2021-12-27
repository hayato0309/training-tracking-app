<?php

declare(strict_types=1);
session_start();

require_once dirname(__FILE__) . '/connect.php';
require_once dirname(__FILE__) . '/classes/DayRecord.php';

$dateStart = $_POST['dateStart'];
$today = date('Y-m-d');
$dayRecord = new DayRecord($dateStart);

if ($_POST['submit'] === 'submit' && $dateStart !== '' && $dayRecord->isDateStartOnOrBeforeToday($dateStart, $today)) {
    // submitボタンが押されている、かつ、日付が選択されている、かつ、日付が今日以前のとき
    $statement = $pdo->prepare('UPDATE day_record SET date_Start = :dateStart, created_at = CURRENT_TIMESTAMP');
    $statement->bindValue(':dateStart', $_POST['dateStart'], PDO::PARAM_STR);
    $statement->execute();
} else {
    // submitボタンを押さずURLを直接入力した時、日付が選択されていない時
    $_SESSION['no_dateStart'] = 'Please select the proper date.';
}

header('Location: index.php');
