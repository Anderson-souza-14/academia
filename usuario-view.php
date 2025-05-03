<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("location: login/login.php");  
    exit;
}
require 'conexao.php';
require 'login/protecao.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alunos - Vizualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navebar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Vizualizar Aluno
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                <div class="card-body">
                        <?php
                    if (isset($_GET['id'])) {
                            $aluno_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM aluno WHERE ID_ALUNO='$aluno_id'";
                            $query = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            $aluno = mysqli_fetch_array($query);
                        ?>
                        <div class="mb-3">
                            <label>Nome</label>
                            <p class="form-control">                               
                                <?= $aluno['NOME'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Idade</label>
                            <p class="form-control">
                                <?= $aluno['IDADE'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Faixa</label>
                            <p class="form-control">
                                <?= $aluno['FAIXA'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Grau</label>
                            <p class="form-control">
                                <?= $aluno['GRAU'];?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Ultima Graduação</label>
                            <p class="form-control">
                                <?=htmlspecialchars(date('d/m/y', strtotime($aluno['ULTIMA_GRADUACAO'])));?>
                            </p>
                        </div> 
                        <?php
                        } else {
                            echo "<h5>Aluno não encontrado</h5>";
                        }
                    }
                    ?>                                
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>