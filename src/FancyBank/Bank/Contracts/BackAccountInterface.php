<?php namespace FancyBank\Bank\Contracts;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:26 PM
 */

use FancyBank\Exceptions\BankAccountException;
use FancyBank\Exceptions\FailedTransactionException;
use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;
use FancyBank\Transactions\Contracts\BankTransactionInterface;

interface BackAccountInterface
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';

    /**
     * @description: Used to apply the bank account transactions (Deposit, Withdraw, ...ect);
     * @param BankTransactionInterface $bankTransaction
     * @throws BankAccountException
     * @throws FailedTransactionException
     * @return void
     */
    public function transaction(BankTransactionInterface $bankTransaction):void;

    /**
     * @description : Used to re-open the closed bank account.
     * @return void
     * */
    public function reopenAccount():void;

    /**
     * @description : Used to close the bank account.
     * @return void
     * */
    public function closeAccount():void;

    /**
     * @description : Used to return the account balance.
     * @return double
     * */
    public function balance():float;

    /**
     * @description : Used to apply overdraft strategy.
     * @param OverdraftInterface $overdraft
     * @return void;
     */
    public function applyOverdraft(OverdraftInterface $overdraft):void;

    /**
     * @description : Used to return Overdraft strategy object.
     * @return OverdraftInterface;
     */
    public function getOverdraft():OverdraftInterface;

    /**
     * @return boolean;
     * */
    public function accountOpened():bool;
}
