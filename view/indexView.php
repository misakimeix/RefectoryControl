<?php 
include_once 'controller/loginController.php';


Class indexView{

    public $control;

    function __Construct(){
        $this->$control = new loginController();
    }



}