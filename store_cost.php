<?php

declare(strict_types=1);
session_start();

require_once dirname(__FILE__) . '/connect.php';
require_once dirname(__FILE__) . '/classes/Cost.php';

if ($_POST['submit'] === 'submit') {
    $yearMonth = $_POST['year-month'];
    $money = $_POST['money'];

    $cost = new Cost($yearMonth, (int) $money);

    // 入力値をエスケープ
    $yearMonth = $cost->escape($yearMonth);
    $money = $cost->escape($money);

    // 入力値を検証
    if ($cost->validateYearMonth($yearMonth) === false) {
        $_SESSION['yearMonthError'] = 'The year and month must be now or before.';
    }
    if ($cost->validateCost((int) $money) === false) {
        $_SESSION['moneyError'] = 'The money should be more than 0.';
    }

    // 不適切な入力があった場合は、index.phpにエラーメッセージと一緒に返す
    if (!empty($_SESSION)) {
        header('Location: index.php');
        return;
    }

    // yearMonthが今or前、かつ、金額が正の数の場合、以下のSQLを実行する
    $statement = $pdo->prepare('INSERT INTO costs (paid_month, money, created_at) VALUES (:yearMonth, :money, CURRENT_TIMESTAMP)');
    $statement->bindValue(':yearMonth', $yearMonth, PDO::PARAM_STR);
    $statement->bindValue(':money', $money, PDO::PARAM_INT);
    $statement->execute();
}
header('Location: index.php');
