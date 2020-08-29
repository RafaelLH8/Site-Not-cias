<?php

/**
*Classe comentário
*/
class Comentario{
    /**
    *@var int
    */
    private $id;
    /**
    *@var String
    */
    private $comentario;
    /**
    *@var date
    */
    private $data;
    /**
    *@var int
    */
    private $noticia;
    /**
    *@var int
    */
    private $usuario;

    /**
    *@param $id
    */
    public function setId($id){
        $this->id = $id;
    }

    /**
    *@return int
    */
    public function getId(){
        return $this->id;
    }

    /**
    *@param $comentario
    */
    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    /**
    *@return String
    */
    public function getComentario(){
        return $this->comentario;
    }

    /**
    *@param $data
    */
    public function setDatad($data){
        $this->data = $data;
    }

    /**
    *@return date
    */
    public function getData(){
        return $this->data;
    }

    /**
    *@param $noticia
    */
    public function setNoticia($noticia){
        $this->noticia = $noticia;
    }

    /**
    *@return String
    */
    public function getNoticia(){
        return $this->noticia;
    }

    /**
    *@param $usuario
    */
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    /**
    *@return mixed
    */
    public function getUsuario(){
        return $this->usuario;
    }

    /**
    *@param $idNoticia
    *mostra os comentários
    */
    public function listar($idNoticia = null){
        $conexao = Conexao::getInstance();
        $sql = 'SELECT id, comentario, (SELECT nome FROM usuario WHERE id_usuario = c.usuario) AS nome, (SELECT id_usuario FROM usuario WHERE id_usuario = c.usuario) AS id_usuario FROM comentario c WHERE noticia='.$idNoticia;
        $resultado = $conexao->query($sql);
        while ($com = $resultado->fetch(PDO::FETCH_OBJ)) {
            $comentarios[] = $com;
        }

        if (isset($comentarios)){
            return $comentarios;
        }
        else {
            return false;
        }
    }

    /**
    *Salva um comentário
    */
    public function salvar(){
        $descricao = $_POST['comment'];
        $idNoticia = $_POST['hid'];
        $idUsuario = $_SESSION['sessaoUs']->id_usuario;
        $conexao = Conexao::getInstance();
        $sql = 'INSERT INTO comentario (comentario, noticia, usuario) VALUES ("'.$descricao.'", '.$idNoticia.', '.$idUsuario.')';
        if($conexao->query($sql)){
          header('Location:'.HOME_URI.'noticia/ver/'.$idNoticia);
        }
    }

    /**
    *@param $id, $idNoticia
    *exclui um comentário
    */
    public function deletar($id){
        $conexao = Conexao::getInstance();
        $sql = 'DELETE FROM comentario WHERE id='.$id;
        $conexao->query($sql);
        header("Location:".HOME_URI."noticia/ver/");
    }

}
