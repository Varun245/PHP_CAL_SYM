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
            $logger = new Logger('Calaculator_Operations');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/Loging.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());
            

            $operation = OperationsFactory::getOperation($input->getArgument('operator'));
            $output->writeln($operation->execute($numberArray));
           

            $logArray = array("Operation"=>$operator, "Numbers"=>$numbers, "Answer"=>$operation->execute($numberArray).PHP_EOL);
            $JSON = json_encode($logArray);
            

           
            $text = "";
            foreach($logArray as $key => $value)
            {
                $text .= $key." : ".$value."\n";
            }
            $fileSystem->appendToFile('logs.txt',$text);
            $logger->info($JSON);
          


        } catch (CalculatorException $e) {
            $output->writeln($e->getMessage());
        }catch (IOExceptionInterface $exception)
        {
            $output->writeln("An error occurred while creating your directory at ".$exception->getPath());
        }

    }
}

