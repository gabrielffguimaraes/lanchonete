class Cart {
    construct() {

    }
    removeProduct = (indice) => {
        let products =  this.getCart();
        products.splice(indice,1);
        sessionStorage.setItem("products",JSON.stringify(products));
    }
    addProduct = (product) => {
        let products =  this.getCart();
        products.push(product);
        sessionStorage.setItem("products",JSON.stringify(products));
    }
    getCart = () => {
        let products = sessionStorage.getItem('products');
        if(products && products != "") {
            products = JSON.parse(products);
        } else products = [];
        return products;
    }
    getValues = () => {
        let cart = this.getCart();
        let total = 0;
        if(cart.length > 0) {
            total = cart
                .map(p => parseFloat(p.price * p.quantity))
                .reduce((v1, v2) => v1 + v2);
        }
        return {
            "total" : total,
            "size" : cart.length,
            "products" : cart
        }
    }
    updateQuantity = (indice,quantity) => {
        let products = this.getCart();
        products[indice].quantity = quantity;
        sessionStorage.setItem("products",JSON.stringify(products));
    }
    clearCart = () => {
        sessionStorage.setItem("products",JSON.stringify([]));
    }
}
window.addEventListener("load",function() {
        loadCartBtnHeaderInfo();
});
function loadCartBtnHeaderInfo() {
    const cart = new Cart();
    let values = cart.getValues();
    if (values.size > 0) {
        $("#btn-header-cart").html(`
            Carrinho - 
            <span class="cart-amunt">${money(values.total)}</span> 
            <i class="fa fa-shopping-cart"></i> 
            <span class="product-count">${values.size}</span>`);
    } else {
        $("#btn-header-cart").html(`Carrinho <i class="fa fa-shopping-cart"></i>`);
    }
}
function plus(e,indice=null) {
    e.value++;
    if(indice != null) { // update cart size
        const cart = new Cart();
        console.log(e.value);
        cart.updateQuantity(indice,e.value);
    }
}
function minus(e,indice=null) {
    if(e.value == 1)
        return
    e.value--;
    if(indice != null) { // update cart size
        const cart = new Cart();
        cart.updateQuantity(indice,e.value);
    }
}