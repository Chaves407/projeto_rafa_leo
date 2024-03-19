<br>
<?php
    
    $NomeContato = mysqli_real_escape_string($conexao,$_POST["NomeContato"]);
    $EmailContato = mysqli_real_escape_string($conexao,$_POST["EmailContato"]);
    $TelefoneContato = mysqli_real_escape_string($conexao,$_POST["TelefoneContato"]);
    $HoraContato = mysqli_real_escape_string($conexao,$_POST["HoraContato"]);
    $DataContato = mysqli_real_escape_string($conexao,$_POST["DataContato"]);
    $StatusContato = mysqli_real_escape_string($conexao,$_POST["StatusContato"]);
    $nomeUser = mysqli_real_escape_string($conexao,$_POST["nomeUser"]);
    $sql = "INSERT INTO dbcontato (
        NomeContato,
        EmailContato,
        TelefoneContato,
        HoraContato,
        DataContato,
        StatusContato,
        nomeUser)
        VALUES(

            '{$NomeContato}',
            '{$EmailContato}',
            '{$TelefoneContato}',
            '{$HoraContato}',
            '{$DataContato}',
            '{$StatusContato}',
            '{$nomeUser}'
        )
        ";
        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

        echo "<div class='alert alert-success btn-sm'>
        <p>Informação cadastrada com Sucesso!</p>
        <li class='btn btn-outline-danger btn-sm'><a class='page-link' href='index.php?menuop=contatos'> Voltar </a></li>
        </div>
";
?>