<?php
$layoutPath = __DIR__ . "/../layouts";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
    <link href="<?=$baseUrl?>assets/css/order-manager.css" rel="stylesheet" />
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
                    <!-- loaded by js -->
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
                    <tbody id="tbody-orders"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SEE ORDER DETAILS -->
<div class="modal fade" id="modal-order-detail" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pedido : 18</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="body-order-details"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Cancelar pedido</button>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer.php"; ?>
<script src="<?=$baseUrl?>assets/js/views-management/orders.js"> </script>
</body>

</html>

