<?php 
include "ItemService.php";

class ItemChildClass extends ItemService {
    public function settle() {
        echo "I was called as abstraction";
    }
}

$itemChildClass = new ItemChildClass();
$itemChildClass->settle();