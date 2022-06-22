<?php
$layoutPath = __DIR__ . "/../../layouts";

if(isset($edit) && $edit = true) {
    if(empty($product)) {
        header("Location: {$url}management/products/add?invalid&message=Produto não encontrado para edição");
        exit;
    }
    $product = $product[0];

}
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "$layoutPath/head.php"; ?>
    <link href="<?=$baseUrl?>assets/css/product-form.css" rel="stylesheet"> </link>
</head>
<body>
<?php include "$layoutPath/menu-manager.php"; ?>
<?php include "$layoutPath/navigator-manager.php"; ?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>
                        <?=($edit) ? "Edição de produto" : " Formulário de cadastro de produto" ?>
                    </h2>
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <?=($edit) ? "Edição de produto" : " Formulário" ?>
                        </li>
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
                        <?=($edit) ? "Editando produto : ".$product['description'] : "Adicionar novo produto" ?>
                    </div>
                    <div class="card-body text-primary">
                        <form id="form-product">
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição do produto</label>
                                <input value="<?=$product['description']?>" type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoria</label>
                                <select id="category" value="<?=$product['category'][0]['id']?>" class="form-select"  name="category" required>
                                    <option selected disabled>Selecione</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ingredient" class="form-label">Ingredientes</label>
                                <input value="<?=$product['_ingredients']?>" placeholder="Exp:. Tomate , Cebola , Pimentão" required type="text" class="form-control"  name="ingredients" id="ingredient">
                            </div>
                            <div class="mb-3 ct-price">
                                <label for="price" class="form-label">Preço (real)</label>
                                <input value="<?=$product['price']?>" data-inputmask="'alias' : 'currency'" required class="form-control" id="price" name="price">
                            </div>
                            <div class="mb-3 ct-price">
                                <label for="price-fake" class="form-label price-fake">Preço</label>
                                <input value="<?=$product['price_fake']?>" data-inputmask="'alias' : 'currency'" required class="form-control" id="price-fake" name="price-fake">
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detalhes</label>
                                <textarea class="form-control" id="detail" name="detail" rows="5"><?=$product["detail"]?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label">Revisão</label>
                                <textarea class="form-control" id="review" name="review" rows="5"><?=$product["review"]?></textarea>
                            </div>
                            <div  class="mb-3">
                                <label  class="form-label">Foto principal</label>
                                <?php if($edit && !empty($product['foto'])) { ?>
                                    <div class="ct-main-img card position-relative mb-3">
                                        <button id="btn-delete-main" type="button" class="btn-close" aria-label="Close"></button>
                                        <img src="" id="main-photo">
                                    </div>
                                <?php } ?>
                                <div class="ct-main-photo">
                                    <div class="entry input-group upload-input-group mb-2" >
                                        <input class="form-control" name="foto" type="file">
                                    </div>
                                </div>
                            </div>
                            <div  class="mb-3">
                                <label  class="form-label">Galeria</label>
                                <?php if($edit) { ?>
                                    <div id="galery-photos">

                                    </div>
                                <?php } ?>
                                <div class="controls">
                                    <div class="entry input-group upload-input-group mb-2" >
                                        <input class="form-control" name="fotos[]" type="file">
                                        <button class="btn btn-upload btn-success btn-add" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <?=($edit) ? "Editar produto" : "Adicionar novo produto" ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer.php"; ?>
<script edit="<?=$edit?>" id-product="<?=$id?>" id="product-form-script" src="<?=$baseUrl?>assets/js/views-management/product-form.js"> </script>
</body>

</html>

