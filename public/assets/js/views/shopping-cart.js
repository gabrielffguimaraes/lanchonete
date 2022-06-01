window.addEventListener("load",() => {
 loadCart();
});
function loadCart() {
    const cart = new Cart();
    let html = "";
    cart.getCart().forEach(product => {

        html += `
            <tr class="cart_item">
                <td class="product-remove">
                    <a title="Remove this item" class="remove" href="#">×</a>
                </td>
    
                <td class="product-thumbnail">
                    <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/product-thumb-2.jpg"></a>
                </td>
    
                <td class="product-name">
                    <a href="single-product.html">${product.description}</a>
                </td>
    
                <td class="product-price">
                    <span class="amount">R$${product.price}</span>
                </td>
    
                <td class="product-quantity">
                    <div class="quantity buttons_added">
                        <input type="button" class="minus" value="-">
                        <input type="number" size="4" class="input-text qty text" title="Qty" value="${product.quantity}" min="0" step="1">
                        <input type="button" class="plus" value="+">
                    </div>
                </td>
    
                <td class="product-subtotal">
                    <span class="amount">R$ ####</span>
                </td>
            </tr>
        `;
    });
    $("#tbody-cart").html(html);
}
