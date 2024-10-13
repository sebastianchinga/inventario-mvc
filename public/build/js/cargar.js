document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    mostrarFormulario();
}

function mostrarFormulario() {
    const boton = document.querySelector('#cargar');
    const formulario = document.querySelector('#formulario-carga');
    boton.addEventListener('click', function(e) {
        e.preventDefault();
        formulario.classList.toggle('d-none');
    })
}