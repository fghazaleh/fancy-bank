<?php
use FancyBank\OverdraftStrategy\SilverOverdraft;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 2:05 PM
 */

class SilverOverdraftTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test;
     * @dataProvider newAmountsProvider
     * */
    public function test_is_grant_overdraft($newAmount,$expected){

        //Silver grant 100.00 overdraft funds.

        $overdraft = new SilverOverdraft();
        $this->assertEquals($expected,$overdraft->isGrantOverdraftFunds($newAmount));
    }

    /**
     * @return array;
     * */
    public function newAmountsProvider()
    {
        return [
            [50,true],
            [-50,true],
            [-100,true],
            [-101,false]
        ];
    }
}