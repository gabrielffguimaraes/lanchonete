

window.addEventListener("load",() => {
    const cart = new Cart();
    let details = ``;
    let subtotal = 0;
    let total = 0;
    let frete = 0;
    cart.getCart().forEach((product) => {
        let totalPerProduct = product.price * product.quantity;
        details += `
            <tr class="cart_item">
                <td class="product-name">
                    ${product.description} <strong class="product-quantity">× ${product.quantity}</strong> </td>
                <td class="product-total">
                    <span class="amount">${money(totalPerProduct,"pt-Br","BRL")}</span>
                </td>
            </tr>
        `;

        subtotal += parseFloat(totalPerProduct);
        total = subtotal +  frete;
    })
    $("#tbody-products").html(details);
    $("#subtotal").html(money(subtotal,"pt-Br","BRL"));
    $("#total").html(money(total,"pt-Br","BRL"));
});
function money(n,place,currency) {
    return n.toLocaleString(place,{style:"currency",currency:currency});
}