<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?=$baseUrl?>assets/css/cart.css">
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
                    <h2>Carrinho de Compras</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area ">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce d-none">
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Produto</th>
                                    <th class="product-price">Preço</th>
                                    <th class="product-quantity">Quantidade</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody id="tbody-cart">
                                <!--
                                <tr>
                                    <td class="actions" colspan="6">
                                        <div class="coupon">
                                            <label for="coupon_code">Cupom:</label>
                                            <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                                            <input type="submit" value="Aplicar" name="apply_coupon" class="button">
                                        </div>
                                    </td>
                                </tr>
                                -->
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">
                            <div class="cross-sells">
                                <h2>Cálculo de Frete</h2>
                                <form>
                                    <div class="coupon">
                                        <label for="cep">CEP:</label>
                                        <input type="text" placeholder="00000-000" value="" id="cep" class="input-text"
                                               name="cep">
                                        <input type="submit" id="btn-frete" value="CALCULAR" class="button">
                                    </div>
                                </form>
                            </div>
                            <div class="cart_totals ">
                                <h2>Resumo da Compra</h2>
                                <table cellspacing="0">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td><span class="amount" id="subtotal">R$ 0,00</span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Frete</th>
                                        <td id="frete">R$ 0,00</td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="amount" id="total-geral">R$ 0,00</span></strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="pull-right">
                            <button id="btn-proceed" onclick=window.location.href="<?= $baseUrl ?>payment" type="submit" name="proceed"
                                    class="checkout-button button alt wc-forward">Finalizar Compra
                            </button>
                        </div>

                    </div>
                    <div class="empty-cart d-none">
                        <div class="mb-3">
                            <i class="bi bi-cart-x icon-cart"></i>
                        </div>
                        <h4>SEU CARRINHO ESTÁ VAZIO</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= $baseUrl ?>assets/js/views/shopping-cart.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

