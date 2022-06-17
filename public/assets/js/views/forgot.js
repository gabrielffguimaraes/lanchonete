document.getElementById("login-form-wrap").addEventListener("submit",function() {
    event.preventDefault();
    $("#msg-error").addClass("d-none");
    let email = $("#email").val();
    $("#btn-recover").prop("disabled",true);
    $.ajax({
        url: `${Enviroments.baseHttp}/email?email=${email}`,
        type: 'POST',
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            alert(result);
            $("#btn-recover").prop("disabled",false);
            window.location.href=`${Enviroments.baseUrl}forgot`;
        },
        error: function (error) {
            $("#msg-error").removeClass("d-none");
            $("#msg-error span").html(error.responseJSON)
            alert(error.responseJSON);
            $("#btn-recover").prop("disabled",false);
        }
    });
});
