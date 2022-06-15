<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul >
                        <?php if($authorization != "") {?>

                        <li class="dropdown dropdown-small">
                            <a href="<?=$baseUrl?>my-account" data-bs-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-user"></i>
                                Olá , <?=$name?>
                                <br/>
                                Minha Conta
                            </a>
                            <ul class="dropdown-menu border-1" aria-labelledby="moeda-item-menu" >
                                <li><a href="<?=$baseUrl?>my-addresses">ENDEREÇOS</a></li>
                                <li><a href="<?=$baseUrl?>my-orders">MEUS PEDIDOS</a></li>
                            </ul>
                        </li>

                        <?php } ?>
                        <!--
                        <li><a href="#"><i class="fa fa-heart"></i> Lista de Desejos</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i> Meu Carrinho</a></li>
                        -->
                        <?php if($authorization == "") {?>
                        <li><a href="<?=$baseUrl?>login"><i class="fa fa-lock"></i> Login</a></li>
                        <li><a href="<?=$baseUrl?>login"><i class="fa fa-lock"></i> Register</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline d-flex justify-content-end">
                        <!--
                        <li class="dropdown dropdown-small">
                            <a id="moeda-item-menu" data-bs-toggle="dropdown" class="dropdown-toggle" href="#"  aria-expanded="false"><span class="key">moeda :</span><span class="value">BRL </span><b class="caret"></b></a>
                            <ul class="dropdown-menu border-1" aria-labelledby="moeda-item-menu" >
                                <li><a href="#">BRL</a></li>
                                <li><a href="#">USD</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small">
                            <a id="language-item-menu" data-bs-toggle="dropdown" class="dropdown-toggle" href="#"  aria-expanded="false">
                                <span class="key">linguagem :</span><span class="value">Português </span><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu border-1" aria-labelledby="moeda-item-menu" >
                                <li><a href="#">Português</a></li>
                                <li><a href="#">Inglês</a></li>
                                <li><a href="#">Espanhol</a></li>
                            </ul>
                        </li>-->
                        <?php if($authorization != "") {?>
                        <li>
                            <form id="form-logout" method="post" action="<?=$baseUrl?>logout">
                                <a href="#" id="btn-logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
                            </form>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

