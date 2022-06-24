<?php
    $layoutPath = __DIR__ . "/../layouts";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
</head>
<body>
<?php include "$layoutPath/menu-manager.php"; ?>
<?php include "$layoutPath/navigator-manager.php"; ?>

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
                <?php if(isset($_GET['valid'])){?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$_GET['message']?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <form id="login-form-wrap" class="login" method="post" action="login">
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
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer-manager.php"; ?>
</body>

</html>

