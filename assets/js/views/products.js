var offsetAtual = 0;
var limit = 20;
var countPagination = 0;
var timeoutLoadProductName = {}
var xhr = {
    abort() {

    }
};
function getCategoriesFilter () {
    return [...document.getElementsByName("category-filter")]
        .filter(elementRef => elementRef.checked)
        .map(elementRef => elementRef.value).join(",")
}
function loadCategories() {
    $.ajax({
        url: `${Enviroments.baseHttp}/category`,
        type: 'GET',
        dataType: 'json',
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (categories) {
            let html = "";
            categories.forEach((category)=>{
                html += `
                <div class="form-check me-3">
                    <input onclick="loadProducts()" class="form-check-input" type="checkbox"  id="category-filter-${category.id}" name="category-filter" value="${category.id}">
                    <label class="form-check-label user-select-none cursor-pointer" for="category-filter-${category.id}">
                        ${category.description}
                    </label>
                </div>
                `;
            })
            $("#filter-products").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    })
}
function nextPage() {
    let offset = offsetAtual + limit;
    if(offset > (countPagination * limit)) {
        offset = (countPagination * limit);
    }
    loadProducts(offset);
}
function previousPage(){
    let offset = offsetAtual - limit;
    if(offset < 0) {
        offset = 0;
    }
    loadProducts(offset);
}
function buildPagination(maxsize) {
    i = (maxsize/limit);
    countPagination = parseInt(i);
    $("#pagination").closest(".pagination").addClass("d-none");
    if(countPagination > 0) {
        let html = "";
        let offset = 0;
        $("#pagination").closest(".pagination").removeClass("d-none");
        for(let count=0;count < Math.ceil(i);count++){
            html += `
                <li class="page-item" onclick="loadProducts(${offset})">
                    <a class="page-link b-radius-0 ${offset == offsetAtual ? 'active-pagination' : ''}" href="javascript:void(0)">${count + 1}</a>
                </li>
            `;
            offset += limit;
        }

        $("#pagination").html(html);
    }
}
function loadProductsFilter() {
    clearTimeout(timeoutLoadProductName);
    timeoutLoadProductName = setTimeout(function () {
        loadProducts(0);
    },1000);
}
function loadProducts(offset = 0) {
    offsetAtual = offset;
    let categories = getCategoriesFilter();
    let description = $("#product-name").val();
    xhr.abort();
    xhr = $.ajax({
        url: `${Enviroments.baseHttp}client/product?description=${description}&categories=${categories}&limit=${limit}&offset=${offset}`,
        type: 'GET',
        dataType: 'json',
        data:JSON.stringify(categories),
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            buildPagination(result.maxsize);
            result.data.forEach((product)=>{
                let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");
                let srcImg = getProductSrc(product);
                html += `
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="${srcImg}" alt="">
                        </div>
                        <h2><a href="${Enviroments.baseUrl}product/${product.id}/details">${product.description}</a></h2>
                        <div class="product-carousel-price">
                            <ins>${money(product.price)}</ins> 
                            <del class="fst-italic text-dark">${money(product["price_fake"])}</del>
                            <p style="font-style: italic">${(ingredients != "") ? ingredients+" ." : ingredients}</p>
                        </div>
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="./product/${product.id}/ingredients">Add to cart</a>
                        </div>
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
window.addEventListener("load",()=> {
    loadProducts();
    loadCategories();
})
