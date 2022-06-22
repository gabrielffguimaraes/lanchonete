<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <?php include "layouts/head.php"; ?>
    <link rel="stylesheet" href="<?=$baseUrl?>assets/css/choose-ingredients.css">
</head>
<body>
    <?php include "layouts/menu-client.php"; ?>
    <?php include "layouts/header.php"; ?>
    <?php include "layouts/navigator-client.php"; ?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Selecione os Ingredientes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="product-area">.</div>
        <div class="choose-ingredient-area">
            <table cellspacing="0" class="shop_table cart">
                <tbody id="tbody-ingredients">
                    <!-- ingredents -->
                </tbody>
            </table>

        </div>
    </div>
    <script id="ingredients-script"
            src="<?=$baseUrl?>assets/js/views/choose-ingredients.js"
            product-id="<?=$productId?>"
            quantity="<?=$_GET['quantity']?>"
    >
    </script>
    <?php include "layouts/footer.php"; ?>
</body>

</html>

