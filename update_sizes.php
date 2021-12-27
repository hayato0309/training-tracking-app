<?php

declare(strict_types=1);
session_start();

require_once dirname(__FILE__) . '/connect.php';
require_once dirname(__FILE__) . '/classes/Sizes.php';

if ($_POST['submit'] === 'submit') {
    $heightArray = [];
    $weightArray = [];
    $chestArray = [];
    $bicepArray = [];
    $hipArray = [];
    $thighArray = [];

    // heightの連想配列を作成
    $heightArray['start'] = $_POST['height-start'];
    $heightArray['current'] = $_POST['height-current'];
    $heightArray['goal'] = $_POST['height-goal'];

    // weightの連想配列を作成
    $weightArray['start'] = $_POST['weight-start'];
    $weightArray['current'] = $_POST['weight-current'];
    $weightArray['goal'] = $_POST['weight-goal'];

    // chestの連想配列を作成
    $chestArray['start'] = $_POST['chest-start'];
    $chestArray['current'] = $_POST['chest-current'];
    $chestArray['goal'] = $_POST['chest-goal'];

    // waistの連想配列を作成
    $waistArray['start'] = $_POST['waist-start'];
    $waistArray['current'] = $_POST['waist-current'];
    $waistArray['goal'] = $_POST['waist-goal'];

    // bicepの連想配列を作成
    $bicepArray['start'] = $_POST['bicep-start'];
    $bicepArray['current'] = $_POST['bicep-current'];
    $bicepArray['goal'] = $_POST['bicep-goal'];

    // hipの連想配列を作成
    $hipArray['start'] = $_POST['hip-start'];
    $hipArray['current'] = $_POST['hip-current'];
    $hipArray['goal'] = $_POST['hip-goal'];

    // thighの連想配列を作成
    $thighArray['start'] = $_POST['thigh-start'];
    $thighArray['current'] = $_POST['thigh-current'];
    $thighArray['goal'] = $_POST['thigh-goal'];

    $sizes = new Sizes($heightArray, $weightArray, $chestArray, $waistArray, $bicepArray, $hipArray, $thighArray);

    // 入力されたサイズが正の数か確認
    foreach ($sizes as $key => $values) {
        foreach ($values as $value) {
            // 入力データをエスケープし、validateSizeに入れるようにfloatにキャストする
            $value = (float) $sizes->escape($value);

            if ($sizes->validateSize($value) === false) {
                $_SESSION['sizeError'] = 'Size must be more than 0.';
                header('Location: index.php');
                return;
            }
        }
    }

    // それぞれのデータが正の数であった場合に、以下のSQLを実行しDBに格納
    $statement = $pdo->prepare('UPDATE sizes SET height = :heightJson, weight = :weightJson, chest = :chestJson, waist = :waistJson, bicep = :bicepJson, hip = :hipJson, thigh = :thighJson');
    $statement->bindValue(':heightJson', json_encode($heightArray), PDO::PARAM_STR);
    $statement->bindValue(':weightJson', json_encode($weightArray), PDO::PARAM_STR);
    $statement->bindValue(':chestJson', json_encode($chestArray), PDO::PARAM_STR);
    $statement->bindValue(':waistJson', json_encode($waistArray), PDO::PARAM_STR);
    $statement->bindValue(':bicepJson', json_encode($bicepArray), PDO::PARAM_STR);
    $statement->bindValue(':hipJson', json_encode($hipArray), PDO::PARAM_STR);
    $statement->bindValue(':thighJson', json_encode($thighArray), PDO::PARAM_STR);
    $statement->execute();
}

header('Location: index.php');
