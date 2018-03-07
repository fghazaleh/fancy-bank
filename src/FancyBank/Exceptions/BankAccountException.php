<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 2:29 PM
 */

class BankAccountException extends BaseExceptions
{
    protected $errorCode = 500;
    protected $errorLabel = 'BankAccountException';
}
