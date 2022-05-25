function carregarProdutos() {
    $.ajax({
        url: `${config.baseHttp}client/products`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${config.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result.forEach((product)=>{
                html += `
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="${config.baseUrl}assets/img/product-2.jpg" alt="">
                        </div>
                        <h2><a href="">${product.name}</a></h2>
                        <div class="product-carousel-price">
                            <ins>$ ${product.price}</ins> 
                            <!--<del>$999.00</del>-->
                        </div>

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
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