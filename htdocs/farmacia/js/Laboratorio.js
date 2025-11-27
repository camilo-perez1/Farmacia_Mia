$(document).ready(function(){
      buscar_Lab();
    var funcion;
    $('#form-crear-laboratorio').submit(e=>{
        e.preventDefault();
        let nombre_laboratorio=$('#nombre_laboratorio').val();
        funcion='crear';

        $.post('../controlador/LaboratorioController.php',{nombre_laboratorio,funcion},(response)=>{
            if(response=='add'){
                
                    $('#add-laboratorio').hide('slow');
                    $('#add-laboratorio').show(1000);
                    $('#add-laboratorio').hide(2000);
                    $('#form-crear-laboratorio').trigger('reset');  
                    buscar_Lab(); 
                
             }
             else{
                 $('#noadd-laboratorio').hide('slow');
                    $('#noadd-laboratorio').show(1000);
                    $('#noadd-laboratorio').hide(2000);
                    $('#form-crear-laboratorio').trigger('reset');  

             }


     });
        e.preventDefault();

    });     
    function buscar_Lab(consulta){
        funcion='buscar';
        $.post('../controlador/LaboratorioController.php',{consulta,funcion},(response)=>{
          console.log(response);


        });
    }
        $($document).on('click', '.buscar_laboratorio"', function(){
            let valor = $(this).val();
            if (valor != "") {
                  buscar_Lab(valor);
            }
            else {
                    buscar_Lab();
            }
        });
});