<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
</head>
<body>
<?php include "layouts/menu-client.php"; ?>
<?php include "layouts/header.php"; ?>
<?php include "layouts/navigator-client.php"; ?>

<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <li>
                <img src="<?=$baseUrl?>assets/img/pizza/pizalg.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        SABOR DE <span class="primary">PIZZA <br><strong>DE VERDADE</strong></span>
                    </h2>
                    <h4 class="caption subtitle">ESCOLHA O SEU</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
            <li><img src="<?=$baseUrl?>assets/img/hamburguer/hamburguerlg.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        Carne <span class="primary">100% <strong>Bovina</strong></span>
                    </h2>
                    <h4 class="caption subtitle">ESCOLHA O SEU</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
            <li><img src="<?=$baseUrl?>assets/img/bebidas/bebidaslg.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        Drinks & <span class="primary">Sucos, <strong>Cervejas</strong></span>
                    </h2>
                    <h4 class="caption subtitle">PEGUE O SEU</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
            <li><img src="<?=$baseUrl?>assets/img/sanduiches/sanduichelg.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        Sanduiches <span class="primary">Veganos e <strong>Caseiros</strong></span>
                    </h2>
                    <h4 class="caption subtitle">APROVEITE AGORA</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
            <li><img src="<?=$baseUrl?>assets/img/sobremesas/sobremesalg.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        Sobremesas <span class="primary">Diversas e </br> <strong>Saborosas</strong></span>
                    </h2>
                    <h4 class="caption subtitle">EXPERIMENTE AGORA</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
            <li><img src="<?=$baseUrl?>assets/img/pasteis/pasteis1.png" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        Pastéis <span class="primary">Saborosos e </br> <strong>Recheados</strong></span>
                    </h2>
                    <h4 class="caption subtitle">ESCOLHA O SEU AGORA</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Comprar</a>
                </div>
            </li>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>1 ano de garantia</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Frete grátis</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Pagamento seguro</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>Novos produtos</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Produtos</h2>
                    <div id="products" class="product-carousel">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <img src="<?=$baseUrl?>assets/img/brand/catupiry.png" alt="">
                        <img src="<?=$baseUrl?>assets/img/brand/heinz.png" alt="">
                        <img src="<?=$baseUrl?>assets/img/brand/nutella.png" alt="">
                        <img src="<?=$baseUrl?>assets/img/brand/wessel.png" alt="">
                        <img src="<?=$baseUrl?>assets/img/brand/heineken.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<script src="<?=$baseUrl?>assets/js/views/homepage.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

