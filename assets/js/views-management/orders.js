var status = 1;
var xhr = {
    abort : () => {

    }
}
window.addEventListener("load",function() {
    loadStatusTabs();
    loadOrders();
});
function loadStatusTabs() {
    $.ajax({
        url: `${Enviroments.baseHttp}order/status`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            statusList = result;
            let html = "";
            result.forEach((obj,i)=>{
                html += `
                    <li class="nav-item position-relative b-0" onclick="changeTab(this,${obj.id})">
                        <a class="nav-link ${obj.id == status ? 'active' : ''}" href="#">
                            ${obj.description} 
                            <span 
                                 id="qtd-0"
                                 class="badge ${obj.qtd > 0 ? 'text-bg-primary' : 'text-bg-secondary'}">${obj.qtd}</span>
                        </a>
                    </li>
                `;
            });
            $("#tab-hist").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function loadOrders(callback = ()=>{}) {
    xhr.abort();
    xhr = $.ajax({
        url: `${Enviroments.baseHttp}order/manager?status=${status}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";

            result.forEach((order)=>{
                html += `
                <tr>
                    <td>${order['complete_name']}</td>
                    <td>${order['status_description']}</td>
                    <td>${order['created_at']}</td>
                    <td>${money(order['total'])}</td>
                    <td>
                        `;
                    html += `
                            <button title="Ver" 
                                     type="button" 
                                     class="btn btn-sm btn-warning text-white"
                                     onclick="seeOrderDetails(${order['id']})"
                                     >
                                Ver pedido
                            </button>
                        `;
                    if(!order['last']) {
                        html += `<button onclick="updateStatusOrder(${order["id"]})" 
                                         type="button" 
                                         class="btn btn-sm btn-primary">
                                    Avançar status
                                 </button>`;

                    } else {
                        html += `
                                 <button title="${order["status_description"]}" 
                                         type="button" 
                                         class="btn btn-sm btn-success rounded-circle">
                                    <i class="bi bi-check-square"></i>
                                 </button>`;
                    }
                html += `
                    </td>
                </tr>
                `;
            });
            $("#tbody-orders").html(html);
            callback.call();
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function seeOrderDetails(orderId) {
    $("#modal-order-detail").modal("show");
    $.ajax({
        url: `${Enviroments.baseHttp}order/manager?order_id=${orderId}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            order = result[0];
            let price = 0;
            let discount = 0;
            let delivery_fee = 0;
            let html = `
                <div class="order d-flex">
                    <div id="products" class="flex-grow-1">
                        <small> Pedido : ${order.id} </small>
                        `;
            order.products.forEach(product => {
                let srcImg = getProductSrc(product);
                html += ` 
                        <div class="mb-3">
                            <div class="d-flex">
                                <img style="width:186px;height:123px" src="${srcImg}" alt="">
                                <div class="ms-2">
                                    <p>${product.description}</p>
                                    <p><b>${product.quantity} quantidade</b></p>
                                    <p>${product._ingredients}</p>
                                </div>
                            </div>
                        </div>
                `;
                /*
                price += parseFloat(product.price * product.quantity);
                discount += parseFloat(order.discount);
                delivery_fee += parseFloat(order.delivery_fee);*/
            });
            html += `
                    </div>
                    <div class="detail-order text-center"> 
                        <div class="card card-body" style="width: 350px">
                            <div style="width: 100%;height: 100%">
                                <div class="border-right w-100">
                                    <h6 class="text-right">Pagamento</h6>
                                </div>
                                <div class="border-right w-100">
                                    <h6 class="text-right">Total pago</h6>
                                    <div class="text-start p-2">
                                        <p class="mb-0">Subtotal : ${money(price)}</p>
                                        <p class="mb-0">Desconto : ${money(discount)}</p>
                                        <p>Frete : ${money(delivery_fee)}</p>
                                        <hr>
                                        <p>Total : ${money(price+discount+delivery_fee)}</p>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <h6 class="text-right">Endereço</h6>
                                    <div class="text-start p-2">
                                        ${order.address?.address} .                                                    
                                        <br/>
                                        <br/>
                                        ${order.address?.complement}
                                        <br/>
                                        CEP : ${order.address?.cep}
                                        <br/>
                                        ${order.address?.city} ,
                                        ${order.address?.uf} .
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div> 
                </div>                  
            `;
            $("#body-order-details").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function updateStatusOrder(orderId) {
    $.ajax({
        url: `${Enviroments.baseHttp}order/${orderId}/status`,
        type: 'POST',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            alert(result);
            loadOrders(loadStatusTabs);
        },
        error: function (error) {
            alert(error.responseJSON);
        }
    });
}
function changeTab(elementRef,s) {
    status = s;
    $("a").removeClass("active");
    elementRef.querySelector("a").classList.add("active");
    loadOrders();
}
