<?php

class UsuarioDAO{
    
    private $conexao;
    
    public function __construct(){
        require_once "Connect.php";
        $this->conexao = new Connect();
    }
    
    //Listar usuarios
    public function getUsuarios(){
        $mysqli = $this->conexao->getConexao();
        $stmt = $mysqli->query("SELECT * FROM Usuarios");
        $row = $stmt->fetch_all();
        $u = [];
        foreach($row as $usuario){
            $u[] = new Usuario($usuario[0],$usuario[1],$usuario[2]);
        }
        $stmt->close();
        return $u;
    }
    
    // Buscar Usuario por id
    public function getUsuarioById($id){
        $mysqli = $this->conexao->getConexao();
        $stmt = $mysqli->prepare("SELECT * FROM Usuarios WHERE cd_Usuario=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($id,$nome,$email);
        $stmt->fetch();
        $u = new Usuario($id,$nome,$email);
        $stmt->close();
        return $u;
    }
    
    // Insere usuario e retorna id
    public function insertUsuario(Usuario $u){
        $mysqli = $this->conexao->getConexao();
        $stmt = $mysqli->prepare("INSERT INTO Usuarios(nm_Usuario,ds_Email) VALUES(?,?)");
        $stmt->bind_param("ss",$u->getNome(),$u->getEmail());
        
        if (!$stmt->execute()) {
            echo "Erro: (" . $stmt->errno . ") " . $stmt->error . "<br>";
        }
        $retornoId = mysqli_insert_id($mysqli);
        $stmt->close();
        
        return $retornoId;
    }
    
    // Alterar usuario
    public function alterarUsuario(Usuario $u){
        $mysqli = $this->conexao->getConexao();
        $stmt = $mysqli->prepare("UPDATE Usuarios SET nm_Usuario=?, ds_Email=? WHERE cd_Usuario=?");
        $stmt->bind_param("ssi",$u->getNome(),$u->getEmail(),$u->getId());
        if (!$stmt->execute()) {
            echo "Erro: (" . $stmt->errno . ") " . $stmt->error . "<br>";
        }
        if(mysqli_stmt_affected_rows($stmt) > 0){
            $retorno = true;
        }else{
            $retorno = false;   
        }
        $stmt->close();
        return $retorno;
    }
    
    // Deleta usuario
    public function deletarUsuario($id){
        $mysqli = $this->conexao->getConexao();
        $stmt = $mysqli->prepare("DELETE FROM Usuarios WHERE cd_Usuario=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        if(mysqli_stmt_affected_rows($stmt) > 0){
            $retorno = true;
        }else{
            $retorno = false;   
        }
        $stmt->close();
        return $retorno;
    }
    
}

?>