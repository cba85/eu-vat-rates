<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

use VatRates\Rates;

$rates = new Rates;

/**
 * Get VAT rate of a country
 */
$rate = $rates->getRate('FR');
echo $rate;

/**
 * Get specific VAT rate of a country
 */
$rate = $rates->getRate('FR', 'reduced2');
echo $rate;

/**
 * Get all VAT rates of a country
 */
$rates = $rates->getRates('FR');
print_r($rate);

/**
 * Get all VAT rates of countries
 */
$rates = $rates->getRates();
print_r($rates);