<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("location: login/login.php");  
    exit;
}    
require 'login/protecao.php';

?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navebar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Aluno
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                <div class="card-body">
                    <form action="acoes.php" method="POST">
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="NOME" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Idade</label>
                            <input type="number" name="IDADE" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Faixa</label>
                            <input type="text" name="FAIXA" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Grau</label>
                            <input type="text" name="GRAU" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Última Graduação</label>
                            <input type="date" name="ULTIMA_GRADUACAO" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="create_aluno" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>