<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/payment.css">
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
                    <h2>Pagamento</h2>
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
                <div class="product-content-right">
                    <div id="customer_details" class="col2-set">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="woocommerce-billing-fields">
                                    <h3>Cadastro de endereço</h3>
                                    <div class="accordion-item mb-5">
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-add">
                                                        FORMULÁRIO DE CADASTRO DE ENDEREÇO
                                                    </button>
                                                </h2>
                                                <div id="accordion-add" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                            <label class="" for="billing_address_1">Cep <abbr title="required" class="required">*</abbr>
                                                            </label>
                                                            <input type="text" value="" placeholder="00000-000" id="billing_address_1" name="billing_address_1" class="input-text ">
                                                        </p>

                                                        <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                            <label class="" for="billing_address_1">Endereço <abbr title="required" class="required">*</abbr>
                                                            </label>
                                                            <input type="text" value="" placeholder="Logradouro, número e bairro" id="billing_address_1" name="billing_address_1" class="input-text ">
                                                        </p>

                                                        <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                                            <input type="text" value="" placeholder="Complemento (opcional)" id="billing_address_2" name="billing_address_2" class="input-text ">
                                                        </p>

                                                        <p id="billing_city_field" class="form-row form-row-wide address-field validate-required" data-o_class="form-row form-row-wide address-field validate-required">
                                                            <label class="" for="billing_city">Cidade <abbr title="required" class="required">*</abbr>
                                                            </label>
                                                            <input type="text" value="" placeholder="Cidade" id="billing_city" name="billing_city" class="input-text ">
                                                        </p>

                                                        <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                                            <label class="" for="billing_state">Estado</label>
                                                            <input type="text" id="billing_state" name="billing_state" placeholder="Estado" value="" class="input-text ">
                                                        </p>

                                                        <p id="billing_state_field" class="form-row form-row-first address-field validate-state" data-o_class="form-row form-row-first address-field validate-state">
                                                            <label class="" for="billing_state">País</label>
                                                            <input type="text" id="billing_state" name="billing_state" placeholder="País" value="" class="input-text ">
                                                        </p>
                                                        <button type="submit"  id="btn-add-address" class="button alt">ADICIONAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3>Meus Endereços</h3>
                                    <div class="accordion" id="addresses">

                                    </div>

                                    <div class="clear"></div>
                                    <h3 id="order_review_heading" class="mt-5">Detalhes do Pedido</h3>
                                    <div id="order_review" style="position: relative;">
                                        <table class="shop_table">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Produto</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody-products">
                                            <!-- tbody of products -->
                                            </tbody>
                                            <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span id="subtotal" class="amount">R$ 0,00</span>
                                                </td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Frete</th>
                                                <td>
                                                    R$ 0,00
                                                    <input type="hidden" class="shipping_method" value="free_shipping"
                                                           id="shipping_method_0" data-index="0"
                                                           name="shipping_method[0]">
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total do Pedido</th>
                                                <td><strong><span id="total" class="amount">R$ 0,00</span></strong></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div id="payment">
                                            <div class="form-row place-order">
                                                <input type="submit" data-value="Place order" value="Pagar"
                                                       id="place_order" name="woocommerce_checkout_place_order"
                                                       class="button alt">
                                            </div>
                                            <div class="clear"></div>
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

<script src="<?= $baseUrl ?>assets/js/views/payment.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

