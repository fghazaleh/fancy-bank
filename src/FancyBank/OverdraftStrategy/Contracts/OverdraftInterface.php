<?php namespace FancyBank\OverdraftStrategy\Contracts;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:44 PM
 */

interface OverdraftInterface
{

    /**
     * @description : Used to determine if overdraft granted or no, based on new bank balance.
     * @param double $newAmount;
     * @return boolean;
     * */
    public function isGrantOverdraftFunds(float $newAmount):bool;

    /**
     * @return double
     * */
    public function getOverdraftFundsAmount():float;
}
