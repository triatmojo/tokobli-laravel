<?php

if (!function_exists('currency_IDR')) {
    function currency_IDR($value)
    {
        $price = "Rp. " . number_format($value, 2, ',', '.');
        return $price;
    }
}
