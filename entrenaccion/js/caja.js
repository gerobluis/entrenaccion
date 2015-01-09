$(document).ready(function  () {
  $('#pago').hide();
  $('#historial').hide();
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
  $("#dialog-ok" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,
    modal: true,
    buttons: {
     
      OK: function() {
        $( this ).dialog( "close" );
      }
    },close: function(event, ui) { window.location.href = "/sistema/caja"; }
   
  });
    
     $('#id_curso_enrolador').hide();
   

   $('#btn_rea_pag').click(function() {
      $('#pago').show();
      $('#historial').hide();
      
   });
    $('#btn_cor_caj').click(function() {
       $('#historial').hide();
        $('#pago').hide();
        $.post("/sistema/realizarCorteCaja", 
           { 

           

          },
          function(data){
          
               
            
               
          var rows = t
            .rows()
            .remove()
            .draw();
            console.log(data.resultados.length);
             console.log(data.datas.length);
            for(var i = 0; i < data.resultados.length; i++){
             var curso= "Intro";
              switch (data.resultados[i].id_curso){
                case 1:
                    curso="Intro";
                break;
                 case 2:
                    curso="VIP";
                break;
                 case 3:
                    curso="PRO 1";
                break;
              }
            t.row.add( [
                      data.resultados[i].id_participante,
                      data.resultados[i].nombre,
                      curso,
                      data.resultados[i].cantidad_pagada,
                      data.resultados[i].fecha_pago                      
                  ] ).draw();
            }
            
            
          }, 
          "json");

   });
     $('#btn_his_pag').click(function() {

       $.post("/sistema/getHistorialPagos", 
           { 

           

          },
          function(data){
          
               
            
               
          var rows = t
            .rows()
            .remove()
            .draw();
            console.log(data.resultados.length);
            for(var i = 0; i < data.resultados.length; i++){
             var curso= "Intro";
              switch (data.resultados[i].id_curso){
                case 1:
                    curso="Intro";
                break;
                 case 2:
                    curso="VIP";
                break;
                 case 3:
                    curso="PRO 1";
                break;
              }
            t.row.add( [
                      data.resultados[i].id_participante,
                      data.resultados[i].nombre,
                      curso,
                      data.resultados[i].cantidad_pagada,
                      data.resultados[i].fecha_pago                      
                  ] ).draw();
            }
            
            
          }, 
          "json");
 
        $('#historial').show();
        $('#pago').hide();
   });

  

    $('#cancelar').live('click',function(){
     history.back();
   });
    $('#guardar').live('click',function(){

      var pago=parseInt(  $('#cantidad_pago') .val(),  10  );
      var adeudo=parseInt( $('#adeudo_participante') .text(),  10  );
      var concepto_pago=parseInt( $('input[name=concepto_pago]:checked') .val(),  10  );
      var tipo_pago=parseInt( $('input[name=tipo_pago]:checked') .val(),  10  );
      var id_participante=$('#matricula_info').text();
     
       var bValid = true;      
        bValid = bValid &&   pago<=adeudo;
        bValid = bValid &&   pago>0;       
        bValid = bValid &&   id_participante!="";
        bValid = bValid &&   concepto_pago>0;
        bValid = bValid &&   tipo_pago>0;
      if(bValid){
         
            $.post("/sistema/realizarPago", 
            { 

              "id_participante":$('#matricula_info').text(),
              "nombre_participante":$('#nombre_enrolador').text(),
              "id_curso":$('#id_curso_enrolador').text(),
              "nombre_curso":$('#curso_enrolador').text(),
              "concepto_pago":$('input[name=concepto_pago]:checked') .val(),
              "nombre_concepto_pago":$('input[name=concepto_pago]:checked') .text(),
              "tipo_pago":$('input[name=tipo_pago]:checked') .val(),
              "nombre_tipo_pago":$('input[name=tipo_pago]:checked') .text(),
              "cantidad_pago":$('#cantidad_pago') .val(),
              "cantidad_adeudo":$('#adeudo_participante') .text()
            }).done(function(data) {              
               
              if(data.resultado==0){  
                generarPDF(data.folio);

           $("#myDialogText").text("Pago realizado con exito \n");
            $("#myDialogText").append( "  <a target='_blank' href='/pagos/"+data.folio+".pdf'>Imprimir recibo</a>" );
                $("#dialog-ok").dialog("open");
               
             }
             else {
                 $("#myDialogText").text(data.mensaje);
                $("#dialog-ok").dialog("open");
             }

            }).fail(function(data){

            });         
        }else
        {
            $("#myDialogText").text("Faltan por especificar algunos campos");
            $( "#dialog-ok" ).dialog( "open" );
        }
});

$('#buscar').live('click',function(){

  buscar();


});

});
function generarPDF($folio)
{
  $.post("/sistema/creaPDF", 
            { 
         "id_folio":$folio,     
        "id_participante":$('#matricula_info').text(),
        "nombre_participante":$('#nombre_enrolador').text(),
        "id_curso":$('#id_curso_enrolador').text(),
        "nombre_curso":$('#curso_enrolador').text(),
        "concepto_pago":$('input[name=concepto_pago]:checked') .val(),
        "nombre_concepto_pago":$('input[name=concepto_pago]:checked') .text(),
        "tipo_pago":$('input[name=tipo_pago]:checked') .val(),
        "nombre_tipo_pago":$('input[name=tipo_pago]:checked') .text(),
        "cantidad_pago":$('#cantidad_pago') .val(),
        "cantidad_adeudo":$('#adeudo_participante') .text()
      },
      function(data){
        console.log(data.resultado);
      
          

        
      }, 
      "json");
}

function buscar(){
          $.post("/sistema/findParticipante", 
  { 

    "matricula_enrolador":$('#matricula_enrolador').val()

  },
  function(data){
    
      

     $('#info_matricula_enrolador').show();
     $('#matricula_info').text((data.participante[0].id_participante!="")?data.participante[0].id_participante:"     ");
     $('#nombre_enrolador').text(data.participante[0].nombre);
     $('#curso_enrolador').text(data.participante[0].nombre_curso+" "+data.participante[0].generacion);
     $('#id_curso_enrolador').text(data.participante[0].id_curso);
     $('#usuario_enrolador').text(data.participante[0].usuario);
     $('#email_enrolador').text((data.participante[0].email!="") ?data.participante[0].email:"No contiene información");
     $('#adeudo_participante').text(data.adeudo);
     $('#telfijo_enrolador').text((data.participante[0].telefono !="") ?data.participante[0].telefono : "No contiene información");
     $('#telcontacto_enrolador').text((data.participante[0].celular!="")?data.participante[0].celular:"No contiene información");
     $('#domicilio_enrolador').text((data.participante[0].domicilio!="")?data.participante[0].domicilio:"No contiene información");
  
 }, 
 "json");
  }
