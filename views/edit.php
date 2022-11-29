<?php
    session_start();

    ob_start();
    $idUser = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herança - Editar Usuário do Banco de Dados</title>
</head>
<body>

    <?php
        require '../helpers/link.php';
        rootIndex();
    ?>

    <h1>Editar o Usuário</h1>

    <?php
        // Incluindo os arquivos mantenedores das classes utilizadas
        requireFiles();

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        
        // Receber os dados do formulario
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verificar se o usuario clicou no botao
        if(!empty($formData["SendEditUser"])){
            // instanciar a classe
            $editUser = new User();

            // enviar os dados formDara que será utilizado no metodo edit
            $editUser->formData = $formData;

            // receber o retorno para verificar se deu certo
            $resultEditUser = $editUser->edit();

            if($resultEditUser){
                // enviar mensagem de sucesso ao editar o usuario e redirecionar para index
                $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso<p>";
                header("Location: ../index.php");
            }else{
                // mensagem de erro ao tentar editar o usuario
                echo "<p style='color: #f00;'>Erro: usuário não editado com sucesso<p>";
            }
        }

        // Verficar se o id possui valor
        if(!empty($idUser)){

            

            // Instanciando o objeto
            $viewUser = new User();

            // Enviando id para o atributo da classe
            $viewUser->id = $idUser;

            // Recebendo os valores do usuário
            $resultUser = $viewUser->view();

            // Extraindo os valores do usuário para melhor exibição
            foreach($resultUser as $valuesUser){
                extract($valuesUser);
                
            }
        }else{

            /*
                Caso não tenha sido informado o id do usuário ao entrar na página view.php
                o usuário será redirecionado para o index.php
            */
             $_SESSION['msg'] = "<p style='color: #f00;'>Erro: usuário não encontrado<p>";
            header("Location: ../index.php");
        }
        ?>

        <form action="" method="post" name="EditUser">
            <input type="hidden" name="id" value="<?= $id?>">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="<?= $name?>" placeholder="Nome completo" require><br><br>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" value="<?= $email?>" placeholder="Melhor e-mail" require><br><br>
    
            <input type="submit" value="Editar" name="SendEditUser">
    
        </form>
        <?php

        
    ?>
</body>
</html>