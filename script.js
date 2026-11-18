document.addEventListener('DOMContentLoaded', () => {
    const formularioLibro = document.getElementById('formLibro');

    /**
     * Valida que los campos obligatorios del formulario no estén vacíos y tengan el formato correcto.
     * 
     * @param {string} valorTitulo - Texto ingresado correspondiente al título del libro.
     * @param {string} valorAutor - Texto ingresado correspondiente al autor.
     * @param {string} valorIsbn - Código ISBN ingresado para la validación de longitud.
     * @return {boolean} Retorna true si la validación es correcta, false si hay errores.
     */
    const validarDatosFormulario = (valorTitulo, valorAutor, valorIsbn) => {
        if (valorTitulo === "" || valorAutor === "" || valorIsbn === "") {
            alert('Por favor, rellena todos los campos antes de guardar.');
            return false;
        }

        if (valorIsbn.length < 10) {
            alert('El campo ISBN parece demasiado corto o inválido.');
            return false;
        }

        return true;
    };

    // Validación interactiva antes de enviar los datos al servidor
    formularioLibro.addEventListener('submit', (eventoSubmit) => {
        const valorTitulo = document.getElementById('titulo').value.trim();
        const valorAutor = document.getElementById('autor').value.trim();
        const valorIsbn = document.getElementById('isbn').value.trim();

        // Ejecutar función de validación documentada
        if (!validarDatosFormulario(valorTitulo, valorAutor, valorIsbn)) {
            eventoSubmit.preventDefault(); // Detiene el envío del formulario si falla
        }
    });

    // Detectar si venimos de un registro exitoso mediante la URL
    const parametrosUrl = new URLSearchParams(window.location.search);
    
    if (parametrosUrl.get('success') === '1') {
        // Limpiar el parámetro de la URL estética
        window.history.replaceState({}, document.title, window.location.pathname);
        alert('¡Libro registrado con éxito en el inventario!');
    }
});