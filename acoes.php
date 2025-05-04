<?php
session_start();
require 'conexao.php';

if (isset($_POST['create_aluno'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['NOME']));
    $idade = mysqli_real_escape_string($conexao, trim($_POST['IDADE']));
    $faixa = mysqli_real_escape_string($conexao, trim($_POST['FAIXA']));
    $grau = mysqli_real_escape_string($conexao, trim($_POST['GRAU']));
    $ultima_graduacao = mysqli_real_escape_string($conexao, trim($_POST['ULTIMA_GRADUACAO']));

    if (empty($nome) || empty($idade) || empty($faixa) || empty($grau) || empty($ultima_graduacao)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos!';
        header('Location: index.php');
        exit;
    }

    $sql = "INSERT INTO aluno (NOME, IDADE, FAIXA, GRAU, ULTIMA_GRADUACAO) VALUES ('$nome', '$idade', '$faixa', '$grau', '$ultima_graduacao')";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Aluno cadastrado com sucesso!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao cadastrar aluno!';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['update_aluno'])) {
    $aluno_id = mysqli_real_escape_string($conexao, $_POST['ID_ALUNO']);

    $nome = mysqli_real_escape_string($conexao, trim($_POST['NOME']));
    $idade = mysqli_real_escape_string($conexao, trim($_POST['IDADE']));
    $faixa = mysqli_real_escape_string($conexao, trim($_POST['FAIXA']));
    $grau = mysqli_real_escape_string($conexao, trim($_POST['GRAU']));
    $ultima_graduacao = mysqli_real_escape_string($conexao, trim($_POST['ULTIMA_GRADUACAO']));

    $sql = "UPDATE aluno set NOME= '$nome', IDADE= '$idade', FAIXA= '$faixa', GRAU= '$grau', ULTIMA_GRADUACAO= '$ultima_graduacao' WHERE ID_ALUNO='$aluno_id'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Aluno atualizado com sucesso!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar aluno!';
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['delete_aluno'])) {
    $aluno_id = mysqli_real_escape_string($conexao, $_POST['delete_aluno']);
    $sql = "DELETE FROM aluno WHERE ID_ALUNO='$aluno_id'";
    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Aluno excluído com sucesso!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao excluir Aluno!';
        header('Location: index.php');
        exit;
    }
}
?>