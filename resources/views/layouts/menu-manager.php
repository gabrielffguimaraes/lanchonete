<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul >
                        <?php if($userLogged  && $userLogged["role"] == "employee") {?>
                            <li class="dropdown dropdown-small">
                                <a href="javascript:void(0)"><i class="fa fa-user"></i>
                                    Olá , <?=$name?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline d-flex justify-content-end">
                        <?php if($userLogged   && $userLogged["role"] == "employee") {?>
                            <li>
                                <form id="form-logout" method="post" action="<?=$baseUrl?>logout?redirect=management/login">
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

