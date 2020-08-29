<?php
/**
*Classe Início, retorna ao "home" do site
*/
class Inicio{
    /**
    *Função de redirecionamento ao home
    */
    public function index(){
        include HOME_DIR."view/paginas/home.php";
    }
}

?>
