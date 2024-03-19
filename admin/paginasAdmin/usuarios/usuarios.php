<header>
    <h3><i class="bi bi-person-circle"></i> Lista de Contatos</h3>
</header>
<div>
    <a class="btn btn-outline-primary mb-2" href="indexAdmin.php?menuop=inserir-usuarios"><i class="bi bi-person-plus-fill"></i> Adicionar Usuario</a>
</div>
<div class="col-4">
    <form action="indexAdmin.php?menuop=usuarios" method="post">

    <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa">
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i> Pesquisar</button>
    </div>
        </form>
</div>
<div class="tabela">
<table class="table table-dark table-hover table-bordered table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome de Login</th>
            <th>Nome do Usuario</th>
            <th>Administrador</th>
            <th>Status</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    </div>
    <tbody>
    <?php

    $quantidade =  10;
    $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

    $inicio = ($quantidade * $pagina) - $quantidade;

    $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";
    
    $sql = "SELECT
    idUser,
    loginUser,
    nomeUser,
    adminUser,
    CASE
        WHEN statusUser='ativo' THEN 'Ativo'
        WHEN statusUser='desativado' THEN 'Desativado'
        ELSE 'NÃO ESPECIFICADO'
    END AS statusUser,
    CASE
        WHEN adminUser='Sim' THEN 'Sim'
        WHEN adminUser='Não' THEN 'Não'
        ELSE 'NÃO ESPECIFICADO'
    END AS adminUser
FROM loginuser 
WHERE 
    (idUser='{$txt_pesquisa}' OR
    statusUser='{$txt_pesquisa}' OR
    nomeUser LIKE '%{$txt_pesquisa}%')
LIMIT $inicio, $quantidade";
    
    $rs = mysqli_query($conexao,$sql) or die("Erro ao Executar a consulta" . mysqli_error($conexao));
    while($dados = mysqli_fetch_assoc($rs) ){

    ?>
        <tr>
            <td><?=$dados["idUser"] ?></td>
            <td class="text-nowrap"><?=$dados["loginUser"] ?></td>
            <td class="text-nowrap"><?=$dados["nomeUser"] ?></td>
            <td class="text-nowrap"><?=$dados["adminUser"] ?></td>
            <td class="text-nowrap"><?=$dados["statusUser"] ?></td>
            <td class="text-center">

            <a class="btn btn-outline-warning btn-sm" href="indexAdmin.php?menuop=editar-usuarios&idUser=<?=$dados["idUser"] ?>"><i class="bi bi-pencil-square"></i></a>
            
        </td>
            <td class="text-center">

            <a class="btn btn-outline-danger btn-sm" href="indexAdmin.php?menuop=excluir&idUser=<?=$dados['idUser'] ?>"><i class="bi bi-trash-fill"></i></a>
            
            </td>
        </tr>
    <?php
    }
    ?>
    
    </tbody>

</table>

<ul class="pagination justify-content-center">

<?php
$sqlTotal = "SELECT idUser 
             FROM loginuser";
$qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
$numTotal = mysqli_num_rows($qrTotal);
$totalPagina = ceil($numTotal/$quantidade);

echo "<li class='page-item bg-dark'><span class='page-link'>Total de Registros: $numTotal</span></li>";
echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=usuarios&pagina=1\">Previous</a></li>";

if($pagina > 6) {
    ?>
    <li class="page-item bg-dark"><a class="page-link" href="?menuop=usuarios&pagina=<?php echo $pagina-1?>"> << </a></li>
    <?php
}
for($i = 1; $i <= $totalPagina; $i++) {
    if($i >= ($pagina - 5) && $i <= ($pagina + 5)) {
        if($i == $pagina) {
            echo "<li class='page-item bg-dark active'><span class='page-link'>$i</span></li>";
        } else {
            echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=usuarios&pagina={$i}\"> {$i} </a></li>";
        }
    }
}

if($pagina < ($totalPagina - 5)) {
    ?>
    <li class="page-item bg-dark"><a class="page-link" href="?menuop=usuarios&pagina=<?php echo $pagina+1?>"> >> </a></li>
    <?php
}

echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=usuarios&pagina=$totalPagina\">Next</a></li>";
?>
</ul>