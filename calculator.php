#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

use Symfony\Component\Console\Application;
use EE\calculator\CalculatorCommand;

$application = new Application();
$calculator=new CalculatorCommand();

$application->add($calculator);
$application->setDefaultCommand($calculator->getName(),true); 

$application->run();
