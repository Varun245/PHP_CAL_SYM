<?php

namespace EE\calculator\operations;

class Multiplication implements OperationInterface
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

        return array_product($numberArray);

    }
}
