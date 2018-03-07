<?php namespace FancyBank\OverdraftStrategy;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 1:39 PM
 */
use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;

/**
 * @description: Grant 100.00 overdraft funds.
 * */
class SilverOverdraft implements OverdraftInterface
{

    /**
     * @description : Used to determine if overdraft granted or no based on new bank balance.
     * @param double $newAmount ;
     * @return boolean;
     * */
    public function isGrantOverdraftFunds(float $newAmount):bool
    {
        return ($this->getOverdraftFundsAmount() + $newAmount) >= 0;
    }

    /**
     * @return double
     * */
    public function getOverdraftFundsAmount():float
    {
        return 100.00;
    }
}
