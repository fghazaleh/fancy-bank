<?php
/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:24 PM
 */

use FancyBank\Bank\BankAccount;
use FancyBank\OverdraftStrategy\SilverOverdraft;
use FancyBank\Transactions\DepositTransaction;
use FancyBank\Transactions\WithdrawTransaction;
use FancyBank\Exceptions\BankAccountException;
use FancyBank\Exceptions\FailedTransactionException;

require_once 'bootstrap.php';


//---[Bank account 1]---/
pl('--------- [Start testing bank account #1, No overdraft] --------');
$bankAccount1 = new BankAccount(500.0);
pl('My balance : '.$bankAccount1->balance());
$bankAccount1->closeAccount();
$bankAccount1->reopenAccount();
$bankAccount1->transaction(new DepositTransaction(150.0));
pl('My new balance after deposit (150) : '.$bankAccount1->balance());
$bankAccount1->transaction(new WithdrawTransaction(300.0));
pl('My new balance after withdrawal (300) : '.$bankAccount1->balance());
try {
    $bankAccount1->transaction(new WithdrawTransaction(400.0));
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : '.$bankAccount1->balance());

$bankAccount1->closeAccount();


//---[Bank account 2]---/
pl('--------- [Start testing bank account #2, Silver overdraft (100.0 funds)] --------');
$bankAccount2 = new BankAccount(200.0);
$bankAccount2->applyOverdraft(new SilverOverdraft());
pl('My balance : '.$bankAccount2->balance());

$bankAccount2->transaction(new DepositTransaction(100.0));
pl('My new balance after deposit (100) : '.$bankAccount2->balance());
$bankAccount2->transaction(new WithdrawTransaction(300.0));
pl('My new balance after withdrawal (300) : '.$bankAccount2->balance());
$bankAccount2->transaction(new WithdrawTransaction(50.0));
pl('My new balance after withdrawal (50) with funds : '.$bankAccount2->balance());
try {
    $bankAccount2->transaction(new WithdrawTransaction(120.0));
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : '.$bankAccount2->balance());

$bankAccount2->transaction(new WithdrawTransaction(20.0));
pl('My new balance after withdrawal (20) with funds : '.$bankAccount2->balance());
$bankAccount2->closeAccount();
try {
    $bankAccount2->closeAccount();
} catch (BankAccountException $e) {
    pl($e->getMessage());
}
