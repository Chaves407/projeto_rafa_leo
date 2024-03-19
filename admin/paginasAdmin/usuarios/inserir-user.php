<header>
    <h3>Inserir Usuarios</h3>
</header>
<div>
    <form class="needs-validation" action="indexAdmin.php?menuop=enviar-inform" method="post" novalidate>

        <div class="mb-3">
            <label class="form-label" for="loginUser">Nome do Usuario:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
            <input class="form-control" type="text" name="loginUser" required>
            </div>
        </div>

        <div class="mb-3">

            <label class="form-label needs-validation" for="nomeUser">Nome do Login:</label required>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at-fill"></i></span>
            <input class="form-control " type="text" name="nomeUser" required>
            </div>
        </div>

        <div class="mb-3">

            <label class="form-label needs-validation" for="senhaUser">Senha</label required>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at-fill"></i></span>
            <input class="form-control " type="password" name="senhaUser" required>
            </div>
        </div>

        <div class="row">

        <div class="form-label col-4">
            <label class="form-label" for="statusUser">Status do Usuario:</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
            <select class="form-select" type="select" name="statusUser" required>
            <option value="" selected disabled>Selecione uma opção:</option>

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
            <option value="" selected disabled>Selecione uma opção:</option>

                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
            </div>
            </div>

        </div>
        </div>

        <div>
            <input type="hidden" name="senhaCriptografada" id="senhaCriptografada" value="">
            <button class="btn btn-outline-success mb-2" type="submit" name="novaSenhaUser" onclick="novaSenhaUser"><i class="bi bi-plus-square"></i> Adicionar</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>