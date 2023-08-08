<?php
include "BaseClass.php";

class ChildClass extends BaseClass {
    //Overriding
    function __construct($itemName = "", $price = 0, $stocks = 0)
    {
        parent::__construct($itemName, $price, $stocks);
    }

    public function processProtectedMethod() {
        $this->protectedMethod();
    }

}

$childClass = new ChildClass("Item 1", 30);
echo $childClass->getStocks();