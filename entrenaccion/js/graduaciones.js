
$(document).ready(function  () {

   


var status='';
var t=$('#tableRegistro').DataTable({
  "bPaginate": true,
  "class":          'details-control',
  "sPaginationType": "full_numbers",
  "oLanguage": {
    "sSearch": "Buscar:",
    "sZeroRecords": "No hay resultados",
    "sLengthMenu": "Mostrar _MENU_ resultados",
    "oPaginate": {
     "sNext": "Siguiente",
     "sPrevious": "Anterior",
     "sLast": "Ultima",
     "sFirst": "Primera"
   },
   "sInfo": "Total: _TOTAL_ registros, resultado del _START_ al _END_ ",
   "sInfoEmpty": "No hay resultados",
   "sInfoFiltered": " - filtrado de _MAX_ registros"
 }
});
$.extend( $.fn.dataTableExt.oStdClasses, {
  "sWrapper": "dataTables_wrapper form-inline"
} );

$('#buscar').live('click',function(){
   
 var GoptionSelected = $( "#generacion option:selected" ).text();
 var CoptionSelected = $( "#s_cursos option:selected" ).val();
  var bValid = true;
        

        bValid = bValid &&  GoptionSelected!="#";
        bValid = bValid &&  CoptionSelected!="0";
        if(bValid)
           $.post("/sistema/get_participantes_by_genandcurso_para_graduar", 
           { 

            "gen":GoptionSelected,
            "curso":CoptionSelected

          },
          function(data){

               
          var rows = t
            .rows()
            .remove()
            .draw();
            for(var i = 0; i < data.resultados.length; i++){
               if(data.resultados[i].preparacion == 1)  { status ='Listo'} else { status ='Pendiente'};
            t.row.add( [
                      data.resultados[i].id_participante,
                      data.resultados[i].inscripcion,
                      data.resultados[i].nombre+' - '+ data.resultados[i].usuario,                     
                      '<button type="button" class="btn"  onclick="graduar('+data.resultados[i].id_participante+')">Graduar</button>'
                  ] ).draw();
            }
            
            
          }, 
          "json");
         else{
         
   $("#myDialogText").text("Selecciona generación y curso");
                $("#dialog-ok").dialog();
         }



});
$('#cerrar_registro').live('click',function(){
 var GoptionSelected = $( "#generacion option:selected" ).text();
 var CoptionSelected = $( "#s_cursos option:selected" ).val();
 $.post("/sistema/cerrarGraduacion", 
 { 

  "gen":GoptionSelected,
  "curso":CoptionSelected

},
function(data){

   $("#myDialogText").text(data.mensaje);
                $("#dialog-ok").dialog();

}, 
"json");


});

$('#element_off').click(function() {
 if($('#element_off').is(':checked')) { 
   $('#f_matricula_enrolador').hide();
   $('#info_matricula_enrolador').hide();
 }
});

$('#element_on').click(function() {
 if($('#element_on').is(':checked')) { 
   $('#f_matricula_enrolador').show();
 }
}); 

$('#cancelar').click(function() {
 history.back();
});



  $('#tableRegistro tbody').on( 'click', 'button', function () {
        if ( $(this).parents('tr').hasClass('selected') ) {
           $(this).parents('tr').removeClass('selected');
        }
        else {
            t.$('tr.selected').removeClass('selected');
           $(this).parents('tr').addClass('selected');
        }
         t.row('.selected').remove().draw( false );
    } );
 
    $('#button').click( function () {
       
    } );
});

function graduar(participante){

           var GoptionSelected = $( "#generacion option:selected" ).text();
           var CoptionSelected = $( "#s_cursos option:selected" ).val();
         $.post("/sistema/graduar", 
          { "id_participante":participante,
            "gen":GoptionSelected,
            "curso":CoptionSelected},
            function(data){
              if(data.response=="exito"){
                alert("Error el ejecutivo no ha sincronizado");
              }else{
               
                 $('#'+participante).remove(); 
               
              }
            }, 
         "json");
    }


