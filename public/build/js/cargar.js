document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    mostrarFormulario();
}

function mostrarFormulario() {

    const formulario = document.querySelector('#formulario-carga');
    const formMoneda = document.querySelector('#form-monedas');
    
    const boton = document.querySelector('#cargar');
    const botonMonedas = document.querySelector('#monedas');

    boton.addEventListener('click', function(e) {
        e.preventDefault();

        if (formulario.classList.contains('d-none')) {
            formMoneda.classList.add('d-none');
        }

        formulario.classList.toggle('d-none');
        
    });

    botonMonedas.addEventListener('click', function(e) {
        e.preventDefault();

        if (formMoneda.classList.contains('d-none')) {
            formulario.classList.add('d-none');
        } 

        formMoneda.classList.toggle('d-none');
        
    });

}
