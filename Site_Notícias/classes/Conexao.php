<?php
/**
*Classe Conexão, responsável por estabelecer conexão com o banco de dados
*@version 1.0
*@author Rafael Linden Henrichs
*@access public
*@copyright GPL 2020, INFO63B
*/
class Conexao {
    /**
    *@var
    */
    public static $instance;

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance =new PDO(SGBD.":host=".HOST_DB.";dbname=".DB."",USER_DB,PASS_DB);
        }
        return  self::$instance;
    }
}
