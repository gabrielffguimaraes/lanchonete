<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/product.css">
</head>
<body>
    <?php include "layouts/menu.php"; ?>
    <?php include "layouts/header.php"; ?>
    <?php include "layouts/navigator.php"; ?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Lista de Produtos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area pt-5">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="accordion filter-category mb-4">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="true" aria-controls="collapse-filter">
                            <i class="bi bi-funnel"></i> <b>Filtro</b>
                        </button>
                    </h2>
                    <div id="collapse-filter" class="accordion-collapse collapse">
                        <div id="filter-products" class="accordion-body d-flex flex-row flex-wrap">

                        </div>
                    </div>
                </div>
            </div>
            <div id="products" class="row"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=$baseUrl?>assets/js/views/products.js"></script>
    <?php include "layouts/footer.php"; ?>
</body>

</html>

