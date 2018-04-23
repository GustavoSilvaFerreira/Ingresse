<?php

class Usuario{
    /*
        CREATE TABLE Usuarios (cd_Usuario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                     nm_Usuario VARCHAR (50) NOT NULL,
                     ds_Email VARCHAR (50) NOT NULL;*/
    protected $id, $nome,$email;
    
    public function __construct($id=0, $nome,$email){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
}

?>