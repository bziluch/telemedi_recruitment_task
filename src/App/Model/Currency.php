<?php

namespace App\Model;

class Currency
{

    private $name;
    private $code;
    private $rates = [];

    public function __construct(string $name, string $code) {
        $this->name = $name;
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getRates(): array
    {
        return $this->rates;
    }

    public function addRate(CurrencyRate $rate, string $label): self
    {
        $this->rates[$label] = $rate;

        return $this;
    }

}