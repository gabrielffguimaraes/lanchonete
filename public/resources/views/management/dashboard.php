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
                    <h2>Dashboard</h2>
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
                <h1>Homepage</h1>
            </div>
        </div>
    </div>
</div>
<?php include "$layoutPath/footer.php"; ?>
</body>

</html>

