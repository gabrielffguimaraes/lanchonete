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
            result.forEach((product)=>{
                let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");
                html += `
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="${Enviroments.baseUrl}assets/img/product-2.jpg" alt="">
                        </div>
                        <h2><a href="">${product.description}</a></h2>
                        <div class="product-carousel-price">
                            <ins>$ ${product.price}</ins> 
                            <p style="font-style: italic">${(ingredients != "") ? ingredients+" ." : ingredients}</p>
                            <!--<del>$999.00</del>-->
                        </div>

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="./product/${product.id}/ingredients">Add to cart</a>
                        </div>
                    </div>
                </div>
                `;
            })
            $("#products").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
window.addEventListener("load",()=> {
    carregarProdutos();
})