<? include('layouts/header.php') ?>
<script>
    var basicAuth = "<?=$credentials?>";

    $.ajax({
        url: "http://localhost/slim/api/",
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': basicAuth
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.log(error);
        }
    });
</script>