<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 2:20 PM
 */

class FailedTransactionException extends BaseExceptions
{
    protected $errorCode = 401;
    protected $errorLabel = 'FailedTransactionException';
}
