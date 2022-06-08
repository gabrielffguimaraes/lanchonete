class Cart {
    construct() {

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
    clearCart = () => {
        sessionStorage.setItem("products",JSON.stringify([]));
    }
}
