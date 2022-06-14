let flag = "add";
window.addEventListener("load",function() {
    let params = getParams("#address-script");
    flag = (params['id-address'] != "") ? "edit" : "add";
    if (flag == "add") {
        loadAddressesList();
    } else {
        loadAddressForm();
    }
});
function loadAddressForm(id) {
    $.ajax({
        url: `${Enviroments.baseHttp}client/address/${id}`,
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
                            <a href="${Enviroments.baseUrl}my-addresses/${address.id}/edit" class="alt me-3">
                                <i class="bi bi-pencil-square"></i>
                                EDITAR
                            </a>
                            <a href="javascript:void(0)" class="button alt bg-red">
                                <i class="bi bi-trash3"></i>
                                EXCLUIR
                            </a>
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
function loadAddressesList() {
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
                            <a href="${Enviroments.baseUrl}my-addresses/${address.id}/edit" class="alt me-3">
                                <i class="bi bi-pencil-square"></i>
                                EDITAR
                            </a>
                            <a href="javascript:void(0)" class="button alt bg-red">
                                <i class="bi bi-trash3"></i>
                                EXCLUIR
                            </a>
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
            addressesList();
        },
        error: function (error) {
            console.log(error);
            alert("Ocorreu um erro ao adicionar endereço , por favor tente novamente mais tarde .")
        }
    });
});
