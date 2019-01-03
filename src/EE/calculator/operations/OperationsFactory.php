<?php

namespace EE\calculator\operations;

use EE\calculator\Exceptions\OperationNotFoundException;

class OperationsFactory
{
    public static function getOperation(string $operation) : OperationInterface
    {
        switch ($operation) {

            case 'add':
            case 'addition':
            case 'plus':
                return new Addition();

            case 'mul':
            case 'multiplication':
            case 'product':
                return new Multiplication();

            case 'sub':
            case 'subtraction':
            case 'difference':
            case 'diff':
                return new Subtraction();

            case 'div':
            case 'divide':
            case 'division':
                return new Division();

            default:
                throw new OperationNotFoundException("Operation '$operation' not found");
        }
    }
}
