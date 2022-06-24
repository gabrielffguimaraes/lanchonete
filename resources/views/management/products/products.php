<?php
$layoutPath = __DIR__ . "/../../layouts";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
    <link href="<?=$baseUrl?>assets/css/product-manager.css" rel="stylesheet"/>
</head>
<body>
<?php include "$layoutPath/menu-manager.php"; ?>
<?php include "$layoutPath/navigator-manager.php"; ?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Produtos</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area pt-3">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=$baseUrl?>management/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mb-4 mt-3">
                <a href="products/add">
                    <button class="text-white" type="submit">
                        <i class="bi bi-plus-square"></i>
                        ADICIONAR NOVO PRODUTO
                    </button>
                </a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ingredientes</th>
                            <th scope="col">Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-products"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer-manager.php"; ?>
<script src="<?=$baseUrl?>assets/js/views-management/products.js"> </script>
</body>

</html>

