<header>
    <h3>Inserir Usuarios</h3>
</header>

<?php
    // Verifica se os dados do formulário foram enviados
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera e escapa os dados do formulário
        $nomeUser = mysqli_real_escape_string($conexao, $_POST["nomeUser"]);
        $loginUser = mysqli_real_escape_string($conexao, $_POST["loginUser"]);
        $senhaUser = mysqli_real_escape_string($conexao, $_POST["senhaUser"]);
        $statusUser = mysqli_real_escape_string($conexao, $_POST["statusUser"]);
        $adminUser = mysqli_real_escape_string($conexao, $_POST["adminUser"]);
        

        // Criptografa a senha usando SHA256
        $senhaCriptografada = hash('sha256', $senhaUser);

        // Prepara a consulta SQL para inserir os dados
        $sql = "INSERT INTO loginuser (
            nomeUser,
            loginUser,
            senhaUser,
            statusUser,
            adminUser)
            VALUES(
                '{$nomeUser}',
                '{$loginUser}',
                '{$senhaCriptografada}',
                '{$statusUser}',
                '{$adminUser}'
            )";

        // Executa a consulta SQL
        $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

        // Exibe uma mensagem de sucesso
        echo "O usuário foi registrado com sucesso!";
    } else {
        // Se o método de requisição não for POST, exibe uma mensagem de erro
        echo "Erro: Método de requisição inválido.";
    }
?>