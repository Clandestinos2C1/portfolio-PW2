<?php include 'includes/header.php'; ?>

<div class="card">

    <h2>Cadastrar Produto</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label for="nome">Nome</label>

            <input
                type="text"
                name="nome"
                id="nome"
                required
            >
        </div>

        <div class="form-group">
            <label for="fabricante">Fabricante</label>

            <input
                type="text"
                name="fabricante"
                id="fabricante"
                required
            >
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>

            <input
                type="number"
                step="0.01"
                name="preco"
                id="preco"
                required
            >
        </div>

        <div class="form-group">
            <label for="estoque">Estoque</label>

            <input
                type="number"
                name="estoque"
                id="estoque"
                required
            >
        </div>

        <button class="btn btn-green">
            Salvar Produto
        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>