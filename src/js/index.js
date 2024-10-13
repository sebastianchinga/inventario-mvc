document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    cambiarPassword();
}

function cambiarPassword() {    
    const formGroup = document.querySelector('#mostrarPassword');
    const boton = document.querySelector('#botonCambiar');
    // const confirmar = document.querySelector('#botonConfirmar');
    boton.addEventListener('click', function(e) {
        e.preventDefault();
        formGroup.classList.toggle('d-none');
        // confirmar.classList.toggle('d-none');
    })
    
}