<?php


namespace EE\calculator\operations;

class Multiplication implements OperationInterface
{


    public function execute(array $numberArray) : float
    {

        return array_product($numberArray);

    }
}