document.getElementById("form-product").addEventListener("submit",function() {
    event.preventDefault();
    event.stopPropagation();

    let price = $("#price").val();
    price = price.replace("$","").replace(/[,]/g,"").trim();

    let form = new FormData(this);
    form.set("price",price);
    $.ajax({
        url: `${Enviroments.baseHttp}product`,
        type: 'POST',
        data: form,
        cache: false,
        processData:false,
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: false,
        success: function (result) {
            alert(result);
            $("#form-product").trigger("reset");
        },
        error: function (error) {
            alert(error.responseJSON)
        }
    });
});
window.addEventListener("load",function() {
    $(":input").inputmask();
    loadCategories();
});
function loadCategories() {
    $.ajax({
        url: `${Enviroments.baseHttp}category`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "<option value selected disabled>Selecione</option>";
            result.forEach((category) => {
                let value = $("#category").attr("value");
                html += `<option ${category.id == value ? "selected" : ""} value="${category.id}">${category.description}</option>`;
            });
            $("#category").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
/* controls upload fotos*/
$(function () {
    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-trash"></span>');
    }).on('click', '.btn-remove', function (e) {
        $(this).parents('.entry:first').remove();
        e.preventDefault();
        return false;
    });
});