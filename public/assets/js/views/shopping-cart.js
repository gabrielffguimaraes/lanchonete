var frete = 0;
const cart = new Cart();

window.addEventListener("load",() => {
    loadCart();
    loadAmountBox();
    controlCurrentView();
    document.getElementById("btn-frete").addEventListener("click",() => {
        event.preventDefault();
        let cep = $("#cep").val();
        $.ajax({
            url: `${Enviroments.baseHttp}order/frete/${cep}`,
            type: 'GET',
            dataType: 'json',
            headers: {
                /*'Authorization': `${Enviroments.authorization}`*/
                'Authorization': `${Enviroments.authorization}`
            },
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                frete = parseFloat(response.valor[0].replace(",","."));
                loadAmountBox();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
function loadCart() {
    let html = "";
    cart.getCart().forEach((product,i) => {
        html += `
            <tr class="cart_item">
                <td class="product-remove">
                    <a onclick="remove(this,${i})" title="Remove this item" class="remove" href="javascript:void(0)">×</a>
                </td>
    
                <td class="product-thumbnail">
                    <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/product-thumb-2.jpg"></a>
                </td>
    
                <td class="product-name">
                    <a href="single-product.html">${product.description}</a>
                </td>
    
                <td class="product-price">
                    <span class="amount">${money(parseFloat(product.price))}</span>
                </td>
    
                <td class="product-quantity">
                    <div class="quantity buttons_added">
                        <input type="button" class="minus" value="-" onclick="minus(this.nextElementSibling,${i}),updateAmount(this,${i})">
                        <input type="number" size="4" readonly class="input-text qty text" title="Qty" value="${product.quantity}" min="0" step="1">
                        <input type="button" class="plus" value="+" onclick="plus(this.previousElementSibling,${i}),updateAmount(this,${i})">
                    </div>
                </td>
    
                <td class="product-subtotal">
                    <span class="amount amount-total">${money(parseFloat(product.price) * product.quantity)}</span>
                </td>
            </tr>
        `;
    });
    $("#tbody-cart").html(html);
}
function remove(e,indice) {
    cart.removeProduct(indice);
    loadCart();
    loadAmountBox();
    controlCurrentView();
}
function updateAmount(e,indice) {
    let product = cart.getCart()[indice];
    loadAmountBox();
    /* total per line */
    e.closest("tr").querySelector(".amount-total").innerHTML = money(product.price * product.quantity);
}
function loadAmountBox() {
    let subtotal = cart.getValues().total;
    let total = subtotal + frete;
    $("#subtotal").html(money(subtotal));
    $("#frete").html(money(frete));
    $("#total-geral").html(money(total));
}
function controlCurrentView() {
    $(".empty-cart").addClass("d-none");
    $(".woocommerce").addClass("d-none");
    if (cart.getValues().size <= 0) {
        $(".empty-cart").removeClass("d-none");
    } else $(".woocommerce").removeClass("d-none");
}