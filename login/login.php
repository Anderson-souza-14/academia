<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require('../conexao.php');

if(isset($_POST['usuario']) && isset($_POST['senha'])) {

    if(strlen($_POST['usuario']) == 0) {
        echo "Preencha seu usuário!";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha!";
    } else {
        $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
        $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = mysqli_query($conexao, $sql_code); 
        
        if(!$sql_query) {
            die("Falha na execução do código SQL: " . mysqli_error($conexao));
        }

        if(mysqli_num_rows($sql_query) == 1) {
            $usuario_data = mysqli_fetch_assoc($sql_query);

            if(!empty($usuario_data['idusuarios'])) {
            
                if(session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }

                $_SESSION['id'] = $usuario_data['idusuarios'];

                header("Location: ../index.php");
                exit;
            } else {
                echo "Erro: ID do usuário não encontrado.";
            }
        } else {
            echo "Usuário e/ou senha inválidos!";
        }
    }    
}
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-10 mx-auto col-lg-5">
                <form action="" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                    <h1 class="h3 mb-3 fw-normal">Acesso à Academia</h1>
                    <div class="form-floating mb-3">
                        <input type="text" name="usuario" class="form-control" id="inputUsuario" placeholder="Usuario" required>
                        <label for="inputUsuario">Usuário</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="senha" class="form-control" id="inputPassword" placeholder="Senha" required>
                        <label for="inputPassword">Senha</label>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"/> Lembrar-me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-success" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>