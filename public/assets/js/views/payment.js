

window.addEventListener("load",() => {
    const cart = new Cart();
    let details = ``;
    cart.getCart().forEach((product) => {
        details += `
            <tr class="cart_item">
                <td class="product-name">
                    Ship Your Idea <strong class="product-quantity">× 1</strong> </td>
                <td class="product-total">
                    <span class="amount">R$15,00</span>
                </td>
            </tr>
        `;

    })


});
