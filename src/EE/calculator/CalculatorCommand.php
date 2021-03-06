<?php

// src/Command/CreateUserCommand.php
namespace EE\calculator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use EE\calculator\Exceptions\CalculatorException;
use EE\calculator\operations\OperationsFactory;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class CalculatorCommand extends Command
{
   
    //protected static $defaultName = 'app:create-user';

    protected function configure()
    {

        $this

            ->setName('calculate')
            ->setDescription('Runs calculator')
            ->addArgument('operator', InputArgument::REQUIRED, 'Enter the operator')
            ->addArgument('numbers', InputArgument::REQUIRED, 'Enter the numbers');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $operator = $input->getArgument('operator');

        $numbers = $input->getArgument('numbers');
        $numberArray = explode(',', $numbers);

        $fileSystem = new Filesystem();

        try {

            $logger = new Logger('Calculator_Operations');
            $logger2 = new Logger('Calculator_Operations_Errors');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/Loging.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());
            $logger2->pushHandler(new StreamHandler(__DIR__ . '/Loging_Errors.log', Logger::DEBUG));
            $logger2->pushHandler(new FirePHPHandler());


            $operation = OperationsFactory::getOperation($input->getArgument('operator'));

            if ($operation->isValid($numberArray)) {
                $output->writeln($operation->execute($numberArray));

                $logArray = array("Operation" => $operator, "Numbers" => $numbers, "Answer" => $operation->execute($numberArray) . PHP_EOL);
                $JSON = json_encode($logArray);

                $text = "";
                foreach ($logArray as $key => $value) {
                    $text .= $value . " ";
                }
                $fileSystem->appendToFile('logs.txt', $text);
                $logger->info($JSON);

            } else {
                echo "Please Enter valid Numeric values" . PHP_EOL;

                $logArray = array("Operation" => $operator, "Numbers" => $numbers, "Answer" => $operation->execute($numberArray) . PHP_EOL);
                $JSON = json_encode($logArray);

                $text = "";
                foreach ($logArray as $key => $value) {
                    $text .= $value . " ";
                }
                $fileSystem->appendToFile('log          _Errors.txt', $text);
                $logger2->info($JSON);

            }

        } catch (CalculatorException $e) {
            $output->writeln($e->getMessage());
        } catch (IOExceptionInterface $exception) {
            $output->writeln("An error occurred while creating your directory at " . $exception->getPath());
        }

    }
}
