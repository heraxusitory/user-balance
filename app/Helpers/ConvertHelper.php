<?php


namespace App\Helpers;


use App\Models\ExchangeRate;

class ConvertHelper
{

    private static $instance = null;

    private function __construct()
    {
        $this->rates = ExchangeRate::query()->pluck('rate', 'currency')->toArray();
    }


    /**
     * @return ConvertHelper
     */
    private static function getInstance(): ConvertHelper
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param $currency
     * @param $value
     * @return float
     */
    public static function convertToUsd($currency, $value)
    {
        $obj = self::getInstance();
        $currency = mb_strtoupper($currency);

        return floatval(number_format(($value / $obj->rates[$currency]), 2, '.', ''));
    }


    /**
     * @param $from
     * @param $to
     * @param $value
     * @return float
     */
    public static function convert($from, $to, $value)
    {
        $obj = self::getInstance();
        $from_rate = $obj->rates[mb_strtoupper($from)];
        $to_rate = $obj->rates[mb_strtoupper($to)];

        return floatval(number_format(($value / $from_rate * $to_rate), 2, '.', ''));
    }

}
