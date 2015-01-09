 var  dialogInfo;
 $(document).ready(function  () {  
 $('#historial').hide();
 $('#preloader').hide();
  $('#container_chart').hide();
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
   $('#id_curso_enrolador').hide();
   


   $('#btn_seguimiento').click(function() {
     $('#titulo').text('Participantes');
       $('#preloader').show();
    
     $.post("/sistema/getParticipantes", 
       {  },
       function(data){
       
        var rows = t
        .rows()
        .remove()
        .draw();      
        for(var i = 0; i < data.resultados.length; i++){
         var curso= "Intro";
        
         switch (data.resultados[i].id_curso){
          case  1:
          curso="Intro ";
          break;
          case 2:
          curso="VIP ";
          break;
          case 3:
          curso="PRO 1 ";
          break;
        }
        t.row.add( [
          data.resultados[i].id_participante,
          data.resultados[i].nombre,
          curso+" " +data.resultados[i].generacion,
          '<button type="button" class="btn btn-warning"  onclick="info('+data.resultados[i].id_participante+')">Ver Info</button>',                    
          ] ).draw();
      }

      $('#preloader').hide();
    }, 
    "json");

     $('#historial').show();

   });
   $('#btn_par_ade').click(function() {
     $('#titulo').text('Participantes con adeudo');
       $('#preloader').show();
     $.post("/sistema/getParticipantesAdeudo", 
       {  },
       function(data){
        console.log(data);
        var rows = t
        .rows()
        .remove()
        .draw();
        console.log(data.resultados.length);
        for(var i = 0; i < data.resultados.length; i++){
         var curso= "Intro";
        
         switch (data.resultados[i].id_curso){
          case  1:
          curso="Intro ";
          break;
          case 2:
          curso="VIP ";
          break;
          case 3:
          curso="PRO 1 ";
          break;
        }
        t.row.add( [
          data.resultados[i].id_participante,
          data.resultados[i].nombre,
          curso+" " +data.resultados[i].generacion,
          '<button type="button" class="btn btn-warning"  onclick="info('+data.resultados[i].id_participante+')">Ver Info</button>',                    
          ] ).draw();
      }

  $('#preloader').hide();
    }, 
    "json");

     $('#historial').show();

   });

   $('#btn_back_lock').click(function() {
     $('#titulo').text('Backlocks');
       $('#preloader').show();
     $.post("/sistema/getBackLocks", 
       {  },
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
          curso+" " +data.resultados[i].generacion,
          '<button type="button" class="btn btn-warning"  onclick="info('+data.resultados[i].id_participante+')">Ver Info</button>',                    
          ] ).draw();
      }

   jQuery("#preloader").delay(1000).fadeOut("slow"); 


    }, 
    "json");
     $('#container_chart').hide(); 
     $('#historial').show();

   });

   $('#btn_dro_ps').click(function() {
    $('#titulo').text('Drops');
     $('#preloader').show();
            var done=true;
            if(done){
             $.post("/sistema/getDrops", 
               {  },
               function(data){

                var rows = t
                .rows()
                .remove()
                .draw();
               var total=data.resultados.length;
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
                  curso="PRO 1er Fin";
                  break;
                }
                t.row.add( [
                  data.resultados[i].id_participante,
                  data.resultados[i].nombre,
                  curso+" " +data.resultados[i].generacion,
                  '<button type="button" class="btn btn-warning"  onclick="info('+data.resultados[i].id_participante+')">Ver Info</button>',
                  ] ).draw();

                 document.getElementById('done').innerHTML=(i/total*100)+'%';
              }
              
              
            }, 
            "json");
           }
             jQuery("#preloader").delay(1000).fadeOut("slow"); 
           $('#container_chart').hide();
           $('#historial').show();

         });

  $('#btn_ten_cre').click(function() {
     $('#container_chart').show();
      $('#historial').hide();
    $('#titulo').text('Tendencia');
         /*var orderArrayHeader = ["Matricula","Datos del participante","Entrenamiento"];
          var thead = document.createElement('thead');
          var table=document.getElementById('tableRegistro').deleteTHead();
          document.getElementById('tableRegistro').appendChild(thead);
          for(var i=0;i<orderArrayHeader.length;i++){        
              thead.appendChild(document.createElement("th")).appendChild(document.createTextNode(orderArrayHeader[i]));
            }*/
            var done=true;
            if(done){
             $.post("/sistema/getTendencia", 
               {  },
               function(data){
                console.log(data);
                var items=[];
                var quantity=[];
                for( i = 0; i < data.resultados.length; i++){
                        
                        items.push(data.resultados[i].generacion);
                        quantity.push(parseInt(data.resultados[i].total));
                       }
                       console.log(quantity);
                $('#container_chart').highcharts({
                    title: {
                        text: 'Tendencia / Crecimiento',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Entrenaccion México',
                        x: -20
                    },
                    xAxis: {
                       categories:items
                       /* categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']*/
                    },
                    yAxis: {
                        title: {
                            text: 'Participantes'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [{
                        name: 'Participantes',
                        data: quantity
                    }]
                });
              
              
            }, 
            "json");
           }
           $('#historial').hide();
           
         });
  $('#btn_por_con').live('click',function() {
     $('#container_chart').show();
      $('#historial').hide();
    $('#titulo').text('Porcentaje continuidad');
         /*var orderArrayHeader = ["Matricula","Datos del participante","Entrenamiento"];
          var thead = document.createElement('thead');
          var table=document.getElementById('tableRegistro').deleteTHead();
          document.getElementById('tableRegistro').appendChild(thead);
          for(var i=0;i<orderArrayHeader.length;i++){        
              thead.appendChild(document.createElement("th")).appendChild(document.createTextNode(orderArrayHeader[i]));
            }*/
            var done=true;
            if(done){
             $.post("/sistema/porcentajeContinuidad", 
               {  },
               function(data){
                console.log(data);
               

                        
                      var x=  parseInt(data.resultados[0].total);
                      var y=  parseInt(data.resultados[1].total);
                      var z=  parseInt(data.resultados[2].total);

                      var vip_percent=y*100/x;
                      var pro_percent=z*(50-vip_percent)/y;
                      var intro_percent=100-vip_percent;
                       
    var colors = Highcharts.getOptions().colors,
        categories = ['INTRO', 'VIP', 'PRO'],
        data = [{
            y: intro_percent,
            color: colors[0],
            drilldown: {
                name: 'Generaccion',
                categories: ['27', '28', '29', '30'],
                data: [10.85, 7.35, 23.06, 2.81],
                color: colors[0]
            }
        }, {
            y: vip_percent,
            color: colors[1],
            drilldown: {
                name: 'Generaccion',
                categories: ['Firefox 2.0', 'Firefox 3.0', 'Firefox 3.5', 'Firefox 3.6', 'Firefox 4.0'],
                data: [0.20, 0.83, 1.58, 13.12, 5.43],
                color: colors[1]
            }
        }, {
            y: pro_percent,
            color: colors[2],
            drilldown: {
                name: 'Generaccion',
                categories: ['Chrome 5.0', 'Chrome 6.0', 'Chrome 7.0', 'Chrome 8.0', 'Chrome 9.0',
                    'Chrome 10.0', 'Chrome 11.0', 'Chrome 12.0'],
                data: [0.12, 0.19, 0.12, 0.36, 0.32, 9.91, 0.50, 0.22],
                color: colors[2]
            }
        }],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    $('#container_chart').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
            name: 'Cursos',
            data: browserData,
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -30
            }
        }]
    });
   },"json");
  }
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
   }, function(data){
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

