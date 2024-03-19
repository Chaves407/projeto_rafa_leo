<header>
    <h3>Excluir Contato</h3>
</header>
<?php
$idUser = mysqli_real_escape_string($conexao, $_GET['idUser']);
$sql = "DELETE FROM loginuser WHERE idUser = '{$idUser}'";
mysqli_query($conexao, $sql) 
or die("Erro ao excluir o registro. Erro:" . mysqli_error($conexao) );

echo "Registro excluido com sucesso!";
?>