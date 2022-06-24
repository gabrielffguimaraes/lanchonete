var status = 1;
var orderIdLoaded = null;
var xhr = {
    abort : () => {

    }
}
window.addEventListener("load",function() {
    loadStatusTabs();
    loadOrders();
});
function loadStatusTabs() {
    let dini = $("#dini").val();
    let dfim = $("#dfim").val();
    $.ajax({
        url: `${Enviroments.baseHttp}order/status?dini=${dini}&dfim=${dfim}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            result.push(result.shift());
            let html = "";
            result.forEach((obj,i)=>{
                html += `
                    <li class="nav-item position-relative b-0" onclick="changeTab(this,${obj.id})">
                        <a class="nav-link ${obj.id == status ? 'active' : ''}" href="#">
                            ${obj.description} 
                            <span 
                                 id="qtd-0"
                                 class="badge ${obj.qtd > 0 ? 'text-bg-warning text-white' : 'text-bg-secondary'}">${obj.qtd}</span>
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
    let dini = $("#dini").val();
    let dfim = $("#dfim").val();
    xhr.abort();
    xhr = $.ajax({
        url: `${Enviroments.baseHttp}order/manager?status=${status}&dini=${dini}&dfim=${dfim}`,
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
                    if(order['status'] != 0) {
                        if (!order['last']) {
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
    orderIdLoaded = orderId;
    $("#modal-order-detail").modal("show");
    $("#body-order-details").html("");
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
            $("#pedido-id").text(order.id);
            $("#pedido-status").text(order.status_description);
            if(order.status == 0) {
                $(".modal-footer .btn").addClass("d-none");
            } else {
                $(".modal-footer .btn").removeClass("d-none");
            }
            let html = `
                <div class="order d-flex">
                    <div id="products" class="flex-grow-1 scrollbar">
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
                        <hr>
                `;
            });
            html += `
                    </div>
                    <div class="detail-order text-center"> 
                        <div class="card card-body" style="width: 350px;height:100%">
                            <div style="width: 100%;height: 100%">
                                <div class="border-right w-100">
                                    <h6 class="text-left fw-bolder">Pagamento</h6>
                                </div>
                                <hr/>
                                <div class="border-right w-100">
                                    <h6 class="text-left fw-bolder">Total pago</h6>
                                    <div class="card">
                                        <div class="text-start p-2">
                                            <p class="mb-0">Subtotal : ${money(order.subtotal)}</p>
                                            <p class="mb-0">Desconto : ${money(0)}</p>
                                            <p>Frete : ${money(order.delivery_fee)}</p>
                                            <hr>
                                            <p>Total : ${money(order.total)}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="w-100">
                                    <h6 class="text-left fw-bolder">Endereço</h6>
                                    <div class="text-start p-2">
                                        ${order.address?.address} .                                                    
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
    if(confirm("Deseja prosseguir com este ação ? ?")) {
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
}
function changeTab(elementRef,s) {
    status = s;
    $("a").removeClass("active");
    elementRef.querySelector("a").classList.add("active");
    loadOrders();
}
function cancelarPedido() {
    if(confirm("Este procedimento não poderá ser desfeito , Deseja realmente cancelar este pedido ?")) {
        $.ajax({
            url: `${Enviroments.baseHttp}order/${orderIdLoaded}/status`,
            type: 'DELETE',
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
}
