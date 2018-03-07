<?php
/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 11:41 AM
 */

use FancyBank\Bank\Contracts\BackAccountInterface;
use FancyBank\Transactions\DepositTransaction;

class DepositTransactionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * */
    public function test_apply_transaction()
    {
        $bankAccount = $this->getMockBuilder(BackAccountInterface::class)
                            ->disableOriginalConstructor()
                            ->getMock();

        $bankAccount
            ->expects($this->once())
            ->method('balance')
            ->willReturn(75);

        $amount = 25;
        $trans = new DepositTransaction($amount);
        $newBalance = $trans->applyTransaction($bankAccount);
        $this->assertEquals(100,$newBalance);
    }
    /**
     * @test
     * @dataProvider invalidAmountProvider
     * @expectedException FancyBank\Exceptions\InvalidArgsException
     * */
    public function test_invalid_amount($amount)
    {
        new DepositTransaction($amount);
    }

    /**
     * @test
     * @dataProvider invalidAmountForZeroOrLessProvider
     * @expectedException FancyBank\Exceptions\ZeroAmountException
     * */
    public function test_amount_less_than_zero($amount)
    {
        new DepositTransaction($amount);
    }
    /**
     * @test
     * */
    public function test_transaction_info()
    {
        $trans = new DepositTransaction(22.0);
        $this->assertEquals('DEPOSIT_TRANSACTION',$trans->getTransactionInfo());
    }
    /**
     * @test
     * */
    public function test_get_amount(){
        $trans = new DepositTransaction(100.25);
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