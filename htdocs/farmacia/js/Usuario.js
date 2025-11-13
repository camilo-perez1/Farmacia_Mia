$(document).ready(function() {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
     
   
    var edit = false;

    buscar_usuario(id_usuario);
    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php', {dato,funcion}, (response) => {
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

            const usuario = response; //antes estaba esto  const usuario = JSON.parse(response);

            nombre+= `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            dni += `${usuario.dni}`;
            tipo += `${usuario.tipo}`;
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            correo += `${usuario.correo}`;
            sexo += `${usuario.sexo}`;
            adicional += `${usuario.adicional}`;

            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#edad').html(edad);
            $('#dni_us').html(dni);
            $('#us_tipo').html(tipo);
            $('#telefono_us').html(telefono);
            $('#residencia_us').html(residencia);
            $('#correo_us').html(correo);
            $('#sexo_us').html(sexo);
            $('#adicional_us').html(adicional);
            
        });
        
    }
    
    $(document).on('click', '.edit', (e) => {
        funcion = 'capturar_datos';
        edit = true;
        $.post('../controlador/UsuarioController.php', {funcion,id_usuario }, (response) => {
            const usuario = response;
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
            $.post('../controlador/UsuarioController.php',{id_usuario,funcion,telefono,residencia,correo,sexo,adicional}, (response) => {
                if (response.status == 'success') {
                    $('#status').hide('slow');
                    $('#status').show(1000);
                    $('#status').hide(2000);
                    $('#form-usuario').trigger('reset');
                    edit = false;
                }
                edit = false;
                buscar_usuario(id_usuario);
            })
        } else {
            $('#noeditado').hide('slow');
            $('#noeditado').show(1000);
            $('#noeditado').hide(2000);
            $('#form-usuario').trigger('reset');
        }
        e.preventDefault();
    })

    $('#form-pass').submit(e => { 
        let oldpass = $('#oldpass').val();
        let newpass = $('#newpass').val();
        funcion ='cambiar_contra';
        $.post('../controlador/UsuarioController.php', {id_usuario,funcion,oldpass,newpass}, (response) => {          
            if (response.status == 'success') {
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');
            }else{
                $('#noupdate').hide('slow');
                $('#noupdate').show(1000);
                $('#noupdate').hide(2000);
                $('#form-pass').trigger('reset');

            }
        })
        e.preventDefault();
    })
        
})