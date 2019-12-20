<?php

Class dbModel{

    private $link;

    public function __Construct(){
        try{
            $this->link = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASS);
            return $this->link;
        } catch (PDOException $e) {
            echo "ERRO 500";
        }
    }
    
    public function link(){
        return $this->link;
    }

}