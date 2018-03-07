<?php namespace FancyBank\Transactions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 11:30 AM
 */

use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction extends BaseTransaction implements BankTransactionInterface
{


    /**
     * @description : used to apply the transaction (Deposit, Withdraw, ..etc)
     * return the new bank account balance.
     * @param BackAccountInterface $bankAccount
     * @return double
     */
    public function applyTransaction(BackAccountInterface $bankAccount):float
    {
        return $bankAccount->balance() + $this->amount;
    }

    /**
     * @return string
     * */
    public function getTransactionInfo():string
    {
        return 'DEPOSIT_TRANSACTION';
    }

    /**
     * @return double;
     * */
    public function getAmount():float
    {
        return $this->amount;
    }
}
