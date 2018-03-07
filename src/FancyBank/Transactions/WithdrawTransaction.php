<?php namespace FancyBank\Transactions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 1:22 PM
 */

use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Exceptions\InvalidOverdraftFundsException;
use FancyBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction extends BaseTransaction implements BankTransactionInterface
{

    /**
     * @description : used to apply the transaction (Deposit, Withdraw, ..etc) return the new bank account balance.
     * @param BackAccountInterface $bankAccount
     * @return float
     * @throws InvalidOverdraftFundsException
     */
    public function applyTransaction(BackAccountInterface $bankAccount):float
    {
        $newBalance = $bankAccount->balance() - $this->amount;
        if ($this->isGrantOverdraftFunds($bankAccount, $newBalance)) {
            throw new InvalidOverdraftFundsException('Your withdraw has reach the max overdraft funds.');
        }

        return $newBalance;
    }

    /**
     * @return string
     * */
    public function getTransactionInfo():string
    {
        return 'WITHDRAW_TRANSACTION';
    }

    /**
     * @return double;
     * */
    public function getAmount():float
    {
        return $this->amount;
    }

    private function isGrantOverdraftFunds(BackAccountInterface $bankAccount, float $newBalance):bool
    {
        return ($newBalance < 0 && !$bankAccount
                ->getOverdraft()
                ->isGrantOverdraftFunds($newBalance));

        // Apply low of Demeter, Tell, Don't ask Law.
        // To stop the long chain, define a method in BankAccount class

        //return ($newBalance < 0 && !$bankAccount
        //        ->isGrantOverdraftFunds($newBalance));
    }
}
