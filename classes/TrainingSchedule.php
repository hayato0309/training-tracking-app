<?php

declare(strict_types=1);

class TrainingSchedule
{
    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;

    public function __construct(string $monday, string $tuesday, string $wednesday, string $thursday, string $friday, string $saturday, string $sunday)
    {
        $this->monday = $monday;
        $this->tuesday = $tuesday;
        $this->wednesday = $wednesday;
        $this->thursday = $thursday;
        $this->friday = $friday;
        $this->saturday = $saturday;
        $this->sunday = $sunday;
    }

    public function escape(string $trainingPart): string
    {
        $trainingPart = htmlspecialchars($trainingPart, ENT_HTML5 | ENT_HTML5);
        return $trainingPart;
    }

    public function validateTrainingScheduleStrLength(string $trainingPart): bool
    {
        // ユーザの入力データから半角・全角スペースを削除
        $trainingPart = str_replace(array(" ", "　"), "", $trainingPart);

        // 半角・全角スペースを削除したものに対してstringの長さを測ることで、スペースのみで構成された入力データを弾く
        if (strlen($trainingPart) <= 0 || strlen($trainingPart) > 200) {
            return false;
        }
        return true;
    }

    public static function getTrainingDay(): string
    {
        // 曜日の配列を用意
        $week = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        // 今日の曜日を取得
        $day = $week[date("w")];

        return $day;
    }
}
