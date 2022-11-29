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
    <title>Herança - Visualizar Usuário do Banco de Dados</title>
</head>
<body>

    <?php
        require '../helpers/link.php';
        // viewIndex();
        rootIndex();
    ?>

    <h1>Detalhe do Usuário</h1>

    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        
        // Verficar se o id possui valor
        if(!empty($idUser)){

            // Incluindo os arquivos mantenedores das classes utilizadas
            requireFiles();

            // Instanciando o objeto
            $viewUser = new User();

            // Enviando id para o atributo da classe
            $viewUser->id = $idUser;

            // Recebendo os valores do usuário
            $resultUser = $viewUser->view();

            // Extraindo os valores do usuário para melhor exibição
            foreach($resultUser as $valuesUser){
                extract($valuesUser);
                echo "<p>
                ID usuário: $id <br>
                Nome usuário: $name <br>
                Email usuário: $email <br>
                Cadastrado: ".

                // Formatando da data recebida do banco de dados
                date('d/m/Y H:i:s', strtotime($created))
                
                ." <br>";

                // Ternario que verifica se existe data de modificação dos dados do usuário
                echo $modified ? "Modificado: ". date('d/m/Y H:i:s', strtotime($modified)) : "" ;
                echo "<br></p>";
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
</body>
</html>