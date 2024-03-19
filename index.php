<?php
    include("db\conexao.php");
    session_start();
    if(isset($_SESSION["loginUser"]) and isset($_SESSION["senhaUser"]) ){
        $loginUser = $_SESSION["loginUser"];
        $senhaUser = $_SESSION["senhaUser"];
        $nomeUser = $_SESSION["nomeUser"];

        $sql = "SELECT * FROM loginuser WHERE loginUser = '{$loginUser}' and senhaUser = '{$senhaUser}'";
        $rs = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($rs);
        $linha = mysqli_num_rows($rs);

        if( $linha == 0) {
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();

        }


    }else{
        header('Location: login.php');
            exit();

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css\estilopadrao.css">
    <link rel="stylesheet" href="css\sidebar.css">
    <link rel="icon" href="img\logo.png">
    <title>Sistema de controle de contatos</title>

    
</head>
<body>
<!-- Barra de navegação -->
<header class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../admin/indexAdmin.php"></a>
            <div class="collapse navbar-collapse" id="conteutoNavBarSuportado">
                <div class="navbar-nav w-100 justify-content-end mt-5">
                    <ul class="navbar-nav ml-auto">
                        <!-- Dropdown movido para o canto direito -->
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                // Verifica se o usuário tem uma foto definida
                                if (!empty($dados['fotoUser'])) {
                                    // Se o usuário tiver uma foto definida, exiba-a
                                    echo '<img src="' . $dados['fotoUser'] . '" alt="Foto do Usuário" width="32" height="32" class="rounded-circle me-2">';
                                } else {
                                    // Se o usuário não tiver uma foto definida, exiba a foto padrão
                                    echo '<img src="img/fotosUser/fotoPadrao.png" alt="Foto Padrão" width="32" height="32" class="rounded-circle me-2">';
                                }
                                ?>
                                <span><?=$dados["nomeUser"]?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Adicionar Foto</a></li>
                            <li><a class="dropdown-item" href="admin/loginAdmin.php">Acesso Administrativo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmacaoModal">Sair</a>
                            </li>
                        </ul>

                        <!-- Modal de confirmação -->
                        <div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="confirmacaoModalLabel">Confirmar Saída</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        Tem certeza de que deseja sair?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="logout.php" class="btn btn-danger">Sair</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

    <!-- Barra lateral -->
    <div class="sidebar">
    <center><img src="img\logo.png" class="mb-5" alt="Logo" width="40" height="auto"></center>
    <ul class="nav flex-column">
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
            <a class="nav-link" href="index.php?menuop=home">
                <center><i class="bi bi-house-door"></i></center>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Contatos">
            <a class="nav-link" href="index.php?menuop=contatos">
                <center><i class="bi bi-telephone"></i></center>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Tarefas">
            <a class="nav-link" href="#">
                <center><i class="bi bi-list-task"></i></center>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Eventos">
            <a class="nav-link" href="#">
                <center><i class="bi bi-calendar-event"></i></center>
            </a>
            <hr>
        </li>
    </ul>
  </div>
</div>
    <main style="margin-left: 4.5rem;"> <!-- Adicione margem à esquerda para acomodar a barra lateral -->
        <div class="container">
            <?php
                $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"home";
                switch ($menuop) {
                    case 'home':
                        include("paginas\home\home.php");
                    break;
                    case 'contatos':
                        include("paginas\contatos\contatos.php");
                    break;
                    case 'cad-contato':
                        include("paginas\contatos\cad-contato.php");
                    break;
                    case 'inserir-contato':
                        include("paginas\contatos\inserir-contato.php");
                    break;
                    case 'editar-contato':
                        include("paginas/contatos/editar-contato.php");
                    break;
                    case 'excluir-contato':
                        include("paginas/contatos/excluir-contato.php");
                    break;
                    case 'atualizar-contato':
                        include("paginas/contatos/atualizar-contato.php");
                    break;
                    case 'tarefas':
                        include("paginas/tarefas/tarefas.php");
                    break;
                    case 'eventos':
                        include("paginas/eventos/eventos.php");
                    break;
                    case 'confirmar-usuario':
                        include("confimacaoEmail.php");
                    break;
                    case 'verifica-key':
                        include("verifica_codigo.php");
                    break;


                    default:
                        include("paginas\home\home.php");
                        break;
                }    
            ?>
        </div>
    </main>

    <script src="js\jquery-3.7.1.min.js"></script>
    <script src="js\jquery.form.js"></script>
    <script src="js\upload.js"></script>

    <!-- Bootstrap JS e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para tooltip -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>
