<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 1:31 PM
 */

class InvalidOverdraftFundsException extends BaseExceptions
{
    protected $errorCode = 200;
    protected $errorLabel = 'InvalidOverdraftFundsException';
}
