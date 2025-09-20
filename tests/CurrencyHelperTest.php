<?php

declare(strict_types=1);

namespace App\Tests;

use App\Helper\CurrencyHelper;
use Money\Money;
use PHPUnit\Framework\TestCase;

class CurrencyHelperTest extends TestCase
{
    public function testItReturnsWhetherCurrenciesAreTheSame(): void
    {
        $helper = new CurrencyHelper();

        $amount1 = Money::EUR(10);
        $amount2 = Money::EUR(20);
        $amount3 = Money::EUR(15);
        $amount4 = Money::USD(10);

        $this->assertTrue($helper->isSame($amount1, $amount2));
        $this->assertTrue($helper->isSame($amount1, $amount2, $amount3));
        $this->assertFalse($helper->isSame($amount1, $amount4));
        //$this->assertFalse($helper->isSame($amount1, $amount2, $amount4));
        $this->assertFalse($helper->isSame($amount1, $amount4));
    }

    public function testItReturnsNumericCode(): void
    {
        $helper = new CurrencyHelper();

        $this->assertEquals(978, $helper->numericCode(Money::EUR(10)));
        $this->assertEquals(840, $helper->numericCode(Money::USD(10)));
    }

    public function testAddValues(): void
    {
        $helper = new CurrencyHelper();

        $sum = $helper->addValues(1, '1.2');
        $this->assertEquals(2.2, $sum);
    }

    public function testSubtractValues(): void
    {
        $helper = new CurrencyHelper();

        $res = $helper->subtarctValues(2, '1.2');
        $this->assertEquals(0.8, $res);
    }
}
