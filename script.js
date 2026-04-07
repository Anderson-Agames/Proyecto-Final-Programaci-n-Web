// validacion del formulario de contacto
document.getElementById('formContacto').addEventListener('submit', function(event) {
    
    var nombre = document.querySelector('input[name="nombre"]').value;
    var correo = document.querySelector('input[name="correo"]').value;
    var asunto = document.querySelector('input[name="asunto"]').value;
    var comentario = document.querySelector('textarea[name="comentario"]').value;
    
    if(nombre == "") {
        alert('Por favor ingresa tu nombre');
        event.preventDefault();
        return false;
    }
    
    if(correo == "") {
        alert('Por favor ingresa tu correo');
        event.preventDefault();
        return false;
    }
    
    if(asunto == "") {
        alert('Por favor ingresa el asunto');
        event.preventDefault();
        return false;
    }
    
    if(comentario.length < 10) {
        alert('El comentario debe tener al menos 10 caracteres');
        event.preventDefault();
        return false;
    }
    
    console.log('Formulario validado correctamente');
});