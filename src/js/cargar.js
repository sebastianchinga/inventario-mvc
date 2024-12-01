document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    mostrarFormulario();
}

function mostrarFormulario() {

    const formulario = document.querySelector('#formulario-carga');
    
    const boton = document.querySelector('#cargar');
    boton.addEventListener('click', function(e) {
        e.preventDefault();

        showForm(formulario);
    });

}

function showForm(form) {
    form.classList.toggle('d-none');
}