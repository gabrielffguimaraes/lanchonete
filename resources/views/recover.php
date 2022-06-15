<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/recover.css">
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
                    <h2>Recuperar Senha</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <form id="register-form-wrap" class="login" method="post" action="login">
                    <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>">
                    <h2>Recuperar</h2>
                    <p class="form-row form-row-first">
                        <label for="username">Login <span class="required">*</span>
                        </label>
                        <input type="text" disabled id="username" name="username" class="input-text">
                    </p>
                    <p class="form-row form-row-last">
                        <label for="password">Nova Senha <span class="required">*</span>
                        </label>
                        <input type="password" id="password" name="password" class="input-text">
                    </p>
                    <p class="form-row form-row-last">
                        <label for="password">Confirmar Senha <span class="required">*</span>
                        </label>
                        <input type="password" id="confirm-password" name="confirm-password" class="input-text">
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
<script src="<?=$baseUrl?>assets/js/views/recover.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

