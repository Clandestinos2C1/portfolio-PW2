<?php include 'includes/header.php'; ?>

<div class="card">

    <h2>Cadastrar Produto</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label>Nome</label>

            <input
                type="text"
                name="nome"
                required
            >
        </div>

        <div class="form-group">
            <label>Fabricante</label>

            <input
                type="text"
                name="fabricante"
                required
            >
        </div>

        <div class="form-group">
            <label>Preço</label>

            <input
                type="number"
                step="0.01"
                name="preco"
                required
            >
        </div>

        <div class="form-group">
            <label>Estoque</label>

            <input
                type="number"
                name="estoque"
                required
            >
        </div>

        <button class="btn btn-green">
            Salvar Produto
        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>