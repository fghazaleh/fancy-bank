<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 11:38 AM
 */

class ZeroAmountException extends BaseExceptions
{
    protected $errorCode = 101;
    protected $errorLabel = 'ZeroAmountException';
}
