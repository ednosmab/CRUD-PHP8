<?php

session_start();

ob_start();

// Receber o id do usuario via URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

require '../helpers/link.php';
if(!empty($id)){
    // incluindo arquivos
    requireFiles();

    $deleteUser = new User();
    $deleteUser->id = $id;
    $returnDeleteUser = $deleteUser->delete();
    if($returnDeleteUser){
        // enviar mensagem de sucesso ao tentar deletar o usuario e redirecionar para index
        $_SESSION['msg'] = "<p style='color: green;'>Usuário deletado com sucesso<p>";
        header("Location: ../index.php");

    }else{
        // enviar mensagem de erro ao tentar deletar o usuario e redirecionar para index
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não deletado com sucesso<p>";
        header("Location: ../index.php");
    }
}else{
    // enviar mensagem de erro ao tentar deletar o usuario e redirecionar para index
    $_SESSION['msg'] = "<p style='color: #f00;'>Usuário não deletado com sucesso<p>";
    header("Location: ../index.php");
}