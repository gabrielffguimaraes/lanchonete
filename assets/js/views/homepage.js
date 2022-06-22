
function carregarProdutos() {
    $.ajax({
        url: `${Enviroments.baseHttp}client/product`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result["data"].forEach((product)=>{
                product.price = parseFloat(product.price);
                let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");
                html += `
                <div class="single-product">
                    <div class="product-f-image">
                        <img src="${Enviroments.baseHttp}uploads/${product.foto[0]['name']}" alt="">
                        <div class="product-hover">
                            <a href="${Enviroments.baseUrl}product/${product.id}/ingredients" class="add-to-cart-link" style="font-size: 10px!important;white-space:nowrap"><i class="fa fa-shopping-cart"></i> Adicionar ao carrinho</a>
                            <a href="${Enviroments.baseUrl}product/${product.id}/details" class="view-details-link" style="font-size: 10px!important;white-space:nowrap"><i class="fa fa-link"></i> Ver detalhes</a>
                        </div>
                    </div>

                    <h2><a href="${Enviroments.baseUrl}product/${product.id}/details">${product.description}</a></h2>

                    <div class="product-carousel-price">
                        <ins>${money(product.price)}</ins> 
                        <p style="font-style: italic;color:#666;font-weight: normal !important;">
                            ${(ingredients != "") ? ingredients+" ." : ingredients}
                        </p>
                        <!--<del>$100.00</del>-->
                    </div>
                </div>               
                `;
            })
            $("#products").html(html);
            reloadProductCarousel();
        },
        error: function (error) {
            console.log(error);
        }
    })
}
window.addEventListener("load",()=> {
    carregarProdutos();
})
