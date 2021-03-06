<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/orders.css">
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
                    <h2>Meus Pedidos</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div id="orders" class="row d-none">

        </div>
        <div id="empty-order" class="d-none">
            <div class="mb-3">
                <i class="bi bi-bag-x icon-order"></i>
            </div>
            <h4>VOCÊ NÃO POSSUI PEDIDOS</h4>
        </div>
    </div>
</div>
<script src="<?=$baseUrl?>assets/js/views/orders.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

