document.getElementById("register-form-wrap").addEventListener("submit",function(){
    event.preventDefault();
    event.stopPropagation();
    let password = $("#password").val();
    let confirmPassword = $("#confirm-password").val();
    if(password != confirmPassword) {
        alert("Confirmação de senha não confere .")
    } else if(password.length < 6) {
       alert("Minimo de 6 digitos para senha .")
    } else {
        this.submit();
    }
});