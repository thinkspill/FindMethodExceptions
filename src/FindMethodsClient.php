<?php

require_once '../vendor/autoload.php';

$FindMethodExceptions = new \thinkspill\FindMethodExceptions();
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions');
$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsOneException');
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsOneExceptionWithBraces');
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsTwoExceptions');
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsTwoExceptionsOnOneLine');
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsThreeExceptionsOnOneLine');
//$found = $FindMethodExceptions->find('\thinkspill\Example\MethodsWithExceptions', 'throwsSixExceptionsOnTwoLines');
//$found = $FindMethodExceptions->find('\phpDocumentor\Reflection\DockBlock');
//$found = $FindMethodExceptions->find('\Composer\Autoload\ClassLoader');
//$e->findExceptions('\Composer\Autoload\ClassLoader');

var_dump($found);