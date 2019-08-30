<?php
use PHPUnit\Framework\TestCase;
use VatRates\Rates;

class RateTest extends TestCase
{

    public function testUnknownCountryRate() {
        $this->expectException(Exception::class);
        $rates = new Rates;
        $rate = $rates->getRate('TE');
    }

    public function testFranceStandardRate() {
        $rates = new Rates;
        $rate = $rates->getRate('FR');
        $this->assertEquals(20.0, $rate);
    }

    public function testFranceReduced2Rate() {
        $rates = new Rates;
        $rate = $rates->getRate('FR', 'reduced2');
        $this->assertEquals(10.0, $rate);
    }

    public function testFranceRates() {
        $rates = new Rates;
        $rate = $rates->getRates('FR');
        $expected = new stdClass;
        $expected->super_reduced = 2.1;
        $expected->reduced1 = 5.5;
        $expected->reduced2 = 10.0;
        $expected->standard = 20.0;
        $this->assertEquals($expected, $rate);
    }

}
