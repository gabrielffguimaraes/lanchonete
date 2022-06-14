let flag = "add";
let params = {}
window.addEventListener("load",function() {
    params = getParams("#address-script");
    flag = (params['address-id'] != "") ? "edit" : "add";
    if (flag == "add") {
        loadAddressesList();
    } else {
        loadAddressForm(params['address-id']);
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
        success: function (address) {
            $("#billing_address").val(address.address);
            $("#billing_name").val(address.name);
            $("#billing_cep").val(address.cep);
            $("#billing_complement").val(address.complement);
            $("#billing_city").val(address.city);
            $("#billing_state").val(address.uf);
            $("#billing_country").val(address.country);
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
                            <a href="${Enviroments.baseUrl}my-addresses/${address.id}/edit" class="alt me-3">
                                <i class="bi bi-pencil-square"></i>
                                EDITAR
                            </a>
                            <a href="javascript:void(0)" onclick="deleteAddress(${address.id})" class="button alt bg-red">
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
    let name = $("#billing_name").val();
    let cep = $("#billing_cep").val();
    let address = $("#billing_address").val();
    let complement = $("#billing_complement").val();
    let city = $("#billing_city").val();
    let estado = $("#billing_state").val();
    let country = $("#billing_country").val();
    let obj = {
        name,
        cep,
        address,
        complement,
        city,
        uf:estado,
        country
    }
    flag == "add" ? add(obj) : update(obj);
});
function update(address) {
    let id = params['address-id'];
    $.ajax({
        url: `${Enviroments.baseHttp}client/address/${id}`,
        type: 'PUT',
        data: JSON.stringify(address),
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert("Endereço atualizado com sucesso");
            location.href = `${Enviroments.baseUrl}my-addresses`;
        },
        error: function (error) {
            console.log(error);
            alert("Ocorreu um erro ao atualizar endereço , por favor tente novamente mais tarde .")
        }
    });
}
function deleteAddress(id) {
    if(!confirm("Deseja realmente deletar este endereço ?")) return
    $.ajax({
        url: `${Enviroments.baseHttp}client/address/${id}`,
        type: 'DELETE',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert("Endereço deletado com sucesso");
            loadAddressesList();
        },
        error: function (error) {
            console.log(error);
            alert("Ocorreu um erro ao deletar endereço , por favor tente novamente mais tarde .")
        }
    });
}
function add(address) {
    $.ajax({
        url: `${Enviroments.baseHttp}client/address`,
        type: 'POST',
        data: JSON.stringify(address),
        dataType: 'json',
        headers: {
            /*'Authorization': `${Enviroments.authorization}`*/
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            alert("Endereço cadastrado com sucesso");
            $("#address-form").trigger("reset");
            loadAddressesList();
        },
        error: function (error) {
            console.log(error);
            alert("Ocorreu um erro ao adicionar endereço , por favor tente novamente mais tarde .")
        }
    });
}