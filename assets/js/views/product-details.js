let params;
let inmemoryProduct = {};
document.getElementById("add_to_cart_button").addEventListener("click",()=>{
    event.preventDefault();
    event.stopPropagation();
    let quantity = $("#quantity").val();
    if (Object.keys(inmemoryProduct).length > 0) {
       let cart = new Cart();
       inmemoryProduct.quantity = quantity;
       cart.addProduct(inmemoryProduct);
       alert("Produto adicionado com sucesso");
       location.href = `${Enviroments.baseUrl}cart`;
    } else alert("Produto inválido");
});
window.addEventListener("load",()=> {
    params = getParams("#script-product-detail");
    if(!params['product-id']) {
        alert("Produto não encontrado");
        location.href=Enviroments.baseUrl;
    }
    carregarProdutos();
    carregarProduto(params['product-id']);
});
function carregarProduto(id) {
    $.ajax({
        url: `${Enviroments.baseHttp}client/product/${id}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (product) {
            inmemoryProduct = product;
            product.price = parseFloat(product.price);
            $(".category-product").each((i,elementRef)=>{
                elementRef.innerHTML = product.category[0].description;
            });
            $(".description-product").each((i,elementRef)=>{
                elementRef.innerHTML = product.description;
            });
            $("#price-product").html(money(product.price));
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function carregarProdutos() {
    event.preventDefault();
    let description = $("#product-name").val();
    $.ajax({
        url: `${Enviroments.baseHttp}client/product?limit=10&description=${description}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result["data"].forEach((product)=>{
                /*let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");*/
                product.price = parseFloat(product.price);
                html += `
                    <div class="thubmnail-recent">
                        <img src="${Enviroments.baseUrl}assets/img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="${Enviroments.baseUrl}product/${product.id}/details">${product.description}</a></h2>
                        <div class="product-sidebar-price">
                            <ins>${money(product.price)}</ins> 
                            <!--<del>$100.00</del>-->
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
