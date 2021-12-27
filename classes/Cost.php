<?php

declare(strict_types=1);

require_once dirname(__FILE__) . '/../connect.php';

class Cost
{
    public $yearMonth;
    public $cost;

    public function __construct(string $yearMonth, int $cost)
    {
        $this->yearMonth = $yearMonth;
        $this->cost = $cost;
    }

    public function escape($input): string
    {
        $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5);
        return $input;
    }

    public function validateYearMonth(string $yearMonth): bool
    {
        // 選択した月が今月以前であることを確認
        if (strtotime($yearMonth) > strtotime(date('Ymd'))) {
            return false;
        };
        return true;
    }

    public function validateCost(int $money): bool
    {
        // 入力した金額が正の数であることを確認
        if ($money <= 0) {
            return false;
        }
        return true;
    }
}
