<?php
    // Conexão com o banco de dados
    include "./db/conexao.php";
    // Inicializar a sessão
    session_start();
    // Verificar se o usuário está logado
    if(!isset($_SESSION["loginUser"])) {
        header("Location: login.php");
        exit;
    }
    // Verificar se o código foi submetido
    if(isset($_POST["codigo"])) {
        $codigo = mysqli_real_escape_string($conexao, $_POST["codigo"]);
        $loginUser = $_SESSION["loginUser"];
        // Verificar se o código é válido no banco de dados
        $sql = "SELECT * FROM loginuser WHERE loginUser = '{$loginUser}' AND keyUser = '{$codigo}'";
        $rs = mysqli_query($conexao, $sql);
        $linha = mysqli_num_rows($rs);
        if($linha != 0) {
            // Código válido, faça o que for necessário
            echo "Código válido. Faça o que for necessário aqui.";
        } else {
            // Código inválido
            echo "Código inválido. Por favor, tente novamente.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Código</title>
</head>
<body>
    <h2>Confirmação de Código</h2>
    <form method="POST" action="">
        <label for="codigo">Digite o código de confirmação:</label><br>
        <input type="text" id="codigo" name="codigo" required><br><br>
        <button type="submit">Confirmar</button>
    </form>
</body>
</html>

