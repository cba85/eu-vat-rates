# European VAT rates

A PHP package to grab up-to-date VAT rates for any European Union member state. 

This package uses http://jsonvat.com to obtain its data for the VAT rates.

## Installation

Install using Composer :

```
$ composer require cba85/eu-vat-rates dev-master
```

## Usage

```php
$rates = new Rates;

/**
 * Get VAT rate of a country
 */
$rate = $rates->getRate('FR');

/**
 * Get specific VAT rate of a country
 */
$rate = $rates->getRate('FR', 'reduced2');
```

You'll find more examples in the ``example`` folder.
