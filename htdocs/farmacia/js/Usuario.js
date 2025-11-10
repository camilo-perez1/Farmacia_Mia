$(document).ready(function() {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    var edit = false;

    buscar_usuario(id_usuario);

    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        
        // ########## CORRECCIÓN: 'Usuario.controller.php' cambiado a 'Usuario.Controller.php' ##########
        $.ajax({
            url: '../controlador/Usuario.Controller.php', // Unificado a 'C' mayúscula
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
                $('#edad').html(edad);
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

    $(document).on('click', '.edit', (e) => {
        funcion = 'capturar_datos';
        edit = true;
        $.post('../controlador/Usuario.Controller.php', { funcion, id_usuario }, (response) => {
            const usuario = JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#residencia').val(usuario.residencia); // ID corregido en HTML
            $('#correo').val(usuario.correo);       // ID corregido en HTML
            $('#sexo').val(usuario.sexo);         // ID corregido en HTML
            $('#adicional').val(usuario.adicional);
        });
    });

    $('#form-usuario').submit(e => { // ID corregido en HTML
        if (edit == true) {
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let correo = $('#correo').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();
            funcion = 'editar_usuario';

            $.post('../controlador/Usuario.Controller.php', { id_usuario, funcion, telefono, residencia, correo, sexo, adicional }, (response) => {
                if (response == 'editado') {
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit = false;
                buscar_usuario(id_usuario);
            })
        } else {
            $('#no_editado').hide('slow');
            $('#no_editado').show(1000);
            $('#no_editado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    })
});