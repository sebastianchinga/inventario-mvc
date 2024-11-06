document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
})

function iniciarApp() {
    mostrarFormulario();
}

function mostrarFormulario() {

    const formularios = document.querySelectorAll('#form-monedas,#formulario-carga');
    
    
    const boton = document.querySelector('#cargar');
    const formulario = document.querySelector('#formulario-carga');
    const btnMoneda = document.querySelector('#mostrarSeleccion');
    const formMonedas = document.querySelector('#form-monedas');
    // boton.addEventListener('click', function(e) {
    //     e.preventDefault();

    //     // showForm(formulario);
    // });
    formularios.forEach(f => {
        if (!f.classList.contains('d-none')) {
            console.log('Está oculto');
        }
    });

}

// function showForm(form) {
//     form.classList.toggle('d-none');
// }