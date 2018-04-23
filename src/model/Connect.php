<?php

class Connect{
    
    private $mysqli;
    private $host = "127.0.0.1";
    private $user = "gustavoferreira";
    private $password = "";
    private $bd = "Teste";
    
    public function __construct(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->bd);
        if ($this->mysqli->connect_errno) {
            echo "Falha no MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
    
    public function getConexao(){
        return $this->mysqli;
    }
    
}