<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Búsquedas</title>
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.min.css\"";?> >
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/registro.css\"";?>>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery.dataTables.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/DT_bootstrap.js\"";?>></script>

  <script type="text/javascript">
  
  $(document).ready(function  () {

     $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( name, "username", 3, 16 );
          bValid = bValid && checkLength( email, "email", 6, 80 );
          bValid = bValid && checkLength( password, "password", 5, 16 );
 
          bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if ( bValid ) {
            $( "#users tbody" ).append( "<tr>" +
              "<td>" + name.val() + "</td>" +
              "<td>" + email.val() + "</td>" +
              "<td>" + password.val() + "</td>" +
            "</tr>" );
            $( this ).dialog( "close" );
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });


    $('#table_registro').dataTable({
       "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "bPaginate": true,
      "sPaginationType": "full_numbers"
    });
     $.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
} );

  $('#generacion').on('change', function () {

   /*
   
       $.post("/sistema/get_participantes_gen", 
            { 
           
           
              },
            function(data){
             
              $('#table_registro tr').not(':first').remove();
                console.log(data.resultados.length);
                var html = '';
                var clas='';
                var status='';
                for(var i = 0; i < data.resultados.length; i++){
                    
                    if(data.resultados[i].preparacion != '') 
                      { clas+='class="success"'; }
                    else{ clas+='class="warning"';}
                    if(data.resultados[i].preparacion != '')  { status ='Listo'} else { status ='No listo'};
                     html += '<tr '+clas+'><td>' + data.resultados[i].id_participante + '</td><td>' + data.resultados[i].nombre + '</td>'
                      + '<td>' + status + '</td>'+'<td> <button type="button" class="btn" >Registrar</button></td>'+'</tr>'; 
                }
                  
                            
                console.log(html)
                $('#table_registro tr').first().after(html);
             $resultados=data;
            }, 
            "json");
   */
  });
    $('#buscar').live('click',function(){
           var BoptionSelected = $( "#s_options option:selected" ).val();
           var GoptionSelected = $( "#s_generacion option:selected" ).text();
           var CoptionSelected = $( "#s_cursos option:selected" ).val();
          $.post("/sistema/getParamBusqueda", 
            { 
              "b_param":BoptionSelected,
              "gen":GoptionSelected,
              "curso":CoptionSelected
          
              },
           function(data){
             
              $('#table_registro tr').not(':first').remove();
                console.log(data.resultados.length);
                var html = '';
                var clas='';
                var status='';
                for(var i = 0; i < data.resultados.length; i++){
                    
                    if(data.resultados[i].preparacion != '') 
                      { clas+='class="success"'; }
                    else{ clas+='class="warning"';}
                    if(data.resultados[i].preparacion == 1)  { status ='Listo'} else { status ='No listo'};
                     html += '<tr id="'+data.resultados[i].id_participante+'" '+clas+'>'+
                   
                    '<td class="id_participante">' + data.resultados[i].id_participante + '</td>'+                    
                    '<td>' + data.resultados[i].nombre+' - '+ data.resultados[i].usuario + '</td>'+
                    '</tr>'; 
                }
                  
                            
                console.log(html)
                $('#table_registro tr').first().after(html);
             $resultados=data;
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
  });


  

    </script>

  </head>
  <body>
    <div class="container">
    <a href="/sistema/inicio"><img src=<?php echo "\"".base_url() ."img/logo-entrenaccion.jpg\"";?>></a>
      <h2>Búsquedas</h2>
      <div class="row clearfix" id="menu">
        <div class="span3">
          <label class="control-label" for="Generación">Buscar por:</label>
          <div class="controls">
            <select id="s_options" name="options" class="input">  
              <option value="0">Seleccione</option> 
              <option value="1">Curso</option> 
              <option value="2">Generación</option>
              <option value="3">Participante</option>   
              
            </select>
          </div>
         </div>
          <div class="span3">
           
            <label class="control-label" for="textinput">Curso</label>
            <div class="controls">
             <select id="s_cursos" name="s_cursos" class="input-large">
               <option value="0">Seleccione</option>
               <?php 

            foreach($cursos as $row)
            { 
              echo '<option value="'.$row->id_curso.'">'.$row->nombre_curso.'</option>';
            }
            ?>
             
            
            </select>
            </div>
           </div>
           <div class="span3">
             <label class="control-label" for="textinput">Generación</label>
             <div class="controls">
           <select id="s_generacion" name="s_generacion" class="input-large">
            <option value="0">Seleccione</option>
            <option value="1">25</option>
            <option value="2">26</option>   
            <option value="3">27</option>
            <option value="1">28</option>
            <option value="2">29</option>   
            <option value="3">30</option>
          </select>
           </div>
          </div>
           <div class="span3">
            <button id="buscar" type="button" class="btn btn-success">Buscar</button>
          </div>
            <button id="cerrar_registro" class="btn btn-danger" type="button">Cerrar Registro</button>
         

        
</div>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="table_registro" >
          <thead>
            <tr>
              <th class="span2">#Matricula</th>
              
              <th>Datos</th>                
             
             
            </tr>
          </thead>
          <tbody>
           <tbody>
          <!--  <?php foreach ($resultados as $resultado) {
             $class = ($resultado->preparacion != '') ? 'class="success"' : 'class="warning"';
             $status = ($resultado->preparacion != '') ? 'Listo' : 'No listo';
             ?>
             <tr id="participante<?php echo $resultado->id_participante; ?>" <?php echo $class ?>> 
               <td><?php echo $resultado->id_participante; ?></td>
               <td><?php echo $resultado->nombre; ?></td>           
               
             

             </tr>
             <?php
           }
           ?>-->
         </tbody>
       </table>


     </div>
      <div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
  <fieldset>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
  </fieldset>
  </form>
</div>
   </body>