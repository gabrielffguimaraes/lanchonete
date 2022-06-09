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
    return value.toLocaleString("pt-Br",{currency:"BRL",style:"currency",maximumFractionDigits:2});
}