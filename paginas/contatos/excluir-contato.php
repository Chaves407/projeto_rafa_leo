<br>
<?php
$idContato = mysqli_real_escape_string($conexao, $_GET['idContato']);
$sql = "DELETE FROM dbcontato WHERE idContato = '{$idContato}'";
mysqli_query($conexao, $sql) 
or die("Erro ao excluir o registro. Erro:" . mysqli_error($conexao) );

echo '
<div class="alert alert-success" role="alert">
Registro excluido com Sucesso! <a href="index.php?menuop=contatos" class="alert-link">Clique aqui para voltar</a>.
</div>';
?>

