<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CurrencyRatesService;
use App\Util\SerializerUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExchangeRatesController extends AbstractController
{
    public function exchangeRates(
        CurrencyRatesService $currencyRatesService,
        Request $request
    ): Response {

        if (null !== $date = $request->get('date')) {
            $date = \DateTime::createFromFormat('Y-m-d', $date);
        } else {
            $date = new \DateTime();
        }

        return new Response(
            SerializerUtil::getSerializer()->serialize($currencyRatesService->getRates($date), 'json'),
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );

    }

}
