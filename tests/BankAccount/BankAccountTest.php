<?php
/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 2:33 PM
 */

use FancyBank\Bank\BankAccount;
use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;
use FancyBank\Transactions\DepositTransaction;
use FancyBank\Transactions\WithdrawTransaction;

class BankAccountTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * */
    public function open_bank_account_with_balance()
    {
        $bankAccount = new BankAccount(200);
        $this->assertEquals(200,$bankAccount->balance());
        $this->assertTrue($bankAccount->accountOpened());
    }

    /**
     * @ test
     * @dataProvider invalidAmountProvider
     * @ expectedException FancyBank\Exceptions\InvalidArgsException
     * */
   /* public function open_bank_account_with_invalid_balance($balance)
    {
        $this->expectException(\TypeError::class);
        new BankAccount($balance);
    }*/
    /**
     * @test
     * @dataProvider invalidAmountForZeroOrLessProvider
     * @expectedException FancyBank\Exceptions\ZeroAmountException
     * */
    public function open_bank_account_with_zero_or_less_balance($balance)
    {
        new BankAccount($balance);
    }

    /**
     * @test
     * */
    public function test_deposit_transaction(){
        $bankAccount = new BankAccount(200.0);
        $bankAccount->transaction(new DepositTransaction(30.0));
        $this->assertEquals(230.0,$bankAccount->balance());

    }
    /**
     * @test
     * */
    public function test_valid_withdraw_transaction_no_overdraft()
    {
        $bankAccount = new BankAccount(200.0);
        $bankAccount->transaction(new WithdrawTransaction(150.0));
        $this->assertEquals(50.0,$bankAccount->balance());
    }
    /**
     * @test
     * @expectedException FancyBank\Exceptions\FailedTransactionException
     * */
    public function invalid_withdraw_transaction_no_overdraft()
    {
        $bankAccount = new BankAccount(200.0);
        $bankAccount->transaction(new WithdrawTransaction(200.10));
    }

    /**
     * @test
     * */
    public function valid_withdraw_transaction_with_overdraft()
    {
        $overdraft = $this->getMockBuilder(OverdraftInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $overdraft
            ->expects($this->once())
            ->method('isGrantOverdraftFunds')
            ->willReturn(true);

        $bankAccount = new BankAccount(250.0);
        $bankAccount->applyOverdraft($overdraft);
        $bankAccount->transaction(new WithdrawTransaction(300.0));
        $this->assertEquals(-50.0,$bankAccount->balance());
    }

    /**
     * @test
     * @expectedException FancyBank\Exceptions\FailedTransactionException
     * */
    public function invalid_withdraw_transaction_with_overdraft()
    {
        $overdraft = $this->getMockBuilder(OverdraftInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $overdraft
            ->expects($this->once())
            ->method('isGrantOverdraftFunds')
            ->willReturn(false);

        $bankAccount = new BankAccount(200.0);
        $bankAccount->applyOverdraft($overdraft);
        $bankAccount->transaction(new WithdrawTransaction(300.0));
        $this->assertEquals(-50.0,$bankAccount->balance());
    }

    /**
     * @return array;
     * */
    public function invalidAmountProvider()
    {
        return [
            ['abc'],
            [null],
            [false],
            ['1.2b']
        ];
    }
    /**
     * @return array;
     * */
    public function invalidAmountForZeroOrLessProvider()
    {
        return [
            [-1],
            [0]
        ];
    }
}