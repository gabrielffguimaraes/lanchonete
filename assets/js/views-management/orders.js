var status = 0;
var xhr = {
    abort : () => {

    }
}
window.addEventListener("load",function() {
    loadProducts();
});
function loadProducts(offset = 0) {
    offsetAtual = offset;
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
                let actionButtons = "";
                switch(order["status"]) {
                    case 0:
                        actionButtons = `<button onclick="updateStatusOrder(${order["id"]},1)" type="button" class="btn btn-sm btn-primary">Aceitar Pedido</button>`;
                        break;
                    case 1:
                        actionButtons = `<button onclick="updateStatusOrder(${order["id"]},2)" type="button" class="btn btn-sm btn-warning text-white">Colocar em preparação</button>`;
                        break;
                    case 2:
                        actionButtons = `<button onclick="updateStatusOrder(${order["id"]},3)" type="button" class="btn btn-sm btn-warning text-white">Transportar pedido</button>`;
                        break;
                    case 3:
                        actionButtons = `<button onclick="updateStatusOrder(${order["id"]},4)" type="button" class="btn btn-sm btn-danger">Finalizar pedido</button>`;
                        break;
                    case 4:
                        actionButtons = `
                            <button title="Pedido Completo" type="button" class="btn btn-sm btn-success rounded-circle">
                                <i class="bi bi-check-square"></i>
                            </button>
                        `;
                        break;
                }
                html += `
                <tr>
                    <td>${order['complete_name']}</td>
                    <td>${order['status_description']}</td>
                    <td>${order['created_at']}</td>
                    <td>${money(order['total'])}</td>
                    <td>
                        ${actionButtons}
                    </td>
                </tr>
                `;
            });
            $("#tbody-orders").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });
}
function updateStatusOrder(orderId,status) {
    alert("update");
}
function changeTab(elementRef,s) {
    status = s;
    $("a").removeClass("active");
    elementRef.querySelector("a").classList.add("active");
    loadProducts();
}
