$(document).ready(function() {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    buscar_usuario(id_usuario);
    
    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        // Llamada AJAX al controlador; dataType:'json' hace que jQuery entregue un objeto JS
        $.ajax({
            url: '../controlador/Usuario.controller.php',
            type: 'POST',
            data: { dato: dato, funcion: funcion },
            dataType: 'json',
            success: function(response) {
                console.log('Respuesta servidor (objeto):', response);

                // response ya es un objeto (o un array vacío). Usarlo directamente.
                const usuario = response || {};

                const nombre = usuario.nombre || '';
                const apellidos = usuario.apellidos || '';
                const telefono = usuario.telefono || '';
                const edad = usuario.edad || '';
                const identificacion = usuario.identificacion || '';
                const tipo = usuario.us_tipo || '';
                const residencia = usuario.residencia || '';
                const sexo = usuario.sexo || '';
                const adicional = usuario.adicional || '';
                const correo = usuario.correo || '';

                $('#nombre_us').html(nombre);
                $('#apellidos_us').html(apellidos);
                $('#telefono_us').html(telefono);
                $('#edad_us').html(edad);
                $('#identificacion_us').html(identificacion);
                $('#us_tipo').html(tipo);
                $('#residencia_us').html(residencia);
                $('#sexo_us').html(sexo);
                $('#adicional_us').html(adicional);
                $('#correo_us').html(correo);
            },
            error: function(xhr, status, error) {
                // Mostrar la respuesta textual para debug (puede contener HTML o mensajes de error)
                console.error('Error AJAX:', status, error);
                console.error('Respuesta del servidor:', xhr.responseText);
            }
        });
    }

});

