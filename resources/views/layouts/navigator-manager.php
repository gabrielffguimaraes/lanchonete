<?php if($userLogged && $userLogged["role"] == "employee") {?>
<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="<?=$baseUrl?>management/dashboard">Home</a>
                            <a class="nav-link" href="<?=$baseUrl?>management/products">Produtos</a>
                            <a class="nav-link" href="<?=$baseUrl?>management/orders">Pedidos</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div> <!-- End mainmenu area -->
<?php } ?>
