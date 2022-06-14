function getCategoriesFilter () {
    return [...document.getElementsByName("category-filter")].map(elementRef => elementRef.value).join(",")
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
                    <input class="form-check-input" type="checkbox"  id="category-filter-${category.id}" name="category-filter" value="${category.id}">
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
function loadProducts() {
    let categories = getCategoriesFilter();
    console.log(categories);
    console.log(`${Enviroments.baseHttp}client/product?categories=${categories}`)
    $.ajax({
        url: `${Enviroments.baseHttp}client/product?categories=${categories}`,
        type: 'GET',
        dataType: 'json',
        data:JSON.stringify(categories),
        headers: {
            'Authorization': `${Enviroments.authorization}`
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            let html = "";
            result.forEach((product)=>{
                let ingredients = product.ingredient
                    .map(ingredient => ingredient.description)
                    .join(" ,");
                html += `
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="${Enviroments.baseUrl}assets/img/product-2.jpg" alt="">
                        </div>
                        <h2><a href="">${product.description}</a></h2>
                        <div class="product-carousel-price">
                            <ins>$ ${product.price}</ins> 
                            <p style="font-style: italic">${(ingredients != "") ? ingredients+" ." : ingredients}</p>
                            <!--<del>$999.00</del>-->
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