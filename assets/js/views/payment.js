var frete = 0;
var subtotal = 0;
var total = 0;
var frete = 0;
/* payment function */
document.getElementById("address-form").addEventListener("submit" , () => {
    event.preventDefault();
    let name = $("#billing_name").val();
    let cep = $("#billing_cep").val();
    let address = $("#billing_address").val();
    let complement = $("#billing_complement").val();
    let city = $("#billing_city").val();
    let estado = $("#billing_state").val();
    let country = $("#billing_country").val();
    $("#btn-add-address").prop("disabled",true);
    $.ajax({
        url: `${Enviroments.baseHttp}client/address`,
        type: 'POST',
        data: JSON.stringify({
            name,
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
            $("#accordion-add").collapse();
            addressesList();
            $("#btn-add-address").prop("disabled",false);
        },
        error: function (error) {
            alert("Ocorreu um erro ao adicionar endereço , por favor tente novamente mais tarde .");
            $("#btn-add-address").prop("disabled",false);
        }
    });
});
document.getElementById("btn_payment").addEventListener("click",()=>{
    const cart = new Cart();
    let cartSend = cart.getCart();
    cartSend.forEach((item) => {
        item.category = item.category[0].id
    });
    let addressId = $("input[name=address]:checked").val();
    let paymentMethod = $("input[name=payment-form]:checked").val()
    if(!addressId) {
        alert("Endereço obrigatório");
        return
    }
    if(!paymentMethod) {
        alert("Methodo de pagamento obrigatório");
        return
    }
    $("#error-msg").addClass("d-none");
    $("#btn_payment").prop("disabled",true);
    $.ajax({
        url: `${Enviroments.baseHttp}order`,
        type: 'POST',
        data: JSON.stringify({
            cart:cartSend,
            address_id:addressId,
            payment_method:paymentMethod
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
            window.location.href = `${Enviroments.baseUrl}my-orders`;
            $("#btn_payment").prop("disabled",false);
        },
        error: function (error) {
            alert(error.responseJSON);
            $("#error-msg").removeClass("d-none");
            $("#error-msg").html(error.responseJSON);
            $("#btn_payment").prop("disabled",false);
        }
    });
});
window.addEventListener("load",() => {
    const cart = new Cart();
    let details = ``;
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
    $("#subtotal").html(money(subtotal));
    $("#total").html(money(total));
});

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
                            <input type="radio" onclick="loadFrete('${address.cep}')" name="address" value="${address.id}">&nbsp;&nbsp;&nbsp;
                            ${address.name.toUpperCase()}
                        </button>
                    </h2>
                    <div id="accordion-end-${i}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p><strong>Nome</strong> : ${address.name}</p>
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
function loadFrete(cep) {
    $("#error-msg").addClass("d-none");
    $("#frete").html(money(0));
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
            $("#frete").html(money(frete));
            $("#total").html(money(total + frete));
        },
        error: function (error) {
            $("#error-msg").removeClass("d-none");
            $("#error-msg").html(error.responseJSON);
        }
    });
}
