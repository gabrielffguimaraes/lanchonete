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
                    <h2>Login</h2>
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
                <?php if(isset($_GET['invalid'])){?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?=$_GET['message']?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <form id="login-form-wrap" class="login" method="post" action="login">
                    <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>">
                    <h2>Acessar</h2>
                    <p class="form-row form-row-first">
                        <label for="username">Login <span class="required">*</span>
                        </label>
                        <input required type="text" id="username" name="username" class="input-text">
                    </p>
                    <p class="form-row form-row-last">
                        <label for="password">Senha <span class="required">*</span>
                        </label>
                        <input required type="password" id="password" name="password" class="input-text">
                    </p>
                    <div class="clear"></div>
                    <p class="form-row">
                        <input type="submit" value="Login" name="login" class="button">
                    </p>
                    <div class="clear"></div>
                    <p class="lost_password">
                        <a href="<?=$baseUrl?>forgot">Esqueceu a senha?</a>
                    </p>
                </form>
            </div>
            <div class="col-md-6">
                <form id="register-form-wrap" class="register" method="post" action="register">
                    <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>">
                    <h2>Criar conta</h2>
                    <p class="form-row form-row-first">
                        <label for="complete-name">Nome Completo <span class="required">*</span>
                        </label>
                        <input required type="text" id="complete-name" name="complete-name" class="input-text">
                    </p>
                    <p class="form-row form-row-first">
                        <label for="email">E-mail <span class="required">*</span>
                        </label>
                        <input required type="email" id="email" name="email" class="input-text">
                    </p>
                    <p class="form-row form-row-first">
                        <label for="username-register">Login <span class="required">*</span>
                        </label>
                        <input required type="text" id="username-register" name="username-register" class="input-text">
                    </p>
                    <p class="form-row form-row-last">
                        <label for="password-register">Password <span class="required">*</span>
                        </label>
                        <input required type="password" id="password-register" name="password-register" class="input-text">
                    </p>
                    <div class="clear"></div>

                    <p class="form-row">
                        <input type="submit" value="Criar Conta" name="login" class="button">
                    </p>

                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?=$baseUrl?>assets/js/views/login.js"></script>
<?php include "layouts/footer.php"; ?>
</body>

</html>

