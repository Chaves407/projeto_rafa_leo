<header>
    <h3><i class="bi bi-person-circle"></i> Lista de Contatos</h3>
</header>
<div>
    <a class="btn btn-outline-primary mb-2" href="index.php?menuop=cad-contato"><i class="bi bi-person-plus-fill"></i> Adicionar Contato</a>
</div>
<div class="col-4">
    <form action="index.php?menuop=contatos" method="post">

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
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Hora</th>
            <th>Data</th>
            <th>Status</th>
            <th>Editar</th>
            <th>Excluir</th>
            <th>WhatsApp</th>
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
    idContato,
    upper(NomeContato) AS NomeContato,
    lower(EmailContato) AS EmailContato,
    TelefoneContato,
    HoraContato,
    CASE
        WHEN StatusContato='Pendente' THEN 'PENDENTE'
        WHEN StatusContato='Em andamento' THEN 'EM ANDAMENTO'
        WHEN StatusContato='Em contato' THEN 'EM CONTATO'
        WHEN StatusContato='Hora Marcada' THEN 'HORA MARCADA'
        WHEN StatusContato='Escritório' THEN 'ESCRITÓRIO'
        WHEN StatusContato='Não atendeu' THEN 'NÃO ATENDEU'
        WHEN StatusContato='Está OK' THEN 'ESTÁ OK'
        ELSE 'NÃO ESPECIFICADO'
    END AS StatusContato,
    DATE_FORMAT(DataContato,'%d/%m/%Y') AS DataContato
FROM dbcontato 
WHERE 
    (idContato='{$txt_pesquisa}' OR
    StatusContato='{$txt_pesquisa}' OR
    NomeContato LIKE '%{$txt_pesquisa}%')
    AND nomeUser = '{$nomeUser}'
LIMIT $inicio, $quantidade";
    
    $rs = mysqli_query($conexao,$sql) or die("Erro ao Executar a consulta" . mysqli_error($conexao));
    while($dados = mysqli_fetch_assoc($rs) ){

    ?>
        <tr>
            <td><?=$dados["idContato"] ?></td>
            <td class="text-nowrap"><?=$dados["NomeContato"] ?></td>
            <td class="text-nowrap"><?=$dados["EmailContato"] ?></td>
            <td class="text-nowrap"><?=$dados["TelefoneContato"] ?></td>
            <td class="text-nowrap"><?=$dados["HoraContato"] ?></td>
            <td class="text-nowrap"><?=$dados["DataContato"] ?></td>
            <td class="text-nowrap"><?=$dados["StatusContato"] ?></td>
            <td class="text-center">

            <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-contato&idContato=<?=$dados["idContato"] ?>"><i class="bi bi-pencil-square"></i></a>
            
        </td>
        <td class="text-center">
    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmacaoModal<?=$dados['idContato'] ?>">
        <i class="bi bi-trash-fill"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmacaoModal<?=$dados['idContato'] ?>" tabindex="-1" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="confirmacaoModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start text-dark">
                    Tem certeza de que deseja excluir este contato?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="index.php?menuop=excluir-contato&idContato=<?=$dados['idContato'] ?>" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        </div>
    </div>
</td>
<?php
// Verifica se a função limparNumeroTelefone já foi declarada
if (!function_exists('limparNumeroTelefone')) {
    // Declaração da função limparNumeroTelefone
    function limparNumeroTelefone($telefone) {
        return preg_replace('/[^0-9]/', '', $telefone);
    }
}
?>

<td class="text-center">
    <?php
    // Limpa o número de telefone usando a função limparNumeroTelefone
    $telefoneLimpo = limparNumeroTelefone($dados["TelefoneContato"]);

    // Nome da pessoa para a mensagem personalizada (exemplo)
    $nomePessoa = "Nome da Pessoa";

    // ID do modal
    $modalId = "modalWhatsapp" . $dados['idContato'];

    ?>
    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
        <i class="bi bi-whatsapp"></i> WhatsApp
    </button>

    <!-- Modal -->
    <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="<?= $modalId ?>Label">Digite a mensagem:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <textarea class="form-control" id="mensagem<?= $dados['idContato'] ?>" rows="3" placeholder="Digite a mensagem para <?=$dados["NomeContato"] ?>"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="enviarMensagem(event, '<?= $telefoneLimpo ?>', <?= $dados['idContato'] ?>)">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</td>

<script>
function enviarMensagem(event, telefone, idContato) {
    event.preventDefault();

    var mensagem = document.getElementById('mensagem' + idContato).value;
    var mensagemEncoded = encodeURIComponent(mensagem);

    var linkWhatsAppWeb = "https://web.whatsapp.com/send?phone=" + telefone + "&text=" + mensagemEncoded;

    // Abre o WhatsApp Web no modal
    abrirWhatsAppWeb(linkWhatsAppWeb);
}

function abrirWhatsAppWeb(linkWeb) {
    // Verifica se a janela do WhatsApp Web está aberta e pronta para receber mensagens
    var interval = setInterval(function() {
        var whatsappWindow = window.open(linkWeb, 'WhatsAppWeb', 'width=600,height=600');

        if (whatsappWindow) {
            clearInterval(interval);
        }
    }, 500);
}
</script>



        </tr>
    <?php
    }
    ?>
    
    </tbody>

</table>

<ul class="pagination justify-content-center">
<?php

$nomeUsuario = "nomeUser";

$sqlTotal = "SELECT idContato 
             FROM dbcontato
             WHERE nomeUser = '$nomeUser'"; // Substitua 'nomeUsuario' pelo nome da coluna real que armazena os nomes de usuário
$qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
$numTotal = mysqli_num_rows($qrTotal);
$totalPagina = ceil($numTotal/$quantidade);

echo "<li class='page-item bg-dark'><span class='page-link'>Total de Registros: $numTotal</span></li>";
echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=contatos&pagina=1\">Previous</a></li>";

if($pagina>6){
    ?>

        <li class="page-item bg-dark"><a class="page-link" href="?menuop=contatos&pagina=<?php echo $pagina-1?>"> << </a></li>

    <?php
}

for($i=1;$i<=$totalPagina;$i++){

    if($i>=($pagina-5) && $i <= ($pagina+5)){
            if($i==$pagina){
                echo "<li class='page-item bg-dark active'><span class='page-link'>$i</span></li>";
            }else{
                echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=contatos&pagina={$i}\"> {$i} </a></li>";
            }
    }

}

if($pagina<($totalPagina-5)){
    ?>

        <li class="page-item bg-dark"><a class="page-link" href="?menuop=contatos&pagina=<?php echo $pagina+1?>"> >> </a></li>

    <?php
}

echo "<li class='page-item bg-dark'><a class='page-link' href=\"?menuop=contatos&pagina=$totalPagina\">Next</a></li>";

?>
</ul>
