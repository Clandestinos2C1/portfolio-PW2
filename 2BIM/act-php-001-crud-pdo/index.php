<?php
require_once 'config/conexao.php';

$select = "SELECT * from produtos order by id desc";

$Ans = $pdo->query($select);

$produtos = $Ans->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';

?>

<main>


<div class="pagetop"> <!-- parte do topo essa ai, se qser renomear qualquer classe fica a vontade, voce que vai fazer o css ne -->

    <a href="cadastro.php" class="cadastrar_botao">
            Cadastrar Produto
    </a>
</div>
