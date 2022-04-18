function confirmar_eliminar(e) {
    if (confirm("¿Estas seguro de eliminar este usuario?")) {
        return true;
    } else {
        e.preventDeafault();
    }
}

let linkDelete = document.querySelectorAll(".btn-eliminar");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmar_eliminar);
}