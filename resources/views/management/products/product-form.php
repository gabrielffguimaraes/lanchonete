<?php
$layoutPath = __DIR__ . "/../../layouts";

if(isset($edit) && $edit = true) {
    if(empty($product)) {
        header("Location: {$url}management/products/add?invalid&message=Produto não encontrado para edição");
        exit;
    }
}
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
                    <h2>Formulário de cadastro de produto</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area pt-3">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=$baseUrl?>management/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=$baseUrl?>management/products">Produtos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Formulário</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mb-4 mt-3">
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
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="bi bi-bag-plus me-2"></i>
                        Adicionar novo produto
                    </div>
                    <div class="card-body text-primary">
                        <form id="form-product">
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição do produto</label>
                                <input type="text" class="form-control" id="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoria</label>
                                <select id="category" class="form-select" required>
                                    <option selected disabled>Selecione</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ingredient" class="form-label">Ingredientes</label>
                                <input placeholder="Exp:. Tomate , Cebola , Pimentão" required type="text" class="form-control" id="ingredient">
                            </div>
                            <div class="mb-3" style="max-width: 140px">
                                <label for="price" class="form-label">Preço</label>
                                <input data-inputmask="'alias' : 'currency'" required class="form-control" id="price">
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer.php"; ?>
<script src="<?=$baseUrl?>assets/js/views-management/product-form.js"> </script>
</body>

</html>

