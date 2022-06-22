<?php
$layoutPath = __DIR__ . "/../layouts";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
    <style>
        .d-ini {
            width:210px !important;
        }
    </style>
</head>
<body>
<?php include "$layoutPath/menu-manager.php"; ?>
<?php include "$layoutPath/navigator-manager.php"; ?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Pedidos</h2>
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
                        <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="true" aria-controls="collapse-filter">
                            <i class="bi bi-funnel"></i> <b>Filtro</b>
                        </button>
                        <div class="input-group mt-2 d-ini">
                            <span class="input-group-text">Data</span>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-3" id="tab-hist">
                    <li class="nav-item position-relative b-0" onclick="changeTab(this,0)">
                        <a class="nav-link active" href="#">
                            Pedidos Novos <span id="qtd-0" class="badge bg-secondary ">0</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative b-0 ms-3" onclick="changeTab(this,1)">
                        <a class="nav-link" href="#">
                            Pedidos entregues <span id="qtd-1" class="badge bg-secondary ">0</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative b-0 ms-3" onclick="changeTab(this,2)">
                        <a class="nav-link" href="#">
                            Preparando pedido <span id="qtd-2" class="badge bg-secondary ">0</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative b-0 ms-3" onclick="changeTab(this,3)">
                        <a class="nav-link" href="#">
                            Em transporte <span id="qtd-3" class="badge bg-secondary ">0</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative b-0 ms-3" onclick="changeTab(this,4)">
                        <a class="nav-link" href="#">
                            Pedido Finalizado <span id="qtd-4" class="badge bg-secondary ">0</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data</th>
                        <th scope="col">Valor total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbody-products"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer.php"; ?>
<script src="<?=$baseUrl?>assets/js/views-management/orders.js"> </script>
</body>

</html>

