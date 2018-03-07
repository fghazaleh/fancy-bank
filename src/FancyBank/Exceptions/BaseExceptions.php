<?php namespace FancyBank\Exceptions;

/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/28/17
 * Time: 11:33 AM
 */

abstract class BaseExceptions extends \Exception
{
    protected $errorCode = 0;
    protected $errorLabel = 'BaseExceptions';
}
