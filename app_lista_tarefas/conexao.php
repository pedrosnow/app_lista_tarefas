<?php

class conexao{

    private $host = 'localhost';
    private $bd = 'php_com_pdo';
    private $user = 'root';
    private $password = '';

    public function conectar(){
        try {

            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->bd",
                "$this->user",
                "$this->password"
            );
            
            return $conexao;


        } catch (PDOExcption $e) {
            echo '<p>'. $e->getMessege() . '</p>';

        }
    }


}