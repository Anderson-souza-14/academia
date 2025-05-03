<?php
define('HOST', 'localhost');
define('USUARIO', 'root'); // Usuário do banco de dados
define('SENHA', '141191'); // Senha do banco de dados          
define('DB', 'academia'); // Nome do banco de dados

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possivel conectar');
?>