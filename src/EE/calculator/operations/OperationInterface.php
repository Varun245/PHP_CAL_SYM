<?php
namespace EE\calculator\operations;




interface OperationInterface {

    public function execute(array $numberArray): float;

}