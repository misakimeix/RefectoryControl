<?php


Class LoginModel{

    private $id;
    private $nome;
    private $imagem;
    private $matricula;

    public function __Construct(){
        $this->id = 'id';
        $this->nome = 'nome';
        $this->imagem = 'img';
        $this->matricula = 'mat';
    }

    public function __set($name, $value){
        $this->$$name = $value;
    }

    public function __get($name){
        return $$name;
    }


}