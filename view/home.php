<?php
include '../src/auth.php';
$auth = abaris_autenticacao();


?>
<h1>Página Inicial</h1>
<h4>Código de Autenticação Ábaris: <?= $auth  ?></h4>
