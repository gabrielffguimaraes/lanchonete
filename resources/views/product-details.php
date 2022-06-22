<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link href="<?=$baseUrl?>assets/css/product-details.css" rel="stylesheet"
</head>
<body>
<?php include "layouts/menu-client.php"; ?>
<?php include "layouts/header.php"; ?>
<?php include "layouts/navigator-client.php"; ?>

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

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Buscar Produtos</h2>
                    <form action="">
                        <input type="text" id="product-name" placeholder="Buscar produtos...">
                        <input type="submit" onclick="carregarProdutos();" value="Buscar">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Produtos</h2>
                    <div id="products"></div>
                </div>

            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="<?=$baseUrl?>">Pagina inicial</a>
                        <a class="category-product" style="text-decoration: unset;color:#666"></a>
                        <a class="description-product" style="text-decoration: unset;color:#666"></a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="" alt="">
                                </div>

                                <div class="product-gallery">
                                  <!-- loaded by javascript -->
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name description-product"></h2>
                                <div class="product-inner-price">
                                    <ins id="price-product"></ins>
                                    <del id="price-fake"></del>
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" id="quantity" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" id="add_to_cart_button" type="submit">Adicionar</button>
                                </form>

                                <div class="product-inner-category">
                                    <p>Categoria: <u class="category-product"></u>.
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active tab-detail-product"  onclick="changeTabDetail(this,'.tab-1')"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation" class="tab-detail-product" onclick="changeTabDetail(this,'.tab-2')"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab tab-1">
                                            <h2>Descrição do produto</h2>
                                            <div id="details">

                                            </div>
                                        </div>
                                        <div class="tab tab-2 d-none">
                                            <h2>Revisão</h2>
                                            <div id="reviews">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script id="script-product-detail"
        src="<?=$baseUrl?>assets/js/views/product-details.js"
        product-id="<?=$id?>"
></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>



