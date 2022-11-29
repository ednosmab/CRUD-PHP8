<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herança - Cadastrar no Banco de Dados</title>
</head>
<body>

    <?php
        require '../helpers/link.php';
        rootIndex();
    ?>

    <h1>Cadastrar Usuário</h1>
    <?php
        requireFiles();

        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($formData['SendAddUser'])){

            $createUser = new User();
            $createUser->formData = $formData;
            $resultAddUser = $createUser->create();
            
            if($resultAddUser){
                $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso<p>";
                header("Location: ../index.php");
            }else{
                $_SESSION['msg'] = "<p style='color: red;'>Usuário não cadastrado com sucesso<p>";
            }
        }
        
    ?>

    <form action="" method="post" name="CreateUser">
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome completo" require><br><br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Melhor e-mail" require><br><br>

        <input type="submit" value="Cadastrar" name="SendAddUser">

    </form>
</body>
</html>