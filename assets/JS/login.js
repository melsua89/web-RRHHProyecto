
function frmLogin(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const password = document.getElementById("password");
    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (password.value == "") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    } else {
        const url = base_url + "Login/acceder";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    window.location = base_url + "Inicio";
                } else {
                    console.log("Contraseña incorrecta");
                }
            }
            
        }
    }
}