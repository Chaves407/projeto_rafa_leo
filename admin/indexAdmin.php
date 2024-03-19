<?php
    include("..\db\conexao.php");
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
            header('Location: loginAdmin.php');
            exit();

        }


    }else{
        header('Location: loginAdmin.php');
            exit();

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css\estilopadrao.css">
    <link rel="stylesheet" href="../css\sidebar.css">
    <link rel="icon" href="img\icon.png">
    <title>Painel Administrativo</title>

</head>
<body>
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
                                    echo '<img src="../img/fotosUser/fotoPadrao.png" alt="Foto Padrão" width="32" height="32" class="rounded-circle me-2">';
                                }
                                ?>
                                <span><?=$dados["nomeUser"]?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

    <!-- Barra lateral -->
    <div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
            <a class="nav-link" href="index.php?menuop=home">
                <i class="bi bi-house-door"></i>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Lista de Usuarios">
            <a class="nav-link" href="indexAdmin.php?menuop=usuarios">
                <i class="bi bi-telephone"></i>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Tarefas">
            <a class="nav-link" href="#">
                <i class="bi bi-calendar-check"></i>
            </a>
            <hr>
        </li>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="right" title="Eventos">
            <a class="nav-link" href="#">
                <i class="bi bi-calendar-event"></i>
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
            case 'admin':
                include("../admin\paginasAdmin\homeadmin\home.php");
            break;
            case 'usuarios':
                include("paginasAdmin/usuarios\usuarios.php");
            break;
            case 'editar-usuarios':
                include("paginasAdmin/usuarios/edi-user.php");
            break;
            case 'excluir':
                include("paginasAdmin/usuarios/excluir-usuarios.php");
            break;
            case 'inserir-usuarios':
                include("paginasAdmin/usuarios/inserir-user.php");
            break;
            case 'atualizar-usuarios':
                include("paginasAdmin/usuarios/atualizar-user.php");
            break;
            case 'verificar-usuario':
                include("paginasAdmin/usuarios/verificaNomeUser.php");
            break;
            case 'update-fotos':
                include("paginasAdmin\usuarios\update-foto.php");
            break;
            case 'inserir-img':
                include("paginasAdmin\usuarios\colocar-foto.php");
            break;
            case 'enviar-inform':
                include("paginasAdmin/usuarios/enviar-inform.php");
            break;

            default:
                include("../admin\paginasAdmin\homeadmin\home.php");
                break;
        }    
    ?>
    </div>
    </div>
    </div>
    </main>

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
</body>
</html>