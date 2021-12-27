<?php

declare(strict_types=1);

class Sizes
{
    // それぞれ['start', 'current', 'goal']の連想配列で定義
    // DBに格納する際にjsonに変換する
    public $height;
    public $weight;
    public $chest;
    public $waist;
    public $bicep;
    public $hip;
    public $thigh;

    public function __construct(array $height, array $weight, array $chest, array $waist, array $bicep, array $hip, array $thigh)
    {
        $this->height = $height;
        $this->weight = $weight;
        $this->chest = $chest;
        $this->waist = $waist;
        $this->bicep = $bicep;
        $this->hip = $hip;
        $this->thigh = $thigh;
    }

    public function escape(string $size): string
    {
        $size = htmlspecialchars($size, ENT_QUOTES | ENT_HTML5);
        return $size;
    }

    public function validateSize(float $size): bool
    {
        // ユーザの入力データから半角・全角スペースを削除
        // $size = str_replace(" ", "　", "");

        if ($size <= 0) {
            return false;
        }
        return true;
    }

    public function computeDiff(float $current, float $goal): float
    {
        $diff = $goal - $current;
        return $diff;
    }

    // 単位を変えるメソッド
    public function assignUnit(string $sizeName): string
    {
        if ($sizeName === 'weight') {
            return 'kg';
        }
        return 'cm';
    }
}
