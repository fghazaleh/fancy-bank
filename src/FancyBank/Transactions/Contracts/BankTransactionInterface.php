<?php namespace FancyBank\Transactions\Contracts;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:29 PM
 */

use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Exceptions\InvalidOverdraftFundsException;

interface BankTransactionInterface
{
    /**
     * @description : used to apply the transaction (Deposit, Withdraw, ..etc)
     * return the new bank account balance.
     * @param BackAccountInterface $bankAccount
     * @return double
     * @throws InvalidOverdraftFundsException
     */
    public function applyTransaction(BackAccountInterface $bankAccount):float;

    /**
     * @return string
     * */
    public function getTransactionInfo():string;

    /**
     * @return double;
     * */
    public function getAmount():float;
}
