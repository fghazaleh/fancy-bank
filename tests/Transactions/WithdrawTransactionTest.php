<?php
use FancyBank\OverdraftStrategy\Contracts\OverdraftInterface;
use FancyBank\OverdraftStrategy\NoOverdraft;
use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Transactions\WithdrawTransaction;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 1:47 PM
 */

class WithdrawTransactionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * */
    public function test_apply_transaction_more_than_balance()
    {
        $bankAccount = $this->getMockBuilder(BackAccountInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bankAccount
            ->expects($this->once())
            ->method('balance')
            ->willReturn(150);

        $amount = 50;
        $trans = new WithdrawTransaction($amount);
        $newBalance = $trans->applyTransaction($bankAccount);
        $this->assertEquals(100,$newBalance);
    }
    /**
     * @test
     * @expectedException FancyBank\Exceptions\InvalidOverdraftFundsException
     * */
    public function test_apply_transaction_less_than_zero_with_no_overdraft_balance()
    {
        $bankAccount = $this->getMockBuilder(BackAccountInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $bankAccount
            ->expects($this->once())
            ->method('getOverdraft')
            ->willReturn(new NoOverdraft());
        $bankAccount
            ->expects($this->once())
            ->method('balance')
            ->willReturn(120);

        $amount = 150;
        $trans = new WithdrawTransaction($amount);
        $newBalance = $trans->applyTransaction($bankAccount);
        $this->assertEquals(100,$newBalance);
    }
    /**
     * @test
     * */
    public function test_apply_transaction_less_than_zero_with_overdraft_balance()
    {
        $bankAccount = $this->getMockBuilder(BackAccountInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        //Create a mock of Overdraft class.
        $overdraft = $this->getMockBuilder(OverdraftInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $overdraft->expects($this->once())
                    ->method('isGrantOverdraftFunds')
                    ->willReturn(true);

        $bankAccount
            ->expects($this->once())
            ->method('getOverdraft')
            ->willReturn($overdraft);
        $bankAccount
            ->expects($this->once())
            ->method('balance')
            ->willReturn(100);

        $amount = 250;
        $trans = new WithdrawTransaction($amount);
        $newBalance = $trans->applyTransaction($bankAccount);
        $this->assertEquals(-150,$newBalance);
    }
    /**
     * @test
     * @dataProvider invalidAmountProvider
     * @expectedException FancyBank\Exceptions\InvalidArgsException
     * */
    public function test_invalid_amount($amount)
    {
        new WithdrawTransaction($amount);
    }

    /**
     * @test
     * @dataProvider invalidAmountForZeroOrLessProvider
     * @expectedException FancyBank\Exceptions\ZeroAmountException
     * */
    public function test_amount_less_than_zero($amount)
    {
        new WithdrawTransaction($amount);
    }
    /**
     * @test
     * */
    public function test_transaction_info()
    {
        $trans = new WithdrawTransaction(22.0);
        $this->assertEquals('WITHDRAW_TRANSACTION',$trans->getTransactionInfo());
    }
    /**
     * @test
     * */
    public function test_get_amount(){
        $trans = new WithdrawTransaction(100.25);
        $this->assertEquals(100.25,$trans->getAmount());
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