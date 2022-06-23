var params = getParams("#ingredients-script");
var productLoaded = {};
window.addEventListener("load",()=> {
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
            let src = getProductSrc(product);
            productLoaded = product;
            let html = `
                <div style="width: 250px">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="${src}" alt="">
                        </div>
                        <h2><a href="">${product.description}</a></h2>
                        <div class="product-carousel-price">
                            <ins>$ ${product.price}</ins> 
                            <!--<del>$999.00</del>-->
                            <div class="quantity buttons_added">
                                <input type="button" class="minus" onclick="minus(this.nextElementSibling)" value="-">
                                <input type="number" value="${params.quantity > 0 ? params.quantity : 1}" id="quantity" size="4" class="input-text qty text" title="Qty" value="1" min="0" step="1">
                                <input type="button" class="plus" onclick="plus(this.previousElementSibling)" value="+">
                            </div>
                        </div>

                        <div class="product-option-shop">
                            <button class="add_to_cart_button" onclick="addProductToCart()">Adicionar ao carrinho</button>
                        </div>
                        
                    </div>
                </div>
            `;

            let ingredients = "";
            product.ingredient.forEach(ingredient => {
                ingredients += `
                    <tr class="cart_item" onclick="this.querySelector('input').click()">
                        <td width="50">
                            <div class="form-check">
                                <input class="form-check-input no-events" type="checkbox" value="${ingredient.id}" name="ingredients">
                            </div>
                        </td>
                        <td class="product-name">
                            <label>${ingredient.description}</label>
                        </td>
                    </tr>
                `;
            });
            $(".product-area").html(html);
            $("#tbody-ingredients").html(ingredients);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function addProductToCart() {
    let cart = new Cart();
    let product = {
        ingredient:getIngredients(),
        quantity:$("#quantity").val()
    }
    Object.assign(productLoaded , product)
    cart.addProduct(productLoaded);
    alert("Produto adicionado com sucesso .");
    window.location.href = Enviroments.baseUrl+"cart";
}
function getIngredients() {
    return [...document.getElementsByName('ingredients')]
        .filter(el => el.checked)
        .map(el => el.value)
}
