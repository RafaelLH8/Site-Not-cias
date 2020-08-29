<?php
/**
*Classe Notícia, parte de um aplicativo desenvolvido em aula
*@version 1.0
*@author Rafael Linden Henrichs
*@access public
*@copyright 2020, CIMOL - INFO63B
*/
class Noticia{
    /**
    *@var int
    */
    private $id;
    /**
    *@var String
    */
    private $titulo;
    /**
    *@var String
    */
    private $descricao;
    /**
    *@var String
    */
    private $comentarios;
    /**
    *@var date
    */
    private $data;
    /**
    *@var String
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
    *@param $titulo
    */
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    /**
    *@return String
    */
    public function getTitulo(){
        return $this->titulo;
    }
    /**
    *@param $descricao
    */
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    /**
    *@return String
    */
    public function getDescricao(){
        return $this->descricao;
    }
    /**
    *@param $comentarios
    */
    public function setComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
    /**
    *@return String
    */
    public function getComentarios(){
        return $this->comentarios;
    }
    /**
    *@param $data
    */
    public function setData($data){
        $this->data = $data;
    }
    /**
    *@return date
    */
    public function getData(){
        return $this->data;
    }
    /**
    *@param $usuario
    */
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    /**
    *@return String
    */
    public function getUsuario(){
        return $this->usuario;
    }

    public function novaNoticia(){
      include HOME_DIR."view/paginas/noticias/novaNoticia.php";
    }
    /**
    *@param $id, mostra uma notícia em detalhe
    */
    public function ver($id){
        $conexao = Conexao::getInstance();
        $sql = "SELECT id, titulo, descricao, DATE_FORMAT(data, '%d/%m/%Y') AS data,
        (SELECT nome FROM usuario WHERE id_usuario=noticia.usuario) AS nome_usuario
        FROM noticia
        WHERE id=".$id;
        $resultado = $conexao->query($sql);
        $noticia = $resultado->fetch(PDO::FETCH_OBJ);
        include "Comentario.php";
        $comentario = new Comentario();
        $noticia->comentario = $comentario->listar($id);
        include HOME_DIR."view/paginas/noticias/noticia.php";
    }

    /**
    *Função simples que somente chama a função listar (e o formulário de nova notícia caso o usuário esteja logado)
    */
    public function index(){
      if(isset($_SESSION['sessaoUs'])){
        $this->novaNoticia();
      }
      $this->listar();
    }

    /**
    *Função que lista as notícias, chamada pela função acima
    */
    public function listar(){
        $conexao = Conexao::getInstance();
        $sql = "SELECT id, titulo, descricao, DATE_FORMAT(data, '%d/%m/%Y') AS data,
        (SELECT nome FROM usuario WHERE id_usuario=noticia.usuario) AS nome_usuario FROM noticia
        ORDER BY id DESC LIMIT 5";
        $resultado = $conexao->query($sql);
        $noticias = null;
        while($noticia = $resultado->fetch(PDO::FETCH_OBJ)){
            $noticias[] = $noticia;
        }
        include HOME_DIR."view/paginas/noticias/noticias.php";
    }

    /**
    *Salva uma notícia
    */
    public function salvar(){
      $titulo = $_POST['title'];
      $noticia = $_POST['not'];
      $date = date('Y/m/d H:i:s');
      $usuario = $_SESSION['sessaoUs']->id_usuario;
      $conexao = Conexao::getInstance();
      $sql = 'INSERT INTO noticia (titulo, descricao, data, usuario) VALUES ("'.$titulo.'", "'.$noticia.'", "'.$date.'", "'.$usuario.'")';
      $conexao->query($sql);
      $this->listar();
    }
    /**
    *@param $id, deleta uma notícia
    */
    public function deletar($id){
      $conexao = Conexao::getInstance();
      $sql = 'DELETE FROM noticia WHERE id='.$id;
      $conexao->query($sql);
      $this->listar();
    }
}
?>
