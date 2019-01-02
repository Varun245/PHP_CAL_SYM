<?php
namespace EE\calculator\operations;




interface OperationInterface 
{

    //public function Isvalid(array $numberArray):bool;
    public function execute(array $numberArray): float;
    
}