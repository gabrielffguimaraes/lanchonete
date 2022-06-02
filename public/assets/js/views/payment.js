
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
    });
    addressesList();
    $("#tbody-products").html(details);
    $("#subtotal").html(money(subtotal,"pt-Br","BRL"));
    $("#total").html(money(total,"pt-Br","BRL"));
});
function money(n,place,currency) {
    return n.toLocaleString(place,{style:"currency",currency:currency});
}
function addressesList() {

    $.ajax({
        url: `${Enviroments.baseHttp}client/address`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (addresses) {
            console.log(addresses);
            /*
            let html = `
                <div className="accordion-item">
                    <h2 className="accordion-header" id="headingOne">
                        <button className="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                            <div className="form-check">
                                <input className="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                       value="option1" checked>
                                    <label className="form-check-label mb-0 mt-1" htmlFor="exampleRadios1">
                                        Endereço
                                    </label>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" className="accordion-collapse collapse show"
                         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div className="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is
                            shown by default, until the collapse plugin adds the appropriate
                            classes that we use to style each element. These classes control the
                            overall appearance, as well as the showing and hiding via CSS
                            transitions. You can modify any of this with custom CSS or
                            overriding our default variables. It's also worth noting that just
                            about any HTML can go within the <code>.accordion-body</code>,
                            though the transition does limit overflow.
                        </div>
                    </div>
                </div>
            `;
            $("#tbody-").html(ingredients);*/
        },
        error: function (error) {
            console.log(error);
        }
    });
}