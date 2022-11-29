<?php


function rootIndex(String $page = ""): void
{
    if($page == "index"){
        echo "<a href='index.php'>Listar</a><br>
        <a href='./views/create.php'>Cadastrar</a><br>";
    }else{
        echo "
            <a href='../index.php'>Listar</a><br>
            <a href='./create.php'>Cadastrar</a><br>";
    }
}

function requireFiles(String $page = ""): void
{
    if($page == "index"){
        require './models/DAO/Conn.php';
        require './models/User.php';
    }else{
        require '../models/DAO/Conn.php';
        require '../models/User.php';
    }
}