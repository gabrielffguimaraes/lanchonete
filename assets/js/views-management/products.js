window.addEventListener("load",function() {
   loadProducts();
});
function loadProducts(offset = 0) {
    offsetAtual = offset;
    $.ajax({
        url: `${Enviroments.baseHttp}client/product?limit=${9999999999999999999}&offset=${0}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result.data.forEach((product)=>{
                let src = getProductSrc(product);
                let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");

                html += `
                <tr>
                    <td>
                        <img  alt="poster_1_up" class="shop_thumbnail" src="${src}">
                    </td>
                    <td>${product.description}</td>
                    <td>${product.category[0].description}</td>
                    <td>${ingredients}</td>
                    <td>${money(parseFloat(product.price))}</td>
                    <td>
                        <a href="products/${product.id}/edit" class="btn btn-warning btn-sm text-white">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button onclick="deleteProduct(${product.id})" class="btn btn-danger btn-sm text-white">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
                `;
            })
            $("#tbody-products").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function deleteProduct(id) {
    $.ajax({
        url: `${Enviroments.baseHttp}product/${id}`,
        type: 'DELETE',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            alert(result);
            loadProducts();
        },
        error: function (error) {
            alert(error.responseJSON);
        }
    });
}