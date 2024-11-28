// registro.js

function verificarCodigo(event) {
    event.preventDefault(); // Evita el envío del formulario

    let codigoIngresado = document.getElementById('codigoIngresado').value;
    let correo = document.getElementById('correo').value;

    // Hacer una llamada AJAX para verificar el código
    fetch('/ruta-de-verificacion', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            codigoIngresado: codigoIngresado,
            correo: correo
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Código verificado correctamente, redirigir o mostrar mensaje de éxito
            window.location.href = '/ruta-donde-redirigir';
        } else {
            // Mostrar mensaje de error
            alert('El código de verificación es incorrecto.');
        }
    })
    .catch(error => {
        console.error('Error al verificar el código:', error);
    });
}
