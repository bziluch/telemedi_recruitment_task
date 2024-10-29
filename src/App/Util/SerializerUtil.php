<?php

namespace App\Util;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerUtil
{
    private static ?Serializer $serializer = null;

    public static function getSerializer() : Serializer {
        if (self::$serializer == null) {
            self::$serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        }
        return self::$serializer;
    }

}