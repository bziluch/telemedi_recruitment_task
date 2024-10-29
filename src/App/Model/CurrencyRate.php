<?php

namespace App\Model;

class CurrencyRate
{
    private static $sellable = ["EUR", "USD"];

    private $effectiveDate = 'today';
    private $rate;
    private $sellRate;
    private $buyRate = null;

    public function __construct(string $code, float $rate, ?\DateTime $effectiveDate = null) {

        if (null !== $effectiveDate) {
            $this->effectiveDate = $effectiveDate;
        }
        $this->rate = $rate;

        if (in_array($code, self::$sellable)) {
            $this->buyRate = $rate - 0.05;
            $this->sellRate = $rate + 0.07;
        } else {
            $this->sellRate = $rate + 0.15;
        }

    }

    public function getEffectiveDate(): string
    {
        return $this->effectiveDate instanceof \DateTime ? $this->effectiveDate->format("Y-m-d") : $this->effectiveDate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getSellRate(): float
    {
        return $this->sellRate;
    }

    public function getBuyRate(): ?float
    {
        return $this->buyRate;
    }

}