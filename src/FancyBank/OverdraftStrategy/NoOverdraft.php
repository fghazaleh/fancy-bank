<?php namespace FancyBank\OverdraftStrategy;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 12:27 PM
 */

use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;

class NoOverdraft implements OverdraftInterface
{

    /**
     * @description : Used to determine if overdraft granted or no based on new bank balance.
     * @param double $newAmount ;
     * @return boolean;
     * */
    public function isGrantOverdraftFunds(float $newAmount):bool
    {
        return false;
    }

    /**
     * @return double
     * */
    public function getOverdraftFundsAmount():float
    {
        return 0.0;
    }
}
