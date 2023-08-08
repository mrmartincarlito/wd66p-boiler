<?php

interface IITems {
    function transactions($itemName, $qty);

    function adjustStocks($itemName, $qty, $movement);
}