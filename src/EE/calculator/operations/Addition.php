<?php


namespace EE\calculator\operations;

class Addition implements OperationInterface
{ 
    public function execute(array $numberArray): float
    {
        return array_sum($numberArray);
    } 
}