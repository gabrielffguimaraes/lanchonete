document.getElementById("form-product").addEventListener("submit",function() {
    event.preventDefault();
    event.stopPropagation();
    let description = $("#description").val();
    let category = $("#category").val();
    let ingredients = $("#ingredient").val().split(",");
    let price = $("#price").val();
    price = price.replace("$","").replace(/[,]/g,"").trim();

    $.ajax({
        url: `${Enviroments.baseHttp}product`,
        type: 'POST',
        dataType: 'json',
        data:JSON.stringify({
           description,
           category,
           ingredients,
           price
        }),
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
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
            result.forEach((ingredient) => {
                html += `<option value="${ingredient.id}">${ingredient.description}</option>`;
            });
            $("#category").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
