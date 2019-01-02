<?php


namespace EE\calculator\operations;

class Division implements OperationInterface
{
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