 var t;
 $(document).ready(function  () {  
   $('#historial').hide();
   $('#container_chart').hide();
   $('#id_curso_enrolador').hide();
   var btn_new_user =$('#btn_nuevo_usuario'),
   btn_new_curse=$('#btn_nuevo_curso'),
   btn_new_promo=$('#btn_nueva_promo');
   ///////////////////////////////////////////////////////////////////////////////////////////////////
   t=$('#tableRegistro').DataTable({
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
///////////////////////////////////////////////////////////////////////////////////////////////////
   $.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
  } );
///////////////////////////////////////////////////////////////////////////////////////////////////   
   $("#dialog-ok" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,
    modal: true,
    buttons: {
     
      OK: function() {
        $( this ).dialog( "close" );
      }
    },close: function(event, ui) { window.location.href = "/sistema/promociones"; }
   
  });
///////////////////////////////BOTON ACCESOS///////////////////////////////////////////   
  
   $('#btn_accesos').click(function() {
    btn_new_user.show();
    btn_new_curse.hide();
    btn_new_promo.hide();
    $('#titulo').text('Lista de Usuarios');
    $.post("/sistema/getAccesos", 
     {  },
     function(data){
      console.log(data);
      var rows = t
      .rows()
      .remove()
      .draw();
      
      for(var i = 0; i < data.resultados.length; i++){ 
        t.row.add( [         
          data.resultados[i].Usuario,
          '<button type="button" class="btn btn-warning"  onclick="editarUsuario('+data.resultados[i].id_admin+')">Editar</button>',
          '<button type="button" class="btn btn-warning"  onclick="eliminarUsuario('+data.resultados[i].id_admin+')">Eliminar</button>'                                        
          ] ).draw();

      }

    }, 
    "json");

    $('#historial').show();

  });
///////////////////////////////BOTON CURSOS/////////////////////////////////////////// 
   $('#btn_cursos').click(function() {
     btn_new_user.hide();
     btn_new_curse.show();
     btn_new_promo.hide();
     $('#titulo').text('Listado de Entrenamientos');
     $.post("/sistema/getEntrenamientos", 
       {  },
       function(data){

        var rows = t
        .rows()
        .remove()
        .draw();
        console.log(data.resultados.length);
        for(var i = 0; i < data.resultados.length; i++){

          t.row.add( [        
            data.resultados[i].nombre_curso,
            '<button type="button" class="btn btn-warning"  onclick="editarCurso('+data.resultados[i].id_curso+')">Editar</button>',
            '<a></a>'                    
            ] ).draw();
        }


      }, 
      "json");
     $('#container_chart').hide(); 
     $('#historial').show();

   });
///////////////////////////////BOTON PROMOS/////////////////////////////////////////// 
   $('#btn_promos').click(function() {
     btn_new_user.hide();
     btn_new_curse.hide();
     btn_new_promo.show();
     $('#titulo').text('Lista de Promociones');
         /*var orderArrayHeader = ["Matricula","Datos del participante","Entrenamiento"];
          var thead = document.createElement('thead');
          var table=document.getElementById('tableRegistro').deleteTHead();
          document.getElementById('tableRegistro').appendChild(thead);
          for(var i=0;i<orderArrayHeader.length;i++){        
              thead.appendChild(document.createElement("th")).appendChild(document.createTextNode(orderArrayHeader[i]));
            }*/
            var done=true;
            if(done){
             $.post("/sistema/getPromociones", 
               {  },
               function(data){
                console.log(data);
                var rows = t
                .rows()
                .remove()
                .draw();
                console.log(data.resultados.length);
                for(var i = 0; i < data.resultados.length; i++){

                  t.row.add( [
                    data.resultados[i].descripcion,
                    '<button type="button" class="btn btn-warning"  onclick="editar('+data.resultados[i].id_curso+')">Editar</button>',
                    '<button type="button" class="btn btn-warning"  onclick="eliminar('+data.resultados[i].id_curso+')">Activar/Desactivar</button>'
                    ] ).draw();
                }


              }, 
              "json");
           }
           $('#container_chart').hide();
           $('#historial').show();

         });

 var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      name      = $( "#nombre" ),
      email     = $( "#email" ),
      password  = $( "#contrasena" ),
      nom_curso = $( "#nom_curso" ),
      des_curso = $( "#des_curso" ),
      costo     = $( "#costo" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );

      function updateTips( t ) {
        tips
        .text( t )
        .addClass( "ui-state-highlight" );
        setTimeout(function() {
          tips.removeClass( "ui-state-highlight", 1500 );
        }, 500 );
      }

      function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
          o.addClass( "ui-state-error" );
          updateTips( "Length of " + n + " must be between " +
            min + " and " + max + "." );
          return false;
        } else {
          return true;
        }
      }

      function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
          o.addClass( "ui-state-error" );
          updateTips( n );
          return false;
        } else {
          return true;
        }
      }

      function addUser() {
        var valid = true;
        allFields.removeClass( "ui-state-error" );

        valid = valid && checkLength( name, "username", 3, 16 );     
        valid = valid && checkLength( password, "password", 5, 16 );

        valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );

        valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

        if ( valid ) {
         $.post("/sistema/creaUsuario", 
         { 
           "username":name.val(),     
           "password":password.val()
         },
         function(data){
          console.log(data.resultado);
          console.log(data);
          var rows = t
          .rows()
          .remove()
          .draw();

          for(var i = 0; i < data.resultados.length; i++){ 
            t.row.add( [             
              data.resultados[i].Usuario,
              '<button type="button" class="btn"  onclick="editarUsuario('+data.resultados[i].id_admin+')">Editar</button>',
              '<button type="button" class="btn"  onclick="eliminarUsuario('+data.resultados[i].id_admin+')">Eliminar</button>'                                        
              ] ).draw();

          }
        }, 
        "json");
         dialogUsuario.dialog( "close" );
       }
       return valid;
     }

     dialogUsuario = $( "#dialog-form-usuario" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,   
      modal: true,
      buttons: {
        "Crear usuario": addUser,
        Cancel: function() {
          dialogUsuario.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });

     form = dialogUsuario.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });

     $( "#btn_nuevo_usuario" ).button().on( "click", function() {
      dialogUsuario.dialog( "open" );
    });
     function addCurso() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );

      valid = valid && checkLength( nom_curso, "username", 3, 16 );
      valid = valid && checkLength( des_curso, "email", 6, 80 );
      valid = valid && checkLength( costo, "password", 2, 16 );

      valid = valid && checkRegexp( nom_curso, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      valid = valid && checkRegexp( des_curso, /^[a-z]([0-9a-z_\s])+$/i, "eg. ui@jquery.com" );
      valid = valid && checkRegexp( costo, /^([0-9])+$/, "El campo solo permite números" );

      if ( valid ) {
       $.post("/sistema/creaCurso", 
       { 
         "descripcion"  :des_curso.val(),
         "nombre_curso" :nom_curso.val(),
         "costo"        :costo.val()
       },
       function(data){
        console.log(data.resultado);
        console.log(data);
        var rows = t
        .rows()
        .remove()
        .draw();

        for(var i = 0; i < data.resultados.length; i++){

          t.row.add( [        
            data.resultados[i].nombre_curso,
            '<button type="button" class="btn"  onclick="editar('+data.resultados[i].id_curso+')">Editar</button>',
            '<button type="button" class="btn"  onclick="eliminarCurso('+data.resultados[i].id_curso+')">Eliminar</button>'                    
            ] ).draw();
        }



      }, 
      "json");
       dialogCurso.dialog( "close" );
     }
     return valid;
   }
///////////////////////////////////////////////////////////////////////////////////////////////////
   dialogCurso = $( "#dialog-form-curso" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,
    modal: true,
    buttons: {
      "Crear curso": addCurso,
      Cancel: function() {
        dialogCurso.dialog( "close" );
      }
    },
    close: function() {
      form[ 0 ].reset();
      allFields.removeClass( "ui-state-error" );
    }
  });
///////////////////////////////////////////////////////////////////////////////////////////////////
   form = dialogCurso.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    addCurso();
  });
///////////////////////////////////////////////////////////////////////////////////////////////////

  $( "#btn_nuevo_curso" ).button().on( "click", function() {

    dialogCurso.dialog( "open" );
  });
///////////////////////////////////////////////////////////////////////////////////////////////////   
   function addPromo() {
    var valid = true;
    allFields.removeClass( "ui-state-error" );

    valid = valid && checkLength( name, "username", 3, 16 );
    valid = valid && checkLength( email, "email", 6, 80 );
    valid = valid && checkLength( password, "password", 5, 16 );

    valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i,
     "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
    valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
    valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

    if ( valid ) {
     $.post("/sistema/creaUsuario", 
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
     dialog.dialog( "close" );
   }
   return valid;
 }
//////////////////////////////////////////////////////////////////////////////////////////////////////////
 dialogPromo = $( "#dialog-form-promo" ).dialog({
  autoOpen: false,
  height: 300,
  width: 350,
  modal: true,
  buttons: {
    "Crear promocion": addPromo,
    Cancel: function() {
      dialogPromo.dialog( "close" );
    }
  },
  close: function() {
    form[ 0 ].reset();
    allFields.removeClass( "ui-state-error" );
  }
});
///////////////////////////////////////////////////////////////////////////////////////////////////
 
 form = dialogPromo.find( "form" ).on( "submit", function( event ) {
  event.preventDefault();
  addPromo();
});
/////////////////////////////////////////////////////////////////////////////////////////////////// 
 $( "#btn_nueva_promo" ).button().on( "click", function() {
   $('#date').datepicker({title:'Test Dialog'});
  dialogPromo.dialog( "open" );
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
/**
*@function editarUsuario
*@param id_usuario
*@return void
*/
function editarUsuario(usuario){
  var name      = $("#nombre"),      
  password      = $("#contrasena");
 
   $.post("/sistema/getUsuario", 
   { "id_usuario":usuario },
    function(data){
       
        name.val(data.usuario);
        password.val(data.password);
      }, 
      "json");
  
  var dialogUsuario = $( "#dialog-form-usuario" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,   
    modal: true,
    buttons: {
      "Editar usuario": function(){
       $.post("/sistema/editarUsuario", 
         { 
          "id_usuario":usuario,
          "nombre":name.val(),
          "password":password.val()
         },
       function(data){
        console.log(data); 

        var rows = t.rows().remove().draw();

        for(var i = 0; i < data.resultados.length; i++){ 
          t.row.add( [       
            data.resultados[i].Usuario,
            '<button type="button" class="btn"  onclick="editarUsuario('+data.resultados[i].id_admin+')">Editar</button>',
            '<button type="button" class="btn"  onclick="eliminarUsuario('+data.resultados[i].id_admin+')">Eliminar</button>'                                        
            ] ).draw();

        }


      }, 
      "json");
        dialogUsuario.dialog( "close" );
     } ,
     Cancel: function() {
      dialogUsuario.dialog( "close" );
    }
  },
  close: function() {
    form[ 0 ].reset();
    allFields.removeClass( "ui-state-error" );
  }
});

  form = dialogUsuario.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    addUser();
  });
  dialogUsuario.dialog("open");

}
function editarCurso(curso){
  var name      = $("#nombre"),      
  password      = $("#contrasena");
 
   $.post("/sistema/getCurso", 
   { "id_usuario":usuario },
    function(data){
        console.log(data); 
        name.val(data.usuario);
        password.val(data.password);
      }, 
      "json");
  
  var dialogCurso = $( "#dialog-form-curso" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,   
    modal: true,
    buttons: {
      "Editar usuario": function(){
       $.post("/sistema/editarCurso", 
         { 
          "id_usuario":usuario,
          "nombre":name.val(),
          "password":password.val()
         },
       function(data){
        console.log(data); 

        var rows = t.rows().remove().draw();

        for(var i = 0; i < data.resultados.length; i++){ 
          t.row.add( [       
            data.resultados[i].Usuario,
            '<button type="button" class="btn"  onclick="editarCurso('+data.resultados[i].id_admin+')">Editar</button>',
           
            ] ).draw();

        }


      }, 
      "json");
        dialogCurso.dialog( "close" );
     } ,
     Cancel: function() {
      dialogCurso.dialog( "close" );
    }
  },
  close: function() {
    form[ 0 ].reset();
    allFields.removeClass( "ui-state-error" );
  }
});

  form = dialogCurso.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    addUser();
  });
  dialogCurso.dialog("open");

}
function eliminarUsuario(usuario){
 $.post("/sistema/deleteUsuario", 
   { "id_admin":usuario},
   function(data){
    console.log(data); 
    
    var rows = t
    .rows()
    .remove()
    .draw();

    for(var i = 0; i < data.resultados.length; i++){ 
      t.row.add( [       
        data.resultados[i].Usuario,
        '<button type="button" class="btn"  onclick="editar('+data.resultados[i].id_admin+')">Editar</button>',
        '<button type="button" class="btn"  onclick="eliminarUsuario('+data.resultados[i].id_admin+')">Eliminar</button>'                                        
        ] ).draw();

    }


  }, 
  "json");
}
function eliminarCurso(curso){
 $.post("/sistema/deleteCurso", 
   { "id_curso":curso},
   function(data){
    console.log(data); 
    
    var rows = t
    .rows()
    .remove()
    .draw();
    
    for(var i = 0; i < data.resultados.length; i++){

      t.row.add( [        
        data.resultados[i].nombre_curso,
        '<button type="button" class="btn"  onclick="editar('+data.resultados[i].id_curso+')">Editar</button>',
        '<button type="button" class="btn"  onclick="eliminarCurso('+data.resultados[i].id_curso+')">Eliminar</button>'                    
        ] ).draw();
    }

    
  }, 
  "json");
}
function eliminarPromo(usuario){
 $.post("/sistema/deletePromo", 
   { "id_admin":usuario},
   function(data){
    console.log(data); 
    
    var rows = t
    .rows()
    .remove()
    .draw();
    
    for(var i = 0; i < data.resultados.length; i++){ 
      t.row.add( [
        data.resultados[i].id_admin,
        data.resultados[i].Usuario,
        '<button type="button" class="btn"  onclick="editar('+data.resultados[i].id_admin+')">Editar</button>',
        '<button type="button" class="btn"  onclick="eliminarPromo('+data.resultados[i].id_admin+')">Eliminar</button>'                                        
        ] ).draw();
      
    }

    
  }, 
  "json");
}

function info(id){
  $.post("sistema/getParticipanteDetalle",
      {"id":id},
      function(data){
                dialogInfo = $( "#dialog-form-info" ).dialog({
                autoOpen: false,
                height: 300,
                width: 350,
                modal: true,
          buttons: {
              Ok: function() {
              dialogInfo.dialog( "close" );
            }
          },
          close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
          }
        });
      data.resultado
    },"json");
}