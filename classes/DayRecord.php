<?php

declare(strict_types=1);

class DayRecord
{
    private $dateStart;

    public function __construct(string $dateStart)
    {
        $this->dateStart = $dateStart;
    }

    public function computeStreak(string $dateStart): int
    {
        $dateStartUnix = strtotime($dateStart);
        $todayUnix = strtotime(date('Y-m-d'));
        $streakUnix = $todayUnix - $dateStartUnix;
        $streak = $this->unixToDays($streakUnix);
        return $streak;
    }

    private function unixToDays(int $streakUnix): int
    {
        $days = ($streakUnix / 60 / 60 / 24) + 1;
        return $days;
    }

    public function isDateStartOnOrBeforeToday(string $dateStart, string $today): bool
    {
        $dateStartUnix = strtotime($dateStart);
        $todayUnix = strtotime($today);

        return $todayUnix >= $dateStartUnix;
    }
}
