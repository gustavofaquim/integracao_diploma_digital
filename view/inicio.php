<?php 

include "header.php"; 
include '../src/error.php'; 

include '../src/auth.php';

//include 'lyceum.php';
//include 'abaris.php';
include '../src/integracao.php';
$auth = abaris_autenticacao();
?>



<div class="container">
<h1>Página Inicial</h1>
<h4>Código de Autenticação Ábaris: <?= $auth  ?></h4>
</div>


<?php include "footer.php"; ?>