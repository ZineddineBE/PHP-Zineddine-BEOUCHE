<?php

class Product{
    public $name;
    public $description;
    public $price;
    public $stock;

    public function __construct($name, $description, $price, $stock) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function displayProduct(){
        echo "Nom : " . $this->name . "<br>" .
             "Description : " . $this->description . "<br>" .
             "Prix : " . $this->price . "€<br>" .
             "Stock : " . $this->stock . " exemplaires<br><br>";
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;

        return $this;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;

        return $this;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;

        return $this;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;

        return $this;
    }

    public function addStock($stockAdded){
        $this->stock += $stockAdded;
    }

    public function removeStock($stockRemoved){
        if($this->stock < $stockRemoved){
            echo "Le stock ne peut pas être négatif";
        }else{
            $this->stock -= $stockRemoved;
        }
        return $this->stock;
    }
}