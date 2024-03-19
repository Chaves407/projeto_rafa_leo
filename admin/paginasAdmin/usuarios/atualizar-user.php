<?php
$idUser = mysqli_real_escape_string($conexao,$_POST["idUser"]);
$loginUser = mysqli_real_escape_string($conexao,$_POST["loginUser"]);
$nomeUser = mysqli_real_escape_string($conexao,$_POST["nomeUser"]);
$statusUser = mysqli_real_escape_string($conexao,$_POST["statusUser"]);
$adminUser = mysqli_real_escape_string($conexao,$_POST["adminUser"]);

// Criptografa a senha usando SHA256
$senhaCriptografada = hash('sha256', $senhaUser);

$sql = "UPDATE loginuser SET
    loginUser = '{$loginUser}',
    nomeUser = '{$nomeUser}',
    statusUser = '{$statusUser}',
    adminUser = '{$adminUser}'
WHERE idUser = '{$idUser}'";

mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

echo "<div class='alert alert-success mt-3'>
<p>Informação atualizada com Sucesso!</p>
<li class='btn btn-outline-danger btn-sm'><a class='page-link' href='indexAdmin.php?menuop=usuarios'> Voltar </a></li>
</div>";
?>