<?php

namespace VatRates;

use Exception;

/**
 * Class Rates
 * @package VatRates
 */
class Rates
{

    /**
     * @const string
     */
    const URL = 'https://jsonvat.com/';

    /**
     * @var array
     */
    private $map;

    /**
     * Rates constructor.
     */
    public function __construct()
    {
        $url = self::URL;
        $response = file_get_contents($url);

        if (empty($response)) {
            throw new Exception('Error fetching rates from' . $url);
        }
        $data = json_decode($response);

        $map = array();
        foreach ($data->rates as $rate) {
            $map[$rate->country_code] = $rate->periods[0]->rates;
        }
        $this->map = $map;
    }

    /**
     * Get normalized country code
     *
     * Fixes ISO-3166-1-alpha2 exceptions
     *
     * @param string $country
     *
     * @return string
     */
    protected function getCountryCode($country)
    {
        if ($country == 'UK') {
            $country = 'GB';
        }
        if ($country == 'EL') {
            $country = 'GR';
        }
        return $country;
    }

    /**
     * Get rate of a country
     *
     * @param string $country
     * @param string $rate
     *
     * @return double
     *
     * @throws Exception
     */
    public function getRate($country, $rate = 'standard')
    {
        $country = strtoupper($country);
        $country = $this->getCountryCode($country);
        if (!isset($this->map[$country])) {
            throw new Exception('Invalid country code.');
        }
        if (!isset($this->map[$country]->$rate)) {
            throw new Exception('Invalid rate.');
        }
        return $this->map[$country]->$rate;
    }

    /**
     * Get all rates
     *
     * @param null $country
     *
     * @return array|mixed
     *
     * @throws Exception
     */
    public function getRates($country = null) {
        if ($country) {
            $country = $this->getCountryCode($country);
            if (!isset($this->map[$country])) {
                throw new Exception('Invalid country code.');
            }
            return $this->map[$country];
        }
        return $this->map;
    }

}