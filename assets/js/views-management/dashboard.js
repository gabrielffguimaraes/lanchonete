let xhr = {
    abort: ()=>{}
}
window.addEventListener("load",function() {
    $('#year').inputmask({"placeholder": "    "});
    loadDashINFO();
});
function loadDashINFO() {
    let month = $("#month").val();
    let year = $("#year").val();
    let date = `${year}-${month}`;
    resetDashINFO();
    xhr.abort();
    xhr = $.ajax({
        url: `${Enviroments.baseHttp}management/metrics?date=${date}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (metrics) {
            $("#clients").text(metrics.clients);
            $("#orders").text(metrics.orders);
            if(metrics.revenue > 0) {
                $("#revenue").text(money(metrics.revenue));
            } else {
                $("#revenue").text("R$ 0");
            }
            $("#growth").text(metrics.revenue_growth + "%");

            $("#growth-clients").text(metrics.clients_growth + "%");
            $("#growth-orders").text(metrics.orders_growth + "%");
            $("#growth-revenue").text(metrics.revenue_growth + "%");
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function resetDashINFO(){
    $("#clients").text("0");
    $("#orders").text("0");
    $("#revenue").text("R$ 0");
    $("#growth").text("0 %");

    $("#growth-clients").text("0 %");
    $("#growth-orders").text("0 %");
    $("#growth-revenue").text("0 %");
}
