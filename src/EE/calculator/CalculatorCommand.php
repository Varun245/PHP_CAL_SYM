<?php

// src/Command/CreateUserCommand.php
namespace EE\calculator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use EE\calculator\Exceptions\CalculatorException;
use EE\calculator\operations\OperationsFactory;

class CalculatorCommand extends Command
{
   
    //protected static $defaultName = 'app:create-user';

    protected function configure()
    {
        
    $this
    
    ->setName('calculate')
    
    ->setDescription('Runs calculator')
            
    
    ->addArgument('operator',InputArgument::REQUIRED,'Enter the operator')
    ->addArgument('numbers',InputArgument::REQUIRED,'Enter the numbers')
    ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $operator=$input->getArgument('operator');
           
        $numbers=$input->getArgument('numbers');
        $numberArray = explode(',', $numbers);
        
        try{
            
        $operation=OperationsFactory::getOperation($input->getArgument('operator'));
        $output->writeln($operation->execute($numberArray));

        }catch(CalculatorException $e)
        {
         $output->writeln($e->getMessage());
        }

    }
}

