let params;
let inmemoryProduct = {};
document.getElementById("add_to_cart_button").addEventListener("click",()=>{
    event.preventDefault();
    event.stopPropagation();
    let quantity = $("#quantity").val();
    location.href = `${Enviroments.baseUrl}product/${params['product-id']}/ingredients?quantity=${quantity}`;
});
window.addEventListener("load",()=> {
    params = getParams("#script-product-detail");
    if(!params['product-id']) {
        alert("Produto não encontrado");
        location.href=Enviroments.baseUrl;
    }
    carregarProdutos();
    carregarProduto(params['product-id']);
});
function carregarProduto(id) {
    $.ajax({
        url: `${Enviroments.baseHttp}client/product/${id}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (product) {
            let srcImg = getProductSrc(product);
            $(".product-main-img img").attr("src",srcImg);
            $("#details").text(product?.detail ?? "");
            $("#reviews").text(product?.review ?? "");
            inmemoryProduct = product;
            product.price = parseFloat(product.price);
            $(".category-product").each((i,elementRef)=>{
                elementRef.innerHTML = product.category[0].description;
            });
            $(".description-product").each((i,elementRef)=>{
                elementRef.innerHTML = product.description;
            });
            $("#price-product").html(money(product.price));
            $("#price-fake").html(money(product.price_fake));
            product.galery.forEach(foto => {
               let src = `${Enviroments.baseHttp}uploads/${foto?.name}`;
               $(".product-gallery").append(`<img src='${src}'>`) ;
            });

        },
        error: function (error) {
            console.log(error);
        }
    })
}
function carregarProdutos() {
    event.preventDefault();
    let description = $("#product-name").val();
    $.ajax({
        url: `${Enviroments.baseHttp}client/product?limit=10&description=${description}`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result["data"].forEach((product)=>{
                /*let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");*/
                product.price = parseFloat(product.price);
                let srcImg = getProductSrc(product);
                html += `
                    <div class="thubmnail-recent">
                        <img src="${srcImg}" class="recent-thumb" alt="">
                        <h2><a href="${Enviroments.baseUrl}product/${product.id}/details">${product.description}</a></h2>
                        <div class="product-sidebar-price">
                            <ins>${money(product.price)}</ins> 
                            <del>${money(product.price_fake)}</del>
                        </div>
                    </div>
                `;
            })
            $("#products").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function changeTabDetail(elementRef,tab) {
    $(".tab-detail-product").removeClass("active");
    elementRef.classList.add("active");

    $(".tab").addClass("d-none");
    $(tab).removeClass("d-none");
}
