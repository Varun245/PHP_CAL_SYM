<?php


namespace EE\calculator\operations;

class Subtraction implements OperationInterface
{
 
    public function execute(array $numberArray) : float
    {
        
        $count = count($numberArray);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {
                $sub = $numberArray[$i];
            } else {
                $sub = $sub - $numberArray[$i];
            }
        }
        return $sub;
        
      
        
    }
}