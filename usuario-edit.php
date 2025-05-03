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
    <title>Aluno - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navebar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Aluno
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $aluno_id = mysqli_real_escape_string($conexao, $_GET['id']);
                        $sqli = "SELECT * FROM aluno WHERE ID_ALUNO='$aluno_id'";
                        $query = mysqli_query($conexao, $sqli);

                        if (mysqli_num_rows($query) > 0) {
                            $aluno = mysqli_fetch_array($query);                            
                    ?>
                    <form action="acoes.php" method="POST">
                        <input type="hidden" name="ID_ALUNO" value="<?=$aluno['ID_ALUNO']?>">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="NOME" value="<?=$aluno['NOME']?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Idade</label>
                            <input type="number" name="IDADE" value="<?=$aluno['IDADE']?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Faixa</label>
                            <input type="text" name="FAIXA" value="<?=$aluno['FAIXA']?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Grau</label>
                            <input type="text" name="GRAU" value="<?=$aluno['GRAU']?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Última Graduação</label>
                            <input type="date" name="ULTIMA_GRADUACAO" value="<?=htmlspecialchars(date('Y-m-d', strtotime($aluno['ULTIMA_GRADUACAO'])))?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="update_aluno" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
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