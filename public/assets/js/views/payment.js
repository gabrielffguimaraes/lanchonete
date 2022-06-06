/* payment function */
document.getElementById("place_order").addEventListener("click",()=>{
    const cart = new Cart();
    let cartSend = cart.getCart();
    cartSend.forEach((item) => {
        item.category = item.category[0].id
    });
    let addressId = $("input[name=address]:checked").val();
    if(!addressId) {
        alert("Endereço obrigatório");
        return
    }
    $.ajax({
        url: `${Enviroments.baseHttp}order`,
        type: 'POST',
        data: JSON.stringify({
            cart:cartSend,
            address_id:addressId
        }),
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `Basic ${btoa("admin:admin")}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            console.log(response)
        },
        error: function (error) {
            console.log(error);
        }
    });
});
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
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `Basic ${btoa("admin:admin")}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (addresses) {
            let html = ``;
            addresses.forEach((address,i)=>{
                html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <input type="radio" name="address" value="${address.client_id}">&nbsp;&nbsp;&nbsp;
                            ENDEREÇO ${i+1}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><strong>N °</strong> : ${address.number}</p>
                            <p><strong>Rua</strong> : ${address.street}</p>
                            <p><strong>Bairro</strong> : ${address.district}</p>
                            <p><strong>Cidade</strong> : ${address.city}</p>
                            <p><strong>Estado</strong> : ${address.uf}</p>
                            <p><strong>Ponto de referencia</strong> : ${address.ref}</p>
                        </div>
                    </div>
                </div>
            `;
            });
            $("#addresses").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
