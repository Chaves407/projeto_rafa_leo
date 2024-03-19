<?php
$idContato = $_GET["idContato"];
$sql = "SELECT * FROM dbcontato WHERE idContato= {$idContato}";
$rs = mysqli_query($conexao,$sql) or die("Erro ao recuperar os dados do registro no banco de dados! " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($rs);
?>

<header>
    <h3>Editar Contato</h3>
</header>

<div>
    <form class="needs-validation" action="index.php?menuop=atualizar-contato" method="post" novalidate>
        <div  class="mb-3">
            <label class="form-label" for="idContato">ID:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-key"></i></span>
            <input class="form-control" type="text" name="idContato" readonly value="<?=$dados["idContato"]?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="NomeContato">Nome:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
            <input class="form-control" type="text" name="NomeContato" required value="<?=$dados["NomeContato"]?>">
            <div class="valid-tooltip">
               Está correto!
            </div>
            <div class="invalid-feedback">
                Campo obrigatório de no máximo 255 caracteres 
            </div>
        </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="EmailContato">E-mail:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at-fill"></i></span>
            <input class="form-control" type="email" name="EmailContato" required value="<?=$dados["EmailContato"]?>">
            <div class="valid-tooltip">
               Está correto!
            </div>
            <div class="invalid-feedback">
                Campo obrigatório de no máximo 255 caracteres 
            </div>
        </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="TelefoneContato">Telefone:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
            <input class="form-control" type="text" name="TelefoneContato" id="TelefoneContato" required value="<?=$dados["TelefoneContato"]?>">
            <div class="valid-tooltip">
               Está correto!
            </div>
            <div class="invalid-feedback">
                Campo obrigatório de no máximo 255 caracteres 
            </div>
        </div>
        </div>

    <div class="row">

        <div class="mb-3 col-4">
            <label class="form-label" for="DataContato">Data:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date-fill"></i></span>
            <input class="form-control" type="date" name="DataContato" required value="<?=$dados["DataContato"]?>">
            </div>
        </div>

        <div class="mb-3 col-4">
            <label class="form-label" for="HoraContato">Hora:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-alarm-fill"></i></span>
            <input class="form-control" type="time" name="HoraContato" required value="<?=$dados["HoraContato"]?>">
            </div>
        </div>

        <div class="mb-3 col-4">
            <label class="form-label" for="StatusContato">Status do Contato:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
            <select class="form-select" name="StatusContato" required>

                <option value="<?=$dados["StatusContato"]?>"><?=$dados["StatusContato"]?></option>
                <option value="Pendente">Pendente</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Em contato">Em contato</option>
                <option value="Hora Marcada">Hora Marcada</option>
                <option value="Escritório">Escritório</option>
                <option value="Não atendeu">Não atendeu</option>
                <option value="Está OK">Está OK</option>


            </select>
            </div>
        </div>
    </div>

        <div>
            <button class="btn btn-outline-success mb-2" type="submit" name="btnAtualizar"><i class="bi bi-arrow-repeat"></i> Atualizar</button>
        </div>

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="js\funcao.js"></script>
