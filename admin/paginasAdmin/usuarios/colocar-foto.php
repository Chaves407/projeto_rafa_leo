<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title">Atualizar Foto do Usuário</h3>
                </div>
                <div class="card-body">
                    <form action="indexAdmin.php?menuop=update-fotos" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="nomeUser" value="<?php echo $nomeUser; ?>">
                        <div class="mb-3">
                            <label for="fotoUser" class="form-label">Escolha a foto:</label>
                            <input class="form-control" type="file" name="fotoUser" id="fotoUser">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Foto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
