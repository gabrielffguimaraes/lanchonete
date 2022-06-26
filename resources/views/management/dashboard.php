<?php
$layoutPath = __DIR__ . "/../layouts";
$month = date("m");
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
    <link href="<?=$baseUrl?>assets/css/dashboard-manager.css" rel="stylesheet"/>
</head>
<body>
<?php include "$layoutPath/menu-manager.php"; ?>
<?php include "$layoutPath/navigator-manager.php"; ?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <div class="input-group filter-date  me-4">
                        <span class="input-group-text ps-3 pe-3">
                            <i class="bi bi-calendar-event me-2"></i>
                            Mês
                            <?=$month?>
                        </span>
                        <select onchange="loadDashINFO()" class="form-select" id="month">
                            <option value="01" <?=$month=='01' ? 'selected' : '' ?> >Janeiro</option>
                            <option value="02" <?=$month=='02' ? 'selected' : '' ?>>Fevereiro</option>
                            <option value="03" <?=$month=='03' ? 'selected' : '' ?>>Março</option>
                            <option value="04" <?=$month=='04' ? 'selected' : '' ?>>Abril</option>
                            <option value="05" <?=$month=='05' ? 'selected' : '' ?>>Maio</option>
                            <option value="06" <?=$month=='06' ? 'selected' : '' ?>>Junho</option>
                            <option value="07" <?=$month=='07' ? 'selected' : '' ?>>Julho</option>
                            <option value="08" <?=$month=='08' ? 'selected' : '' ?>>Agosto</option>
                            <option value="09" <?=$month=='09' ? 'selected' : '' ?>>Setembro</option>
                            <option value="10" <?=$month=='10' ? 'selected' : '' ?>>Outubro</option>
                            <option value="11" <?=$month=='11' ? 'selected' : '' ?>>Novembro</option>
                            <option value="12" <?=$month=='12' ? 'selected' : '' ?>>Dezembro</option>
                        </select>
                    </div>
                    <div class="input-group filter-date">
                        <span class="input-group-text ps-3 pe-3">
                            <i class="bi bi-calendar-event me-2"></i>
                            Ano
                        </span>
                        <input data-inputmask="'alias': '9999'" oninput="loadDashINFO()" type="text"  id="year" class="form-control" value="<?=$year?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-grow-1 d-flex flex-wrap justify-content-between">
                        <div class="card ct-item-dash-info mb-4">
                            <div class="card-body item-dash-info position-relative">
                                <div class="d-flex h-100 flex-column justify-content-between">
                                    <p class="title">Clientes</p>
                                    <h5 class="content"><b id="clients">0</b></h5>
                                    <p class="mb-0">
                                        <label class="me-2 growth-label">
                                        <i class="bi bi-graph-up-arrow"></i>
                                        <small id="growth-clients">0 %</small>
                                        </label> Este mês
                                    </p>
                                </div>
                                <div class="column-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card ct-item-dash-info mb-4">
                            <div class="card-body item-dash-info position-relative">
                                <div class="d-flex h-100 flex-column justify-content-between">
                                    <p class="title">Pedidos Entregues</p>
                                    <h5 class="content"><b id="orders">0</b></h5>
                                    <p class="mb-0">
                                        <label class="me-2 growth-label">
                                            <i class="bi bi-graph-up-arrow"></i>
                                            <small id="growth-orders">0 %</small>
                                        </label> Este mês
                                    </p>
                                </div>
                                <div class="column-icon">
                                    <i class="bi bi-cart-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card ct-item-dash-info mb-4">
                            <div class="card-body item-dash-info position-relative">
                                <div class="d-flex h-100 flex-column justify-content-between">
                                    <p class="title">Receita</p>
                                    <h5 class="content"><b id="revenue">R$ 0</b></h5>
                                    <p class="mb-0">
                                        <label class="me-2 growth-label">
                                            <i class="bi bi-graph-up-arrow"></i>
                                            <small id="growth-revenue">0 %</small>
                                        </label> Este mês
                                    </p>
                                </div>
                                <div class="column-icon">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card ct-item-dash-info mb-4">
                            <div class="card-body item-dash-info position-relative">
                                <div class="d-flex h-100 flex-column justify-content-between">
                                    <p class="title">Crescimento</p>
                                    <h5 class="content"><b id="growth">0 %</b></h5>
                                    <p class="mb-0">
                                        Este mês
                                    </p>
                                </div>
                                <div class="column-icon">
                                    <i class="bi bi-activity"></i>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer-manager.php"; ?>
<script src="<?=$baseUrl?>assets/js/views-management/dashboard.js"> </script>
</body>

</html>

