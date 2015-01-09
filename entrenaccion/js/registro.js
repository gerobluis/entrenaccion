
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
    dialogInfo = $("#dialog-form").dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        OK: function() {
          dialogInfo.dialog( "destroy" );
        }
      },
      close: function() {

        dialogInfo.dialog( "destroy" );
      }
    });
    $.extend( $.fn.dataTableExt.oStdClasses, {
      "sWrapper": "dataTables_wrapper form-inline"
    } );

    $('#buscar').live('click',function(){

     var GoptionSelected = $( "#generacion" ).val();
     var CoptionSelected = $( "#s_cursos option:selected" ).val();
     var bValid = true;


     bValid = bValid &&  GoptionSelected!="#";
     bValid = bValid &&  CoptionSelected!="0";
     if(bValid)
       $.post("/sistema/get_participantes_by_genandcurso", 
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
         if (data.resultados[i].pago_completo == 1){ status ='Listo'} else { status ='Pendiente'};
         t.row.add( [
          data.resultados[i].id_participante,
          data.resultados[i].inscripcion,
          data.resultados[i].nombre+' - '+ data.resultados[i].usuario,
          status,
          '<button id="'+data.resultados[i].id_participante+'" type="button" class="btn btn-warning"  onclick="registrar('+data.resultados[i].id_participante+')">Registrar</button>',
          '<button type="button" class="btn btn-warning"  onclick="info('+data.resultados[i].id_participante+')">Ver Info</button>',
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
   $.post("/sistema/cerrarRegistro", 
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





  $('#button').click(function () {

  });
  });

  function registrar(participante){

   var GoptionSelected = $( "#generacion option:selected" ).text();
   var CoptionSelected = $( "#s_cursos option:selected" ).val();
   $.post("/sistema/registrar", 
    { "id_participante":participante,
    "gen":GoptionSelected,
    "curso":CoptionSelected},
    function(data){
      if(data.response=="exito"){
        alert("Error el ejecutivo no ha sincronizado");
      }else{

       $('#'+participante).parents('tr').remove();

     }
     var t=$('#tableRegistro');
     $('#tableRegistro tbody').on( 'click', '#'+participante+'', function () {
      if ( $(this).parents('tr').hasClass('selected') ) {
       $(this).parents('tr').removeClass('selected');
     }
     else {
      t.$('tr.selected').removeClass('selected');
      $(this).parents('tr').addClass('selected');
    }
    t.row('.selected').remove().draw( false );
  } );
   }, 
   "json");


  }
  function info(id){



    var name      = $("#name"),      
    tel_fijo      = $("#tel_fijo"),
    tel_cel       = $("#tel_cel"),
    email         = $("#email"),
    edad          = $("#edad"),
    domicilio     = $("#domicilio");
    $.post("/sistema/getParticipanteDetalle",
      {"id":id},
      function(data){
        console.log(data);
        name.val(data.resultado[0].nombre);
        tel_fijo.val(data.resultado[0].telefono);
        tel_cel.val(data.resultado[0].celular);
        email.val(data.resultado[0].email);
        edad.val(data.resultado[0].edad);
        domicilio.val(data.resultado[0].domicilio);
      },"json");
    dialogInfo = $("#dialog-form").dialog({
      autoOpen: false,
      height: 340,
      width: 450,
      modal: true,
      buttons: {
        OK: function() {
          dialogInfo.dialog("destroy");
          $('#dialog-form').hide();
        }
      },
      close: function() {

        dialogInfo.dialog("destroy");
        $('#dialog-form').hide();
      }
    });
    dialogInfo.dialog("open");
  }


