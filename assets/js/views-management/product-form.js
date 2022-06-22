var flag = "add";
var params = {};
var inmemoryProduct = {};
var deleteGalery = [];
var deleteMainPhoto = false;
window.addEventListener("load",function() {
    params = getParams("#product-form-script");
    flag = params.edit == 1 ? "edit" : "add";
    $(":input").inputmask();
    loadCategories();
    if(flag == "edit") {
        loadProductById(params['id-product'],(product) => {
            inmemoryProduct = product;
            /* load main product*/
            let src = getProductSrc(product);
            $("#main-photo").attr("src",src)
            $("#btn-delete-main").click(function(btn){
                deleteMainPhoto = true;
                btn.target.parentNode.remove();
            });

            /* load galery products*/
            let galeryPhotos = "";
            product.galery.forEach(photo => {
                let src =  `${Enviroments.baseHttp}uploads/${photo.name}`;
                galeryPhotos += `
                    <div class="ct-main-img card position-relative mb-3 me-3">
                        <button onclick="deleteImg(this,${photo.id})" type="button" class="btn-close btn-delete-galery" aria-label="Close"></button>
                        <img src="${src}" class="galery-photo">
                    </div>
                `;
            });
            $("#galery-photos").html(galeryPhotos);
        });
    }
});
//FORM ACTION
document.getElementById("form-product")?.addEventListener("submit",function() {
    event.preventDefault();
    event.stopPropagation();

    let price = $("#price").val();
    price = price.replace("$","").replace(/[,]/g,"").trim();

    let priceFake = $("#price-fake").val();
    priceFake = priceFake.replace("$","").replace(/[,]/g,"").trim();

    let data = new FormData(this);
    data.set("price",price);
    data.set("price-fake",priceFake);
    if(flag == "add") {
        addProduct(data);
    } else {
        data.set("deletePhotos",deleteGalery);
        data.set("deleteMainPhoto",deleteMainPhoto)
        updateProduct(data);
    }
});

function deleteImg(elementRef,id) {
    if(id) {
        deleteGalery.push(id);
        elementRef.parentNode.remove();
    }
}

function loadProductById(id,callback) {
    $.get(`${Enviroments.baseHttp}product/${id}`,(product)=>{
        callback(product);
    },"JSON");
}
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
function addProduct(data) {
    $.ajax({
        url: `${Enviroments.baseHttp}product`,
        type: 'POST',
        data,
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
}
function updateProduct(data) {

    $.ajax({
        url: `${Enviroments.baseHttp}product/${params['id-product']}`,
        type: 'POST',
        data,
        dataType: 'json',
        cache: false,
        processData:false,
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: false,
        success: function (result) {
            alert(result);
            window.location.reload();
        },
        error: function (error) {
            alert(error.responseJSON)
        }
    });
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