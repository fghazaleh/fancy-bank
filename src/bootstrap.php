<?php
/**
 * Created by PhpStorm.
 * User: Ghazaleh
 * Date: 7/27/17
 * Time: 7:21 PM
 */

require_once __DIR__.'/../vendor/autoload.php';



/* [@tmp methods for testing only...]*/

function pl($mixed)
{
    echo "\n";
    echo $mixed;
    echo "\n";
}

function pr($mixed)
{
    echo "\n";
    print_r($mixed);
    echo "\n";
}

function vd($mixed)
{
    echo "\n";
    var_dump($mixed);
    echo "\n";
}
