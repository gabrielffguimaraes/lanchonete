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
                                    <h3>Endereço de entrega</h3>
                                    <div class="accordion" id="addresses">
                                        <!-- addresses list -->
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

