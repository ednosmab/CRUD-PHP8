<?php

abstract class Conn
{
    public string $db = "mysql";
    public string $host = "localhost";
    public string $user = "root";
    public string $pass = "";
    public string $dbName = "celke_heranca";
    public int $port = 3306;
    public object $connect;

    public function connectDb()
    {

        try{

            $this->connect = new PDO($this->db.':host='.$this->host.';port='.$this->port.';dbname='.
            $this->dbName,$this->user,$this->pass);
            
            return $this->connect;

        }catch(Exception $err){
            die('Erro ao tentar conectar no banco de dados. Por favor entre em contato com o 
            administrador ednosmab@yahoo.com.br');
        }
    }
}