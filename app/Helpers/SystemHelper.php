<?php

use App\HelperTrait\SanitizerHelper;
use App\Repository\SettingRepository;
use Illuminate\Support\Str;

if (!function_exists('__t')) {

    function __t($key = '', $options = [], $isCapitalized = false) {

        $vars = count($options) ? array_merge(...array_map(function ($k) use ($options) {
            $value = __("default.$options[$k]");
            return [
                "{".$k."}" =>  $value,
                "{ $k }" =>  $value,
                "{ $k}" => $value,
                "{".$k." }" =>  $value,
                ":$k" => $value
            ];
        }, array_keys($options))) : [];

        $string = strtr(__("default.{$key}"), $vars);
        return $isCapitalized ? ucwords($string) : $string;
    }
}

if (!function_exists('foreign_key_exception')){

    function foreign_key_exception($code): string
    {
        if ($code == 23000){

            return 'You can \'t delete this role because this role is use in another table';
        }
    }
}

if (!function_exists('app_setting')) {

    function app_setting($key, $column = 'value'){

        return resolve(SettingRepository::class)->findSettingWithName($key, $column);

    }
}

if (!function_exists('app_settings')) {

    function app_settings(){

        $app_settings = cache()->rememberForever('app_settings', function (){
            return resolve(SettingRepository::class)->getFormatSetting();
        });

        return $app_settings;

    }
}
if (!function_exists('dateTimeFormat')) {

    function date_time_format(){

        return app_settings()['date_format'].(app_settings()['time_format'] == 12 ? ' h:i:s A' : ' H:i:s A');

    }
}


if (!function_exists('dateFormat')) {

    function dateFormat($value){

        return date(app_settings()['date_format'], strtotime($value));

    }
}



if (!function_exists('sanitize_data')) {
    /**
     * @param $value
     * @return mixed
     */
    function sanitize_data($value)
    {
        return resolve(SanitizerHelper::class)->filterData($value);
    }
}

if (!function_exists('set_slug')) {
    /**
     * @param $value
     * @return mixed
     */
    function set_slug($value)
    {
        return Str::slug($value);
    }
}

if (!function_exists('set_limit')) {
    /**
     * @param $value
     * @return mixed
     */
    function set_limit($value, $limit = 50)
    {
        return Str::limit($value, $limit);
    }
}

if (!function_exists('currency')) {
    /**
     * @param $value
     * @return mixed
     */
    function currency($value)
    {
        return app_settings()['currency_symbol'].' '.$value;
    }
}

if (!function_exists('numberToWords')) {
    function numberToWords($num)
    {

        $ones = array(
            0 => "ZERO",
            1 => "ONE",
            2 => "TWO",
            3 => "THREE",
            4 => "FOUR",
            5 => "FIVE",
            6 => "SIX",
            7 => "SEVEN",
            8 => "EIGHT",
            9 => "NINE",
            10 => "TEN",
            11 => "ELEVEN",
            12 => "TWELVE",
            13 => "THIRTEEN",
            14 => "FOURTEEN",
            15 => "FIFTEEN",
            16 => "SIXTEEN",
            17 => "SEVENTEEN",
            18 => "EIGHTEEN",
            19 => "NINETEEN",
            "014" => "FOURTEEN"
        );
        $tens = array(
            0 => "ZERO",
            1 => "TEN",
            2 => "TWENTY",
            3 => "THIRTY",
            4 => "FORTY",
            5 => "FIFTY",
            6 => "SIXTY",
            7 => "SEVENTY",
            8 => "EIGHTY",
            9 => "NINETY"
        );
        $hundreds = array(
            "HUNDRED",
            "THOUSAND",
            "MILLION",
            "BILLION",
            "TRILLION",
            "QUARDRILLION"
        ); /*limit t quadrillion */
        $num = number_format($num, 2, ".", ",");
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr, 1);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {

            while (substr($i, 0, 1) == "0")
                $i = substr($i, 1, 5);
            if ($i < 20) {
                /* echo "getting:".$i; */
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                if (substr($i, 0, 1) != "0") $rettxt .= $tens[substr($i, 0, 1)];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
                if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
                if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
                if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
            }
            if ($key > 0) {
                $rettxt .= " " . $hundreds[$key] . " ";
            }
        }
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            }
        }
        return $rettxt;
    }
}

