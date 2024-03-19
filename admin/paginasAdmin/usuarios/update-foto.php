<?php
// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo foi enviado
    if (isset($_FILES["fotoUser"]) && $_FILES["fotoUser"]["error"] == UPLOAD_ERR_OK) {
        // Diretório onde as fotos serão armazenadas
        $diretorio = "../img/fotosUser/";

        // Nome do arquivo (nome original da foto)
        $nomeArquivo = $_FILES["fotoUser"]["name"];

        // Caminho completo para o arquivo
        $caminhoCompleto = $diretorio . $nomeArquivo;

        // Move o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES["fotoUser"]["tmp_name"], $caminhoCompleto)) {
            // Recupera e escapa o caminho da foto
            $fotoUser = mysqli_real_escape_string($conexao, $caminhoCompleto);
            
            // Recupera e escapa o ID do usuário
            $nomeUser = mysqli_real_escape_string($conexao, $_POST["nomeUser"]);

            // Prepara a consulta SQL para atualizar os dados
            $sql = "UPDATE loginuser SET fotoUser = '{$fotoUser}' WHERE nomeUser = '{$nomeUser}'";

            // Executa a consulta SQL
            $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

            // Exibe uma mensagem de sucesso
            echo "A foto do usuário foi atualizada com sucesso!";
        } else {
            echo "Erro ao fazer upload da foto.";
        }
    } else {
        echo "Erro: Foto do usuário não fornecida ou ocorreu um erro no upload.";
    }
} else {
    // Se o método de requisição não for POST, exibe uma mensagem de erro
    echo "Erro: Método de requisição inválido.";
}
?>
