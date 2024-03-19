<header>
    <h3><i class="bi bi-person-circle"></i> Cadastrar Usuario</h3>
</header>

<div class="container">
    <form id="formCadastro" class="needs-validation" action="index.php?menuop=inserir-contato" method="post" novalidate>
        <div class="mb-3">
            <label class="form-label" for="nomeUser">Nome Usuario:</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="nomeUser" readonly value="<?=$dados["nomeUser"]?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="NomeContato">Nome:</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="NomeContato" required>
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
                <input class="form-control" type="email" name="EmailContato" required>
                <div class="valid-tooltip">
                    Está correto!
                </div>
                <div class="invalid-feedback">
                    Campo obrigatório! 
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="TelefoneContato">Telefone:</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="tel" name="TelefoneContato" id="TelefoneContato" maxlength="15" required>
                <div class="valid-tooltip">
                    Está correto!
                </div>
                <div class="invalid-feedback">
                    Campo obrigatório! 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-4">
                <label class="form-label" for="DataContato">Data:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-date-fill"></i></span>
                    <input class="form-control" type="date" name="DataContato" required>
                </div>
            </div>

            <div class="mb-3 col-4">
                <label class="form-label" for="HoraContato">Hora:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-alarm-fill"></i></span>
                    <input class="form-control" type="time" name="HoraContato" required>
                </div>
            </div>

            <div class="form-label col-4">
                <label class="form-label" for="StatusContato">Status do Contato:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-check2-all"></i></span>
                    <select class="form-select" type="select" name="StatusContato" required>
                        <option value="" selected disabled>Selecione uma opção:</option>
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
            <button class="btn btn-outline-success mb-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"> Registrar informação</button>
        </div>
        
        <!-- Botão Adicionar dentro do formulário -->
        <button class="btn btn-primary d-none" type="submit" name="btnAdicionar" id="btnAdicionarForm"></button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Confirmação de Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                Tem certeza que deseja adicionar este contato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnAdicionarModal">Adicionar</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS e jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js\funcao.js"></script>

<!-- Script para enviar o formulário quando clicar em Adicionar no modal -->
<script>
    $(document).ready(function(){
        $('#btnAdicionarModal').click(function(){
            // Verifica se o formulário é válido
            if ($('#formCadastro')[0].checkValidity()) {
                $('#btnAdicionarForm').click(); // Simular o clique no botão Adicionar do formulário
            } else {
                // Se o formulário não for válido, exibe as mensagens de validação
                $('#formCadastro').addClass('was-validated');
            }
        });
    });
</script>
</body>
</div>