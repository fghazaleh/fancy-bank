<?php namespace FancyBank\Transactions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 1:24 PM
 */

use FancyBank\Exceptions\InvalidArgsException;
use FancyBank\Exceptions\ZeroAmountException;
use FancyBank\Support\Traits\AmountValidationTrait;

abstract class BaseTransaction
{
    use AmountValidationTrait;
    /**
     * @var double;
     * */
    protected $amount;

    /**
     * @param double $amount ;
     * @throws InvalidArgsException
     * @throws ZeroAmountException
     */
    public function __construct(float $amount)
    {

        $this->validateAmount($amount);
        $this->amount = $amount;
    }
}
