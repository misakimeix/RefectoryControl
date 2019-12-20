<?php 

include_once 'model/LoginModel.php';
include_once 'model/dbModel.php';

define('HOST', 'localhost');
define('DB', 'rfc');
define('USER', 'root');
define('PASS', '');

Class loginController{


    private $login;
    private $link;

    public function __Construct(){
        $this->login = new LoginModel();
        $this->link = new dbModel();
    }

    public function debug(){
        @$_SESSION['user'] = $_POST['username'];
        @$_SESSION['pass'] = $_POST['password'];
        echo var_dump($_SESSION);
    }

    public function login($u, $p, $parse = 16){
        for ($i=0; $i < $parse; $i++) { 
            $p = md5($p);
        }
        $link = $this->link->link();
        $sql = 'SELECT `idaluno`, `matricula`, `nome`, `senha`, `imagem`, `condicao` FROM `aluno` WHERE `matricula`= :u AND `senha`=:p';
        $smtp = $link->prepare($sql);
        $smtp->bindvalue(':u', $u, PDO::PARAM_STR);
        $smtp->bindValue(':p', $p, PDO::PARAM_STR);
        $smtp->execute();

        $smtp = $link->query($sql);
        while ($linha = $smtp->fetch(PDO::FETCH_ASSOC)) {
            if (!verify()){ session_start();}
            $_SESSION['idaluno'] = $linha['idaluno'];
            $_SESSION['matricula'] = $linha['matricula'];
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['imagem'] = $linha['imagem'];
        }
    }
    
    public function logout(){
        $_SESSION['idaluno'] = null;
        $_SESSION['user'] = null;
        $_SESSION['pass'] = md5(rand(10, 99));
        $_SESSION['imagem'] = null;
        return session_destroy();
    }
    
    public function verify(){
        if (empty(var_dump($_SESSION))){ 
            return false; 
        } else{ 
            return true;
        }
    }
    
    





}