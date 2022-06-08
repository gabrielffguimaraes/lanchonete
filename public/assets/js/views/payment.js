/* payment function */
document.getElementById("address-form").addEventListener("submit" , () => {
    event.preventDefault();
    let cep = $("#billing_cep").val();
    let address = $("#billing_address").val();
    let complement = $("#billing_complement").val();
    let city = $("#billing_city").val();
    let estado = $("#billing_state").val();
    let country = $("#billing_country").val();

    $.ajax({
        url: `${Enviroments.baseHttp}client/address`,
        type: 'POST',
        data: JSON.stringify({
            cep,
            address,
            complement,
            city,
            uf:estado,
            country
        }),
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert("Endereço cadastrado com sucesso");
            $("#address-form").trigger("reset");
            $("#accordion-add").toggle();
            addressesList();
        },
        error: function (error) {
            console.log(error);
            alert("Ocorreu um erro ao adicionar endereço , por favor tente novamente mais tarde .")
        }
    });
});
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
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            const cart = new Cart();
            cart.clearCart();
            alert("Seu pedido foi realizado com sucesso você será redirecionado para a pagina de pedidos .");
            window.location.href = `${Enviroments.baseUrl}client/order`;
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
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (addresses) {
            let html = ``;
            addresses.forEach((address,i)=>{
                html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-end-${i}">
                            <input type="radio" name="address" value="${address.client_id}">&nbsp;&nbsp;&nbsp;
                            ENDEREÇO ${i+1}
                        </button>
                    </h2>
                    <div id="accordion-end-${i}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p><strong>CEP °</strong> : ${address.cep}</p>
                            <p><strong>Endereço</strong> : ${address.address}</p>
                            <p><strong>Complemento</strong> : ${address.complement}</p>
                            <p><strong>Cidade</strong> : ${address.city}</p>
                            <p><strong>Estado</strong> : ${address.uf}</p>
                            <p><strong>Pais</strong> : ${address.country}</p>
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
