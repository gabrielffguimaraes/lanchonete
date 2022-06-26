var statusList = [];
window.addEventListener("load",function() {
    loadStatusList(()=>{
        orderList();
    });
})
function loadStatusList(callback){
    $.ajax({
        url: `${Enviroments.baseHttp}status`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
           statusList = response;
           callback();
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function orderList() {
    $.ajax({
        url: `${Enviroments.baseHttp}order`,
        type: 'GET',
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (orders) {

            (orders.length > 0) ? $("#orders").removeClass("d-none") : $("#empty-order").removeClass("d-none");
            let html = ``;
            orders.forEach((order,i)=>{
                let stats = order.status_history;
                let firstProduct = order.products[0];
                let srcImg = getProductSrc(firstProduct);
                html += `
                <div class="card card-item">
                    <div class="card-body">
                        <div class="order">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a  class="text-decoration-none" onclick="collapseEffectAccourdion(this)"  data-bs-toggle="collapse" href="#order-${order.id}" role="button" aria-expanded="false">
                                        <div class="d-flex">
                                            <i class="bi bi-chevron-down"></i>&nbsp;&nbsp;&nbsp;
                                            <label>${order.status_description}</label>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                   ${order.created_at_status}
                                </div>
                            </div>
                            <div class="d-flex half-opacity preview-product">
                                <div class="me-3">
                                    <img width="50" src="${srcImg}" alt="">
                                </div>
                                <div>`;
                        html +=`
                                    <p class="mb-0">${firstProduct?.description}</p>
                                    <p class="mb-0"><b>${firstProduct?.quantity} quantidade</b></p>
                                    <p class="mb-0">${firstProduct?._ingredients}</p>
                                </div>
                            </div>
                            <hr/>
                            <div class="collapse" id="order-${order.id}">
                                <div id="products">
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
                });

                html += `       </div>
                                <ul class="timeline" id="timeline" >
                `;

                if(order.status == 0) {
                    statusList.map(status => stats.find(s => s.status == status.id))
                        .filter(status => status != undefined)
                        .forEach((objS) => {
                            html += ` 
                                    <li class="li ${objS ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> ${objS.description} </h4>
                                                <small>${objS ? objS.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>`;
                        });
                        html += `
                                    <li class="li cancelled-timeline">
                                        <div class="status">
                                            <div>
                                                <h4> ${order.status_description} </h4>
                                                <small>${order.created_at_status}</small>
                                            </div>
                                        </div>
                                    </li>
                        `
                } else {
                    statusList.map(status => {
                            let obj = stats.find(s => s.status == status.id);
                            if(!obj) {
                                obj = status;
                            }
                            return obj;
                        })
                        .forEach((objS) => {
                            html += ` 
                                    <li class="li ${objS.created_at ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> ${objS.description} </h4>
                                                <small>${objS.created_at ? objS.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>`;
                        });
                }
                html += `
                                </ul>
                                <div class="detail-order text-center">
                                    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> detalhes do pedido </a>
                                    <div class="collapse mt-3" id="collapseExample">
                                        <div class="card card-body">
                                            <div class="d-flex" style="width: 100%;height: 100%">
                                                <div class="border-right w-100">
                                                    <h5>Pagamento</h5>
                                                    <u class="text-left">
                                                        <li>${order.payment_method}</li>
                                                    </u>
                                                </div>
                                                <div class="border-right w-100">
                                                    <h5>Total pago</h5>
                                                    <div class="text-start p-2">
                                                        <p class="mb-0">Subtotal : ${money(order.subtotal)}</p>
                                                        <p class="mb-0">Desconto : ${money(0)}</p>
                                                        <p>Frete : ${money(order.delivery_fee)}</p>
                                                        <hr>
                                                        <p>Total : ${money(order.total)}</p>
                                                    </div>
                                                </div>
                                                <div class="w-100">
                                                    <h5>Endereço</h5>
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
                            </div>
                        </div>   
                    </div>
                </div>
            `;
            });
            $("#orders").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function collapseEffectAccourdion(e) {
    let isOpen = e.classList.contains("collapsed");
    if(isOpen) {
        e.closest(".order").querySelector(".preview-product").classList.remove("d-none");
    } else {
        e.closest(".order").querySelector(".preview-product").classList.add("d-none");
    }
}
