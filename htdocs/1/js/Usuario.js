$(document).ready(function() {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
     
   
    //var edit = false;

    buscar_usuario(id_usuario);
    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php', { dato, funcion}, (response) => {
            
            let nombre='';
            let apellidos='';
            let edad='';
            let dni='';
            let tipo='';
            let telefono='';
            let residencia='';
            let correo='';
            let sexo='';
            let adicional='';

            const usuario = JSON.parse(response);
            nombre+= `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            dni += `${usuario.identificacion}`;
            tipo += `${usuario.tipo}`;
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            correo += `${usuario.correo}`;
            sexo += `${usuario.sexo}`;
            adicional += `${usuario.adicional}`;

            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#telefono_us').html(telefono);
            $('#edad').html(edad);
            $('#identificacion_us').html(dni);
            $('#us_tipo').html(tipo);
            $('#residencia_us').html(residencia);
            $('#sexo_us').html(sexo);
            $('#adicional_us').html(adicional);
            $('#correo_us').html(correo);
        });
        
    }
    /*
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
    });

    $('#form-pass').submit(e => { 
        let oldpass = $('#oldpass').val();
        let newpass = $('#newpass').val();
        funcion = 'cambiar_contra';
        $.post('../controlador/Usuario.Controller.php', { id_usuario, funcion, oldpass, newpass }, (response) => {
            if (response == 'update') {
                
            }else{

            }
        })
        e.preventDefault();
    })
        */
})