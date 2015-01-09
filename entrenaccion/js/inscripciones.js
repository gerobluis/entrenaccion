  $(document).ready(function  () {
    $('#a').hide(); $('#ab').hide(); $('#ac').hide(); $('#ad').hide();
    $('#ae').hide();$('#af').hide();$('#ag').hide();$('#ah').hide();$('#ai').hide();
    $('#aj').hide();
   

    $('#s_cursos').change(function(){
     $('#ag').show();

     if($('#s_cursos').val() == '1') {
      $('#guardar').text("Enrolar");
      $('#a').show();
      $('#ab').show();  
      $('#ah').show();
      $('#ai').show();
      $('#aj').show();
      $('#ac').hide(); 
      $('#ae').hide();
    } else if($('#s_cursos').val() == '2'|| '3') {
       $('#guardar').text("Inscribir");
       $('#ac').show(); 
       $('#ah').show();
       $('#ai').show();
       $('#aj').show();
       $('#a').hide(); 
       $('#ad').hide();
       $('#ae').hide();
       $('#ab').hide();  
   } 
   if($('#s_cursos').val() == '0') {
    $('#a').hide();
    $('#ab').hide();  
    $('#ac').hide();
    $('#ad').hide();
    $('#ae').hide();
    $('#af').hide();
    $('#ag').hide();$('#ah').hide();$('#ai').hide(); $('#aj').hide();
  }
});

    $('#element_off').click(function() {
     if($('#element_off').is(':checked')) { 
       $('#ad').hide();
       $('#ae').hide();
     }
   });

    $('#element_on').click(function() {
     if($('#element_on').is(':checked')) { 
       $('#ad').show();
    
     }
   }); 

    $('#cancelar').live('click',function(){
     history.back();
   });
    $('#guardar').live('click',function(){
     if($('#s_cursos').val() == '1') {
         
            var matricula_enrolador=0;
            var fin_enrolamiento=0;
           if($('#element_on').is(':checked')) { 
            console.log($('#fin_enrolamiento').val+$('#matricula_enrolador').val());
               matricula_enrolador=$('#matricula_enrolador').val();                
               fin_enrolamiento=$('#fin_enrolamiento').val();
              }
          $.post("/sistema/enrolar", 
            { 
              "matricula_enrolador":matricula_enrolador,
              "fin_enrolamiento":fin_enrolamiento,
              "id_curso":$('#s_cursos').val(),
              "generacion":$('#generacion').val(),
              "name":$('#name').val().toUpperCase(),"user":$('#user').val().toUpperCase(),
              "edad":$('#edad').val(),"email":$('#email').val().toUpperCase(),"tel_fijo":$('#tel_fijo').val(),
              "tel_contacto":$('#tel_contacto').val(),"domicilio":$('#domicilio').val().toUpperCase(),
              "municipio":$('#municipio').val(),
              "c1_nombre":$('#c1_nombre').val().toUpperCase(),"c1_tel_fijo":$('#c1_tel_fijo').val(),
              "c1_tel_contacto":$('#c1_tel_contacto').val(),"c1_domicilio":$('#c1_domicilio').val().toUpperCase(),"c1_relacion":$('#c1_relacion').val(),
              "c2_nombre":$('#c2_nombre').val().toUpperCase(),"c2_tel_fijo":$('#c2_tel_fijo').val(),
              "c2_tel_contacto":$('#c2_tel_contacto').val(),"c2_domicilio":$('#c2_domicilio').val().toUpperCase(),"c2_relacion":$('#c2_relacion').val(),
              "meta1":$('#meta1').val(),"meta2":$('#meta2').val(),"meta3":$('#meta3').val(),
              "firma":$('input[name=firma]:checked') .val(), "medica":$('input[name=medica]:checked') .val(),
              "contactos":$('input[name=contactos]:checked') .val(), "tarea":$('input[name=tarea]:checked') .val(),
              "beca":$('input[name=beca]:checked') .val(), "codigo_promo":$('#s_promociones').val()
              },
            function(data){
              if(data.mensaje==1){
                alert("Error");
              }else{
                $("#myDialogText").text("Tu matricula es:"+data.matricula);
                $("#dialog-ok").dialog({

                       close: function(event, ui) { window.location.href = "/sistema/inicio"; }
                });
              //  alert("La matricula es:"+data.matricula);
               
              }
            }, 
            "json");
      
          
      }else if($('#s_cursos').val() == '2'|| '3') {
         $.post("/sistema/inscribir", 
            { 
             
            "id_curso":$('#s_cursos').val(),
            "generacion":$('#generacion').val(),
            "id_participante":$('#matricula_info').text(),
            "meta1":$('#meta1').val(),"meta2":$('#meta2').val(),"meta3":$('#meta3').val(),
            "firma":$('input[name=firma]:checked') .val(), "medica":$('input[name=medica]:checked') .val(),
            "contactos":$('input[name=contactos]:checked') .val(), "tarea":$('input[name=tarea]:checked') .val(),
            "beca":$('input[name=beca]:checked') .val(), "codigo_promo":$('#s_promociones').val()
              },
            function(data){
             
                            if (data.resultado==1001){
                                $("#myDialogText").text(data.mensaje); 
                               
                                $("#dialog-ok").dialog({
                                   buttons: {
                                      "Ir a caja": function() {
                                       $(this).dialog( "close" );
                                      window.location.href = "caja";
                                              
                                      },
                                      Cancel: function() {
                                        $( this ).dialog( "close" );
                                      }
                                    }
                                  });
               
              }else if (data.resultado==1002){
                $("#myDialogText").text(data.mensaje); 
                $("#dialog-ok").data('participante',data.participante[0].id_participante);
                $("#dialog-ok").data('gen',data.participante[0].generacion);
                $("#dialog-ok").data('curso',data.participante[0].id_curso);
                $("#dialog-ok").dialog({
                   buttons: {
                      "Graduar participante": function() {
                       var participante= $(this).data('participante');
                       var gen= $(this).data('gen');
                       var curso= $(this).data('curso');
                             $.post("/sistema/graduar", 
                              { 
                                
                                "id_participante": participante,
                                "gen":gen,
                                "curso":curso
                              },function(data){
                                 $("#dialog-ok").dialog("close");
                                  $("#myDialogText").text(data.mensaje); 
                                  $("#dialog-ok").dialog();
                                },"json");
                            
                      },
                      Cancel: function() {
                        $( this ).dialog( "close" );
                      }
                    }
                  });
               
              }else{
               $("#myDialogText").text(data.mensaje); 
               $("#dialog-ok").dialog({
                   buttons: {
                     
                      "Ok": function() {
                        $( this ).dialog( "close" );
                      
                      }
                    }
                  });  
              }
            }, 
            "json");
        
     }
   });

    $('#buscar').live('click',function(){
   
          $.post("/sistema/findByMatr", 
            { 
             
              "matricula_enrolador":$('#matricula_enrolador').val()
          
              },
            function(data){
              if(data.mensaje==1){
                alert("Error el ejecutivo no ha sincronizado");
              }else{
                 $('#ae').show();
                $('#mat_enrolador').text(data.enrolador[0].id_participante);
                $('#nombre_enrolador').text(data.enrolador[0].nombre);
                $('#usuario_enrolador').text(data.enrolador[0].usuario);
                $('#email_enrolador').text(data.enrolador[0].email);
                $('#telfijo_enrolador').text(data.enrolador[0].tel_fijo);
                $('#telcontacto_enrolador').text(data.enrolador[0].tel_contacto);
                $('#domicilio_enrolador').text(data.enrolador[0].domicilio);
              }
            }, 
            "json");
          
     
   });
      $('#buscar_insc').live('click',function(){
   
          $.post("/sistema/findParticipante", 
            { 
             
              "matricula_enrolador":$('#matricula').val()
          
              },
            function(data){
              if(data.mensaje==1){
                alert("Error el ejecutivo no ha sincronizado");
              }else{
                     $('#af').show();
                     $('#matricula_info').text(data.participante[0].id_participante);
                     $('#nombre_info').text(data.participante[0].nombre);
                     $('#usuario_info').text(data.participante[0].usuario);
                     $('#curso_info').text(data.participante[0].nombre_curso+" "+data.participante[0].generacion);

                     $('#email_info').text((data.participante[0].email!="") ?data.participante[0].email:"No contiene información");
                     $('#telfijo_info').text((data.participante[0].telefono !="") ?data.participante[0].telefono : "No contiene información");
                     $('#telcontacto_info').text((data.participante[0].celular!="")?data.participante[0].celular:"No contiene información");
                     $('#domicilio_info').text((data.participante[0].domicilio!="")?data.participante[0].domicilio:"No contiene información");
              }
            }, 
            "json");
          
     
   });

});