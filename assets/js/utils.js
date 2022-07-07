function setActivatedLinkStyle(selector) {
    document.querySelector(".nav-link-active").classList.remove("nav-link-active");
    document.querySelector(selector).classList.add("nav-link-active");
}
function getParams(id) {
    let params = {};
    [...document.querySelector(id).attributes].map(r => Object.assign(params,object(r.name, r.value)));
    return params;
}
function object (key,value) {
    let ignore = ['id','src','class'];
    if (!ignore.find(value => value == key)) {
        return {[key]: value}
    } else {};
}
function money (value) {
    if(!value) {
        return "";
    } else {
        return parseFloat(value)?.toLocaleString("pt-Br", {currency: "BRL", style: "currency", maximumFractionDigits: 2});
    }
}
function getProductSrc(product) {
    let srcImg = `${Enviroments.baseHttp}uploads/${product?.foto[0]?.name}`;
    if(!product?.foto[0]) {
        srcImg = `${Enviroments.baseUrl}assets/img/empty-product.png`;
    }
    return srcImg
}