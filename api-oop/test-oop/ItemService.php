<?php
include "ISample.php";

abstract class ItemService implements IITems {

    //overloading
    public function transactions($itemName, $qty) {
        echo "------------------------------- <br/>";
        echo "ITEM        QTY          PRICE <br/>";
        echo "$itemName   $qty         Php000 <br/>";
    }

    public function adjustStocks($itemName, $qty, $movement) {
        echo "New stocks has been adjusted <br/>";
    }

    public function settle() {
        //query floating transactions
        $this->adjustStocks("Item1", 2, "-");
    }
}

// $itemService = new ItemService();

// $itemService->transactions("Item 1", 3);
// $itemService->transactions("Item2" , 50);
// $itemService->transactions("Item3" , 50);
// $itemService->transactions("Item4" , 50);
// $itemService->transactions("Item5" , 50);
// $itemService->transactions("Item6" , 50);

// $itemService->settle();