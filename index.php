<?php

declare(strict_types=1);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Tracking App</title>
    <!-- Google fonts - Raleway -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS files -->
    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php

    require_once dirname(__FILE__) . '/connect.php';
    require_once dirname(__FILE__) . '/classes/DayRecord.php';
    require_once dirname(__FILE__) . '/classes/Sizes.php';

    /**
     * dateStart と streak を計算
     */

    // day_recordテーブルからdate_startデータ（開始日）を取得
    $statement = $pdo->prepare('SELECT date_start FROM day_record');
    $statement->execute();
    $day_record = $statement->fetch(PDO::FETCH_ASSOC);

    // DayRecordのインスタンスを作り、computeStreakメソッドでstreakを計算
    $dayRecord = new DayRecord($day_record['date_start']);
    $streak = $dayRecord->computeStreak($day_record['date_start']);


    /**
     * training scheduleを取得
     */
    $statement = $pdo->prepare('SELECT * FROM training_schedule');
    $statement->execute();
    $training_schedule = $statement->fetch(PDO::FETCH_ASSOC);


    /**
     * sizesを取得し、jsonを配列に戻す
     */
    $statement = $pdo->prepare('SELECT height, weight, chest, waist, bicep, hip, thigh FROM sizes');
    $statement->execute();
    $sizesJson = $statement->fetch(PDO::FETCH_ASSOC);
    $sizesAssoc = [];
    foreach ($sizesJson as $key => $value) {
        $sizesAssoc[$key] = json_decode($value, true);
    }

    // メソッドをコールするためにインスタンスを生成    
    $sizes = new Sizes($sizesAssoc['height'], $sizesAssoc['weight'], $sizesAssoc['chest'], $sizesAssoc['waist'], $sizesAssoc['bicep'], $sizesAssoc['hip'], $sizesAssoc['thigh']);

    // currentとgoalの差分を計算し、単位を選定する
    foreach ($sizes as $key => $values) {
        $values['diff'] = $sizes->computeDiff((float) $values['current'], (float) $values['goal']);
        $values['unit'] = $sizes->assignUnit($key);

        $sizes->$key = $values;
    }
    ?>
    <div class="wrapper">

        <?php if (!empty($_SESSION)) : ?>
            <div class="error-message-container" id="error-message-container">
                <div class="erorr-message">
                    <?php foreach ($_SESSION as $key => $value) : ?>
                        <div><?= $value ?></div>
                    <?php endforeach; ?>
                </div>
                <button class="close-error-message-container" id="close-error-message-container">&times;</button>
            </div>
        <?php endif; ?>
        <?php session_destroy(); ?>

        <div class="wrapper-left">
            <section class="daily-announce component">
                <div class="date">December 20th 2021</div>
                <div class="greeting">Hello Hayato!</div>
                <div class="reminder">Today is <span class="training-type">Leg</span> day. Keep it up!</div>
            </section>
            <section class="streak component" id="open-streak-modal">
                <div class=" streak-days">
                    Day <?= $streak ?>
                </div>
            </section>
            <div class="modal-container" id="streak-modal-container">
                <div class="modal" id="streak-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Day <?= $streak ?>
                        </div>
                        <button class="close-button" id="close-streak-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="update_day_record.php" method="post">
                            <div class="streak-question-container">
                                <label for="">When was the first trainig day?</label>
                                <input class="streak-input-box" name="dateStart" type="date" max="<?= date('Y-m-d') ?>" value="<?= $day_record['date_start'] ?>" required>
                            </div>
                            <div class="submit-button-container">
                                <button class="submit-button" type="submit" name="submit" value="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <section class="schedule component" id="open-schedule-modal">
                <h2 class="heading">Schedule</h2>
                <ul>
                    <li>
                        <div class="day">MON</div>
                        <div class="training-type"><?= $training_schedule['monday'] ?></div>
                    </li>
                    <li>
                        <div class="day">TUE</div>
                        <div class="training-type"><?= $training_schedule['tuesday'] ?></div>
                    </li>
                    <li>
                        <div class="day">WED</div>
                        <div class="training-type"><?= $training_schedule['wednesday'] ?></div>
                    </li>
                    <li>
                        <div class="day">THU</div>
                        <div class="training-type"><?= $training_schedule['thursday'] ?></div>
                    </li>
                    <li>
                        <div class="day">FRI</div>
                        <div class="training-type"><?= $training_schedule['friday'] ?></div>
                    </li>
                    <li>
                        <div class="day">SAT</div>
                        <div class="training-type"><?= $training_schedule['saturday'] ?></div>
                    </li>
                    <li>
                        <div class="day">SUN</div>
                        <div class="training-type"><?= $training_schedule['sunday'] ?></div>
                    </li>
                </ul>
            </section>
            <div class="modal-container" id="schedule-modal-container">
                <div class="modal" id="schedule-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Training Schedule
                        </div>
                        <button class="close-button" id="close-schedule-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="update_training_schedule.php" method="post">
                            <div class="form-row">
                                <label class="day" for="monday">MON</label>
                                <input name="monday" type="text" value="<?= $training_schedule['monday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="tuesday">TUE</label>
                                <input name="tuesday" type="text" value="<?= $training_schedule['tuesday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="wednesday">WED</label>
                                <input name="wednesday" type="text" value="<?= $training_schedule['wednesday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="thursday">THU</label>
                                <input name="thursday" type="text" value="<?= $training_schedule['thursday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="friday">FRI</label>
                                <input name="friday" type="text" value="<?= $training_schedule['friday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="saturday">SAT</label>
                                <input name="saturday" type="text" value="<?= $training_schedule['saturday'] ?>" required>
                            </div>
                            <div class="form-row">
                                <label class="day" for="sunday">SUN</label>
                                <input name="sunday" type="text" value="<?= $training_schedule['sunday'] ?>" required>
                            </div>
                            <div class="submit-button-container">
                                <button class="submit-button" type="submit" name="submit" value="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-right">
            <section class="sizes component" id="open-sizes-modal">
                <h2 class="heading">Sizes</h2>
                <table class="sizes-table">
                    <tr>
                        <th></th>
                        <th>Start</th>
                        <th>Current</th>
                        <th>Goal</th>
                        <th>Diff</th>
                    </tr>
                    <?php foreach ($sizes as $key => $value) : ?>
                        <tr>
                            <td><?= ucfirst($key) ?></td>
                            <td><?= $value['start'] . ' ' . $value['unit'] ?></td>
                            <td><?= $value['current'] . ' ' . $value['unit'] ?></td>
                            <td><?= $value['goal'] . ' ' . $value['unit'] ?></td>
                            <td><?= sprintf('%+.1f', $value['diff']) . ' ' . $value['unit'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
            <div class="modal-container" id="sizes-modal-container">
                <div class="modal" id="sizes-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Sizes
                        </div>
                        <button class="close-button" id="close-sizes-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="update_sizes.php" method="post">
                            <table class="size-input-table">
                                <tr class="size-input-row">
                                    <th></th>
                                    <th>Start</th>
                                    <th>Current</th>
                                    <th>Goal</th>
                                    <th>Diff</th>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Height</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="height-start" value="<?= $sizes->height['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="height-current" value="<?= $sizes->height['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="height-goal" value="<?= $sizes->height['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->height['diff']) ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Weight</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="weight-start" value="<?= $sizes->weight['start'] ?>" min="0"> kg</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="weight-current" value="<?= $sizes->weight['current'] ?>" min="0"> kg</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="weight-goal" value="<?= $sizes->weight['goal'] ?>" min="0"> kg</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->weight['diff']) ?> kg</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Chest</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="chest-start" value="<?= $sizes->chest['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="chest-current" value="<?= $sizes->chest['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="chest-goal" value="<?= $sizes->chest['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->chest['diff']) ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Waist</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="waist-start" value="<?= $sizes->waist['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="waist-current" value="<?= $sizes->waist['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="waist-goal" value="<?= $sizes->waist['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->waist['diff']) ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Bicep</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="bicep-start" value="<?= $sizes->bicep['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="bicep-current" value="<?= $sizes->bicep['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="bicep-goal" value="<?= $sizes->bicep['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->bicep['diff']) ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Hip</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="hip-start" value="<?= $sizes->hip['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="hip-current" value="<?= $sizes->hip['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="hip-goal" value="<?= $sizes->hip['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->hip['diff']) ?> cm</td>
                                </tr>
                                <tr>
                                    <td class="size-input-cell">Thigh</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="thigh-start" value="<?= $sizes->thigh['start'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="thigh-current" value="<?= $sizes->thigh['current'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><input class="size-input-box" type="number" step="0.1" name="thigh-goal" value="<?= $sizes->thigh['goal'] ?>" min="0"> cm</td>
                                    <td class="size-input-cell"><?= sprintf('%+.1f', $sizes->thigh['diff']) ?> cm</td>
                                </tr>
                            </table>
                            <div class="submit-button-container">
                                <button class="submit-button" type="submit" name="submit" value="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <section class="cost component" id="open-cost-modal">
                <h2 class="heading">Cost</h2>
                <div class="monthly">
                    <div>November, 2021</div>
                    <div>¥10,000-</div>
                </div>
                <div class="totalCost">
                    <div>From 2021-09-01 until today</div>
                    <div>¥50,000-</div>
                </div>
            </section>
            <div class="modal-container" id="cost-modal-container">
                <div class="modal" id="cost-modal">
                    <div class="modal-header">
                        <div class="modal-title">
                            Cost
                        </div>
                        <button class="close-button" id="close-cost-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="store_cost.php" method="post">
                            <div class="cost-question-container">
                                <label for="year-month">Please select year and month.</label>
                                <!-- <input class="cost-input-box" name="year-month" type="month" max="2021-10"> -->
                                <input class="cost-input-box" name="year-month" type="month" max="<?= date('Y-m') ?>">
                            </div>
                            <div class="cost-question-container">
                                <label for="money">How much did you epend the month?</label>
                                <input class="cost-input-box" name="money" type="number" placeholder="¥" min="1">
                            </div>
                            <div class="submit-button-container">
                                <button class="submit-button" type="submit" name="submit" value="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

</html>