<?php namespace FancyBank\Bank;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:25 PM
 */

use FancyBank\Exceptions\BankAccountException;
use FancyBank\Exceptions\InvalidArgsException;
use FancyBank\Exceptions\ZeroAmountException;
use FancyBank\OverdraftStrategy\NoOverdraft;
use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Exceptions\FailedTransactionException;
use FancyBank\Exceptions\InvalidOverdraftFundsException;
use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;
use FancyBank\Support\Traits\AmountValidationTrait;
use FancyBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount implements BackAccountInterface
{
    use AmountValidationTrait;
    /**
     * @var double;
     * */
    private $balance;

    private $accountStatus;

    private $overdraft;

    /**
     * @param float $newBalance ;
     * @throws InvalidArgsException
     * @throws ZeroAmountException
     */
    public function __construct(float $newBalance = 0.0)
    {
        $this->validateAmount($newBalance);
        $this->updateBalance($newBalance);
        $this->accountStatus = BackAccountInterface::STATUS_OPEN;
        $this->overdraft = new NoOverdraft();
    }

    /**
     * @description: Used to apply the bank account transactions (Deposit, Withdraw, ...ect);
     * @param BankTransactionInterface $bankTransaction
     * @throws BankAccountException
     * @throws FailedTransactionException
     */
    public function transaction(BankTransactionInterface $bankTransaction):void
    {
        if (!$this->accountOpened()) {
            throw new BankAccountException('Bank account should be opened.');
        }
        try {
            $newBalance = $bankTransaction->applyTransaction($this);
            $this->updateBalance($newBalance);
        } catch (InvalidOverdraftFundsException $e) {
            throw new FailedTransactionException($e->getMessage());
        }
    }

    /**
     * @description : Used to re-open the closed bank account.
     * @throws BankAccountException
     */
    public function reopenAccount():void
    {
        if ($this->accountOpened()) {
            throw new BankAccountException('Bank account already opened.');
        }
        $this->accountStatus = BackAccountInterface::STATUS_OPEN;
    }

    /**
     * @description : Used to close the bank account.
     * @throws BankAccountException
     */
    public function closeAccount():void
    {
        if (!$this->accountOpened()) {
            throw new BankAccountException('Bank account already closed.');
        }
        $this->accountStatus = BackAccountInterface::STATUS_CLOSED;
    }

    /**
     * @description : Used to return the account balance.
     * @return double
     * */
    public function balance():float
    {
        return $this->balance;
    }

    /**
     * @description : Used to apply overdraft strategy.
     * @param OverdraftInterface $overdraft
     * @return void;
     */
    public function applyOverdraft(OverdraftInterface $overdraft):void
    {
        $this->overdraft = $overdraft;
    }

    /**
     * @description : Used to return Overdraft strategy object.
     * @return OverdraftInterface;
     */
    public function getOverdraft():OverdraftInterface
    {
        return $this->overdraft;
    }

    /**
     * @return boolean;
     * */
    public function accountOpened():bool
    {
        return ($this->accountStatus === BackAccountInterface::STATUS_OPEN);
    }

    /**
     * Used only to show how Tell, Don't ask law works if there is a long chain.
     * PS: This this example, I don't recommend
     * */
    //public function isGrantOverdraftFunds(float $newAmount):bool
    //{
    //    return $this->overdraft->isGrantOverdraftFunds($newAmount);
    //}

    /**
     * @param float $newBalance ;
     * @return void;
     * */
    protected function updateBalance(float $newBalance):void
    {
        $this->balance = $newBalance;
    }
}
