<?php


namespace EE\calculator\operations;

class Division implements OperationInterface
{
    public function isValid(array $numberArray) : bool
    {
        $var = count($numberArray);
        $count = 0;
        foreach ($numberArray as $num) {
            if (is_numeric($num)) {
                $count++;
            }
        }
        if ($count === $var) {
            return true;
        } else {
            return false;
        }

    }
    
    public function execute(array $numberArray) : float
    {

        $count = count($numberArray);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {
                $div = $numberArray[$i];
            } else {
                $div = $div / $numberArray[$i];
            }
        }
        return $div;
    }
}
