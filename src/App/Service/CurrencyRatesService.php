<?php

namespace App\Service;

use App\Model\Currency;
use App\Model\CurrencyRate;
use DateTime;

class CurrencyRatesService
{
    private static array $currencies = ["EUR", "USD", "CZK", "IDR", "BRL"];

    public function getRates(
        \DateTime $date
    ): array {

        $data = [];
        foreach (self::$currencies as $currency) {
            $data[$currency] = $this->createCurrency($date, $currency);
        }

        return $data;
    }

    private function createCurrency(DateTime $date, string $code): Currency
    {
        $data = $this->getCurrencyData($date, $code);
        $rates = $data['rates'][array_key_first($data["rates"])];

        $now = new DateTime('now');
        $dataNow = $this->getCurrencyData($now, $code);
        $ratesNow = $dataNow['rates'][array_key_first($dataNow["rates"])];

        return (new Currency($data['currency'], $data['code']))
            ->addRate(new CurrencyRate($code, $rates['mid'], $date), 'selectedDate')
            ->addRate(new CurrencyRate($code, $ratesNow['mid'], $now), 'now');

    }

    private function getCurrencyData(DateTime $date, string $code): array
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://api.nbp.pl/api/exchangerates/rates/A/".$code."/".$date->format("Y-m-d")."/?format=json");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $data = json_decode(curl_exec($c), true);
        curl_close($c);
        return $data;
    }
}