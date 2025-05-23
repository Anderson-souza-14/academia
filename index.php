<?php
header('Content-Type: text/html; charset=utf-8');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("location: acesso/acesso.php");  
    exit;
}
require 'acesso/protecao.php';
require 'conexao.php';

$pesquisa = isset($_GET['pesquisa']) ? mysqli_real_escape_string($conexao, $_GET['pesquisa']) : '';

$sql = "SELECT * FROM aluno";
if (!empty($pesquisa)) {
  $sql .= " WHERE NOME LIKE '%$pesquisa%'";
}

$alunos = mysqli_query($conexao, $sql);

?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <?php include('navebar.php'); ?>
    <div class="container mt-4">
      <?php include('mensagem.php'); ?>
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4> Lista de Alunos
                <a href="acesso/logout.php" class="btn btn-danger float-end me-2">Sair</a>
                <a href="usuario-create.php" class="btn btn-primary float-end me-2">Adicionar Aluno</a>
                <form action="" method="GET" class="d-inline float-end me-2">
                  <input type="text" name="pesquisa" id="pesquisa" class="form-control d-inline w-auto" placeholder="Pesquisar aluno" value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>">
                  <button type="submit" class="btn btn-primary"><span class="bi-search"></span>Pesquisar</button>
                </form>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Faixa</th>
                    <th>Grau</th>
                    <th>Última Graduação</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 1;
                  if (mysqli_num_rows($alunos) > 0) {
                    foreach ($alunos as $aluno) {
                  ?>
                  <tr>
                    <td><?=$contador++?></td>
                    <td><?=$aluno['NOME']?></td>
                    <td><?=$aluno['IDADE']?></td>
                    <td><?=$aluno['FAIXA']?></td>
                    <td><?=$aluno['GRAU']?></td>
                    <td><?=date('d/m/y', strtotime($aluno['ULTIMA_GRADUACAO']))?></td>
                    <td>
                      <a href="usuario-view.php?id=<?=$aluno['ID_ALUNO']?>"class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Vizualizar</a>
                      <a href="usuario-edit.php?id=<?=$aluno['ID_ALUNO']?>"class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                      <form action="acoes.php" method="POST" class="d-inline">
                        <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_aluno" value="<?=$aluno['ID_ALUNO']?>" class="btn btn-danger btn-sm"><span class="bi-trash3-fill"></span>&nbsp;
                          Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php
                  }
                  } else {
                  echo'<h5>Nenhum aluno encontrado</h5>';
                  }
                  ?>                
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>