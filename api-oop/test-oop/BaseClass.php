<?php

class BaseClass {
    private $itemName;
    private $price;
    private $stocks;

    function __construct($itemName, $price, $stocks) {
        $this->setItemName($itemName);
        $this->setPrice($price);
        $this->setStocks($stocks);
    }

    /**
     * Get the value of stocks
     */ 
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Set the value of stocks
     *
     * @return  self
     */ 
    public function setStocks($stocks)
    {
        $this->stocks = $stocks;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of itemName
     */ 
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set the value of itemName
     *
     * @return  self
     */ 
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    private function privateMethod() {
        echo "I am private";
    }

    protected function protectedMethod() {
        $this->privateMethod();
    }
}


$baseClass = new BaseClass("Item 2", 200, 10);

// $baseClass->setItemName("Item 1");
// $baseClass->setPrice(200);
// $baseClass->setStocks(10);

echo $baseClass->getItemName();