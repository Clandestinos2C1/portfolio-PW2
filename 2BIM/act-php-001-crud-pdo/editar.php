<?php include 'includes/header.php'; ?>

<div class="card">

    <h2>Editar Produto</h2>

    <form action="" method="POST">

        <div class="form-group">

            <label>Nome</label>

            <input
                type="text"
                name="nome"
                value=""
                required
            >

        </div>

        <div class="form-group">

            <label>Fabricante</label>

            <input
                type="text"
                name="fabricante"
                value=""
                required
            >

        </div>

        <div class="form-group">

            <label>Preço</label>

            <input
                type="number"
                step="0.01"
                name="preco"
                value=""
                required
            >

        </div>

        <div class="form-group">

            <label>Estoque</label>

            <input
                type="number"
                name="estoque"
                value=""
                required
            >

        </div>

        <button class="btn btn-blue">
            Salvar Alterações
        </button>

        <a href="index.php" class="btn btn-red">
            Cancelar
        </a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>