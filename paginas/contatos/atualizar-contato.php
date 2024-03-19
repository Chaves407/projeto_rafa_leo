<header>
    <h3>Atualizar Contato</h3>
</header>
<?php
    
    $idContato = mysqli_real_escape_string($conexao,$_POST["idContato"]);
    $NomeContato = mysqli_real_escape_string($conexao,$_POST["NomeContato"]);
    $EmailContato = mysqli_real_escape_string($conexao,$_POST["EmailContato"]);
    $TelefoneContato = mysqli_real_escape_string($conexao,$_POST["TelefoneContato"]);
    $HoraContato = mysqli_real_escape_string($conexao,$_POST["HoraContato"]);
    $DataContato = mysqli_real_escape_string($conexao,$_POST["DataContato"]);
    $StatusContato = mysqli_real_escape_string($conexao,$_POST["StatusContato"]);
    $sql = "UPDATE dbcontato SET

        NomeContato = '{$NomeContato}',
        EmailContato = '{$EmailContato}',
        TelefoneContato = '{$TelefoneContato}',
        HoraContato = '{$HoraContato}',
        DataContato = '{$DataContato}',
        StatusContato = '{$StatusContato}'
        WHERE idContato = '{$idContato}'
        ";
            mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

            echo "<div class='alert alert-success mt-3'>
            <p>Informação atualizada com Sucesso!</p>
            <li class='btn btn-outline-danger btn-sm'><a class='page-link' href='index.php?menuop=contatos'> Voltar </a></li>
            </div>
";
?>