<?php
    include "conexao.php";
    $msg_error = "";

    if(isset($_POST["loginUser"]) && isset($_POST["senhaUser"])) {
        $loginUser = mysqli_escape_string($conexao, $_POST["loginUser"]);
        $senhaUser = hash('sha256', $_POST["senhaUser"]);

        $sql = "SELECT * FROM loginuser WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUser}'";
        $rs = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_assoc($rs);

        if($dados) { // Verifica se os dados foram encontrados
            $status = $dados["statusUser"];
            $perfil = $dados["adminUser"];

            if($status == "Ativo") {
                session_start();
                $_SESSION["loginUser"] = $loginUser;
                $_SESSION["senhaUser"] = $senhaUser;
                $_SESSION["nomeUser"] = $dados["nomeUser"];
                $_SESSION["adminUser"] = $perfil; // Adiciona o perfil do usuário à sessão

                // Verifica se o perfil é "administrador" ou "membro"
                if ($perfil == "Sim") {
                    // Redireciona o administrador para a página de administração
                    header("location: indexAdmin.php");
                    exit;
                } else {
                    // Redireciona outros usuários para a página inicial
                    header("location: loginAdmin.php");
                    exit;
                }
            } else {
                $msg_error = "<div class='alert alert-danger mt-3'>
                                <p>Sua conta está desativada. Entre em contato com o administrador para obter assistência.</p>
                                </div>";
            }
        } 
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>Acesso Restrido!</title>
</head>
<body class="bg-secondary">

 <div class="container">
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4 p-4 bg-white shadow rounded">
        <div class="row justify-content-center mb-4">
        <center><h2>Acesso Restrido</h2></center>
        </div>
        <form action="loginAdmin.php" method="post">
            <div class="form-group">
                <label class="form-label" for="loginUser">Usuario:</label>
                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </span>
                <input class="form-control" type="text" name="loginUser" id="loginUser" required>
                </div>

                <div class="form-group">
                <label class="form-label" for="senhaUser">Senha:</label>
                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <i class="bi bi-key-fill"></i>
                    </span>
                <input class="form-control" type="password" name="senhaUser" id="senhaUser" required>
                </div>
                <?php
                    echo $msg_error;
                ?>
            </div>
            <button class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
        </form>
        </div>

    </div>
 </div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>