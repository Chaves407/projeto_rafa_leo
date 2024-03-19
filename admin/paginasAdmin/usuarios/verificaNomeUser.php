<?php
// Recupere o nome de usuário enviado via POST
$nomeUsuario = mysqli_real_escape_string($conexao, $_POST['nomeUser']);

// Consulta SQL para verificar se o nome de usuário já existe no banco de dados
$query = "SELECT * FROM loginuser WHERE loginUser = '$nomeUser'";
$resultado = mysqli_query($conexao, $query);

// Verifica se o nome de usuário já existe
if (mysqli_num_rows($resultado) > 0) {
    // Se o nome de usuário já existir, retorne 'existe'
    echo 'existe';
} else {
    // Se o nome de usuário não existir, retorne 'nao_existe'
    echo 'nao_existe';
}

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>
