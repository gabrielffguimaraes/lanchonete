<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
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
                    <h2>Esqueceu a Senha ?</h2>
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
                <div id="msg-error" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                    <span></span>
                    <button onclick="$('#msg-error').addClass('d-none')" type="button" class="btn-close"  aria-label="Close"></button>
                </div>
                <form id="login-form-wrap" class="login" method="post">
                    <h2>Recuperar senha</h2>
                    <p class="form-row form-row-first">
                        <label for="email">E-mail <span class="required">*</span>
                        </label>
                        <input type="email" required id="email" name="email" class="input-text" style="width:350px">
                    </p>
                    <div class="clear"></div>
                    <p class="form-row">
                        <input id="btn-recover" type="submit" value="Enviar" class="button">
                    </p>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?=$baseUrl?>assets/js/views/forgot.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

