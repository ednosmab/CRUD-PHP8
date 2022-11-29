<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herança - Listar Usuários do Banco de Dados</title>
</head>
<body>

    <!-- <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br> -->

    <?php
        require './helpers/link.php';
        rootIndex("index");
    ?>

    <h1>Listar Usuários</h1>

    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        requireFiles("index");

        $listUsers = new User();
        $resultUsers = $listUsers->list();
        foreach($resultUsers as $row_user)
        {
            extract($row_user);
            echo 
            "<p>
                ID usuário: $id <br>
                Nome usuário: $name <br>
                Email usuário: $email <br>
                <a href='./views/view.php?id=$id'>Visualizar</a><br>
                <a href='./views/edit.php?id=$id'>Editar</a><br>
                <a href='./views/delete.php?id=$id'>Deletar</a><br>
            </p>
            <hr>";
        }
    ?>
</body>
</html>