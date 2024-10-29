<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class CurrencyRate
{
    private static array $sellable = ["EUR", "USD"];

    #[Context(
        normalizationContext: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'],
    )]
    private \DateTime|string $effectiveDate = 'today';
    private float $rate;
    private float $sellRate;
    private ?float $buyRate = null;

    public function __construct(string $code, float $rate, \DateTime|null $effectiveDate = null) {

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