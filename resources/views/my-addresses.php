<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/my-addresses.css">
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
                    <h2>Meus Endereços</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="accordion">
            <div class="accordion-item mb-5">
                <div class="accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-add" aria-expanded="true">

                                <?=isset($id) ?
                                    '<i class="bi bi-pencil-square"></i> &nbsp; EDITAR ENDEREÇO' :
                                    'FORMULÁRIO DE CADASTRO DE ENDEREÇO'
                                ?>
                            </button>
                        </h2>
                        <div id="accordion-add" class="accordion-collapse collapse show" style="">
                            <div class="accordion-body">
                                <form id="address-form">
                                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                        <label class="" for="billing_cep">Cep <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" required="" placeholder="00000-000" id="billing_cep" name="billing_cep" class="input-text w-100">
                                    </p>

                                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                        <label class="" for="billing_address">Endereço <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" required="" placeholder="Logradouro, número e bairro" id="billing_address" name="billing_address" class="input-text w-100">
                                    </p>

                                    <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                        <input type="text" value="" placeholder="Complemento (opcional)" id="billing_complement" name="billing_complement" class="input-text w-100">
                                    </p>

                                    <p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
                                        <label class="" for="billing_city">Cidade <abbr title="required" class="required">*</abbr>
                                        </label>
                                        <input type="text" value="" required="" placeholder="Cidade" id="billing_city" name="billing_city" class="input-text w-100">
                                    </p>

                                    <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                        <label class="" for="billing_state">Estado</label>
                                        <input type="text" id="billing_state" required="" name="billing_state" placeholder="Estado" value="" class="input-text w-100">
                                    </p>

                                    <p id="billing_country_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                        <label class="" for="billing_country">País</label>
                                        <input type="text" id="billing_country" required="" name="billing_country" placeholder="País" value="" class="input-text w-100">
                                    </p>
                                    <button type="submit" id="btn-add-address" class="button alt">
                                        <?=isset($id) ? 'EDITAR' : 'ADICIONAR'?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="addresses" class="<?=isset($id) ? 'd-none' : ''?>"></div>
        </div>
    </div>
</div>
<script id="address-script"
        src="<?=$baseUrl?>assets/js/views/my-addresses.js"
        address-id="<?=$id?>"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

