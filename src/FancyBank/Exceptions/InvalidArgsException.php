<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 11:34 AM
 */

class InvalidArgsException extends BaseExceptions
{
    protected $errorCode = 100;
    protected $errorLabel = 'InvalidArgsException';
}
