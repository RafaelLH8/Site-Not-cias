<?php
class Usuario{
    /**
    *@var int
    */
    private $id;
    /**
    *@var String
    */
    private $nome;
    /**
    *@var String
    */
    private $email;
    /**
    *@var String
    */
    private $senha;

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
    *@param $nome
    */
    public function setNome($nome){
        $this->nome = $nome;
    }
    /**
    *@return String
    */
    public function getNome(){
        return $this->nome;
    }
    /**
    *@param $email
    */
    public function setEmail($email){
        $this->email = $email;
    }
    /**
    *@return String
    */
    public function getEmail(){
        return $this->email;
    }
    /**
    *@param $senha
    */
    public function setSenha($senha){
        $this->senha = $senha;
    }
    /**
    *@return String
    */
    public function getSenha(){
        return $this->senha;
    }

    /**
    *Função de redirecionamento
    */
    public function criar(){
        include HOME_DIR."view/paginas/usuarios/form_usuario.php";
    }

    /**
    *Função de redirecionamento
    */
    public function listar(){
        include HOME_DIR."view/paginas/usuarios/listar.php";
    }

    /**
    *Chama a função login() se o usuário não estiver logado, e a lista de usuários caso contrário
    */
    public function index(){
        if(isset($_SESSION['sessaoUs'])){
          $this->listar();
        }
        else{
          $this->login();
          $this->cadastro();
        }
    }

    /**
    *Salva o usuário no banco de dados
    */
    public function salvar(){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5('usuario');
        $vez = '0';
        $conexao = Conexao::getInstance();
        $sql = 'INSERT INTO usuario (nome, email, senha, vez) VALUES ("'.$nome.'", "'.$email.'","'.$senha.'", "'.$vez.'")';
        $resultado = $conexao->query($sql);
        echo "<script>alert('Sua senha é usuario. Faça login imediatamente para mudá-la.');</script>";
    }
    /**
    *@param $id
    */
    public function exibir($id){
        echo "O id do usuario é".$id;
    }

    public function login(){
        include HOME_DIR."view/paginas/usuarios/login.php";
    }

    public function cadastro(){
        include HOME_DIR."view/paginas/usuarios/form_usuario.php";
    }

    public function trocarSenha(){
        include HOME_DIR."view/paginas/usuarios/trocarSenha.php";
    }
    /**
    *Autentica os dados do usuário
    */
    public function autenticar(){
        $email = $_POST['em'];
        $senha = $_POST['tbmfos'];
        $conexao = Conexao::getInstance();
        $sql = 'SELECT senha FROM usuario WHERE email = "'.$email.'"';
        $resultado = $conexao->query($sql);
        $senhaUsuario = $resultado->fetch(PDO::FETCH_OBJ);
        if(!$senhaUsuario){
          $this->login();
        }
        else{
          if($senhaUsuario->senha === md5($senha)){
            $sqlS = 'SELECT * FROM usuario WHERE email = "'.$email.'"';
            $resultadoS = $conexao->query($sqlS);
            $_SESSION['sessaoUs'] = $resultadoS->fetch(PDO::FETCH_OBJ);
            if($_SESSION['sessaoUs']->vez == 0){
              $this->trocarSenha();
            }
            else{
              header('Location:'.HOME_URI);
            }
          }
          else{
            echo "<script> alert('Email e/ou senha incorretos'); </script>";
          }
        }
    }
    /**
    *encerra a sessão do usuário
    */
    public function logout(){
        session_destroy();
        header('Location:'.HOME_URI);
    }
    /**
    *deleta o usuário
    */
    public function deletar($id){
        $conexao = Conexao::getInstance();
        $sql = 'DELETE FROM usuario WHERE id_usuario = '.$id;
        $conexao->query($sql);
        $this->listar();
    }

    /**
    *troca a senha padrão
    */
    public function troca(){
        $novaSenha = $_POST['tbmtbmfos'];
        $conexao = Conexao::getInstance();
        $sql = 'UPDATE usuario SET vez = 1, senha = "'.md5($novaSenha).'" WHERE id_usuario = '.$_SESSION['sessaoUs']->id_usuario;
        $conexao->query($sql);
        $_SESSION['sessaoUs']->vez = 1;
        $this->listar();
    }
}
