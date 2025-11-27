$(document).ready(function() {
    buscar_Lab();
    var funcion;

    $('#form-crear-laboratorio').submit(e => {
        e.preventDefault();
        let nombre_laboratorio = $('#nombre_laboratorio').val();
        funcion = 'crear';

        $.post('../controlador/LaboratorioController.php', {
            nombre_laboratorio,
            funcion
        }, (response) => {
            if (response.trim() == 'add') {
                $('#add-laboratorio').hide();
                $('#add-laboratorio').show(1000);
                $('#add-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_Lab();
            } else {
                $('#noadd-laboratorio').hide();
                $('#noadd-laboratorio').show(1000);
                $('#noadd-laboratorio').hide(2000);
                $('#form-crear-laboratorio').trigger('reset');
            }
        });
    });

    function buscar_Lab(consulta) {
        funcion = 'buscar';
        $.post('../controlador/LaboratorioController.php', {
            consulta,
            funcion
        }, (response) => {
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                // CORREGIDO: Espacios entre atributos y estructura de botones
                template +=
                    `<tr labId="${laboratorio.id}" labNombre="${laboratorio.nombre}" labAvatar="${laboratorio.avatar}">
                        <td>${laboratorio.nombre}</td>
                        <td>
                            <img src="${laboratorio.avatar}" class="img-fluid rounded-circle" width="70px" height="70px">
                        </td>
                        <td>
                            <button class="avatar btn btn-info" title="cambiar logo" type="button" data-toggle="modal" data-target="#cambiologo">
                                <i class="far fa-image"></i>
                            </button>
                            
                            <button class="editar btn btn-success" title="editar">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            
                            <button class="borrar btn btn-danger" title="borrar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
            });
            $('#laboratorios').html(template);
        });
    }

    $(document).on('keyup', '#buscar_laboratorio', function() {
        let valor = $(this).val();
        if (valor != "") {
            buscar_Lab(valor);
        } else {
            buscar_Lab();
        }
    });

    // LOGICA CAMBIAR LOGO
    $(document).on('click', '.avatar', function(e) { // Usamos clase en minúscula
        // Seleccionamos la fila completa
        const elemento = $(this).closest('tr');
        
        // Obtenemos datos
        const id = elemento.attr('labId');
        const nombre = elemento.attr('labNombre');
        const avatar = elemento.attr('labAvatar');
        
        // Llenamos el modal
        $('#logoactual').attr('src', avatar);
        $('#nombre_logo').html(nombre);
        $('#id_logo_lab').val(id); // Asegúrate que este ID coincida con el input hidden
        $('#funcion').val('cambiar_logo');
    });

    $('#form-logo').submit(function(e) {
        e.preventDefault();
        
        let formdata = new FormData($('#form-logo')[0]);

        $.ajax({
            url: '../controlador/LaboratorioController.php', // CORREGIDO: Apuntaba a UsuarioController
            type: 'POST',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.alert == 'edit') {
                    $('#logoactual').attr('src', response.ruta);
                    $('#edit').hide('slow').show(1000).hide(2000);
                    $('#form-logo').trigger('reset');
                    buscar_Lab();
                } else {
                    $('#noedit').hide('slow').show(1000).hide(2000);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});