<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/orders.css">
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
                    <h2>Meus Pedidos</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div id="orders" class="row">
            <div class="card card-item">
                <div class="card-body">
                    <div>
                        <div>
                            <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-chevron-down"></i>
                            </a>&nbsp;&nbsp;&nbsp;
                            <label>Pedido recebido</label>
                        </div>
                        <hr/>
                        <div class="collapse" id="collapseExample">
                            <div id="products">
                                <div>
                                    <small> Pedido : 1 </small>
                                    <div class="d-flex">
                                        <img src="/lanchonete/public/assets/img/product-2.jpg" alt="">
                                        <div class="ms-2">
                                            <p>Nome do produto</p>
                                            <p><b>1 quantidade</b></p>
                                            <p>Salsinha , Tomate , Pimenta , Ervilha</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="timeline" id="timeline">
                                <li class="li complete">
                                    <div class="status">
                                        <h4> Pedido recebido </h4>
                                    </div>
                                </li>
                                <li class="li">
                                    <div class="status">
                                        <h4> Pagamento aprovado </h4>
                                    </div>
                                </li>
                                <li class="li">
                                    <div class="status">
                                        <h4> Em transporte </h4>
                                    </div>
                                </li>
                                <li class="li">
                                    <div class="status">
                                        <h4> Pedido entregue </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="<?=$baseUrl?>assets/js/views/orders.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

