window.addEventListener("load",function() {
    orderList();
})
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
            let html = ``;
            orders.forEach((order,i)=>{
                let stats = order.status_history;
                html += `
                <div class="card card-item">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a class="" data-bs-toggle="collapse" href="#order-${order.id}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-chevron-down"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <label>${order.status_description}</label>
                                </div>
                                <div>
                                   ${order.created_at}
                                </div>
                            </div>
                            <hr/>
                            <div class="collapse" id="order-${order.id}">
                                <div id="products">
                                    <small> Pedido : ${order.id} </small>
                                    `;
                order.products.forEach(product => {
                    let ingredientes = product.ingredients.map(ingredient => ingredient.description).join(" ,");
                    html += ` 
                                    <div class="mb-3">
                                        <div class="d-flex">
                                            <img src="/lanchonete/public/assets/img/product-2.jpg" alt="">
                                            <div class="ms-2">
                                                <p>${product.description}</p>
                                                <p><b>${product.quantity} quantidade</b></p>
                                                <p>${ingredientes}</p>
                                            </div>
                                        </div>
                                    </div>`;
                });
                                html += `
                                </div>
                                <ul class="timeline" id="timeline">
                                    <li class="li ${stats[0] ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> Pedido recebido </h4>
                                                <small>${stats[0]?.created_at ? stats[0]?.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li ${stats[1] ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> Pagamento aprovado </h4>
                                                <small>${stats[1]?.created_at ? stats[1]?.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li ${stats[2] ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> Preparando Pedido </h4>
                                                <small class="d-block">${stats[2]?.created_at ? stats[2]?.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li ${stats[3] ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> Em transporte </h4>
                                                <small class="d-block">${stats[3]?.created_at ? stats[3]?.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="li ${stats[4] ? 'complete' : ''}">
                                        <div class="status">
                                            <div>
                                                <h4> Pedido entregue </h4>
                                                <small class="d-block">${stats[4]?.created_at ? stats[4]?.created_at : ''}</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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