<?php namespace FancyBank\Support\Traits;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 2:35 PM
 */

use FancyBank\Exceptions\InvalidArgsException;
use FancyBank\Exceptions\ZeroAmountException;

trait AmountValidationTrait
{
    /**
     * @param float $amount
     * @throws InvalidArgsException
     * @throws ZeroAmountException
     */
    public function validateAmount(float $amount):void
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgsException('Invalid inserted value, the amount should be a numeric.');
        }
        if ($amount <= 0) {
            throw new ZeroAmountException('The amount should be more than zero for this transaction.');
        }
    }
}
