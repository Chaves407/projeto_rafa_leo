<?php
$idUser = $_GET["idUser"];
$sql = "SELECT * FROM loginuser WHERE idUser= {$idUser}";
$rs = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados do registro no banco de dados! " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);
?>

<header>
    <h3>Editar Contato</h3>
</header>
<div>
    <form class="needs-validation" action="indexAdmin.php?menuop=atualizar-usuarios" method="post" novalidate>
        
    <div class="mb-3">
            <label class="form-label" for="idUser">ID:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
            <input class="form-control" type="text" name="idUser" required value="<?=$dados["idUser"]?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="loginUser">Nome do Usuario:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
            <input class="form-control" type="text" name="loginUser" readonly required value="<?=$dados["loginUser"]?>">
            </div>
        </div>

        <div class="mb-3">

            <label class="form-label needs-validation" for="nomeUser">Nome do Login:</label required>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at-fill"></i></span>
            <input class="form-control " type="text" name="nomeUser" readonly required value="<?=$dados["nomeUser"]?>">
            </div>
        </div>

        <div class="row">

        <div class="form-label col-4">
            <label class="form-label" for="statusUser">Status do Usuario:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
            <select class="form-select" type="select" name="statusUser" required>

                <option value="<?=$dados["statusUser"]?>"><?=$dados["statusUser"]?></option>
                <option value="Ativo">Ativo</option>
                <option value="Desativado">Desativado</option>
            </select>
            </div>
            </div>

            <div class="form-label col-4">
            <label class="form-label" for="adminUser">Administrador:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
            <select class="form-select" type="select" name="adminUser" required>

                <option value="<?=$dados["adminUser"]?>"><?=$dados["adminUser"]?></option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
            </div>
            </div>

        </div>
        </div>
        <br>
        <div>
            <input type="hidden" name="senhaCriptografada" id="senhaCriptografada" value="">
            <button class="btn btn-outline-success mb-2" type="submit" name="novaSenhaUser">Adicionar</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>