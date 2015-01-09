<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Llamada de preparación</title>
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.min.css\"";?> >
  
  
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/main.css\"";?>>
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/registro.css\"";?>>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.js\"";?>></script>  

  
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
   <script type="text/javascript"src=<?php echo "\"".base_url() ."js/registro.js\"";?>></script>  
  


</head>
<body>
  <div class="navbar navbar-default navbar-static-top navbar-main" role="navigation">
    <div class="navbar-header"><a href="/sistema/inicio"><img src=<?php echo "\"".base_url() ."img/logo-entrenaccion.jpg\"";?>></a>

    </div>
   <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
          <a href="#" class="dropdown-toggle avatar pull-right" data-toggle="dropdown">
           <span class="hidden-small">Bienvenido, <?php echo $user ?><b class="caret"></b></span>
          </a>
          <ul >
          <li><a href="/sistema/promociones"><i class="fa fa-gear"></i>Account Settings</a></li>        
          <li class="divider"></li>
          <li><a href="/sistema/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
          </ul>
      </li>
    </ul>

  </div>
  <div class="container">
   <div class="span12">
    <legend>Registro de participantes</legend>
    <div class="row clearfix" id="menu">
      <div class="span3">
        <label class="control-label" for="Generación">Generación</label>
        <div class="controls">
           <input id="generacion" name="generacion" type="text" class="input-mini">  
        </div>
      </div>
      <div class="span3">
        <label class="control-label" for="textinput">Curso</label>

        <div class="controls">
         <select id="s_cursos" name="s_cursos" class="input-large">
          <option value="0">Seleccione..</option>
          <option value="1">Intro</option>
          <option value="2">VIP</option>   
          <option value="3">PRO</option>
        </select>

      </div>
    </div>
    <div class="span3">
      <button id="buscar" type="button" class="btn btn-success">Buscar</button>
    </div>
    <button id="cerrar_registro" class="btn btn-danger" type="button">Cerrar Registro</button>


  </div>     
</div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tableRegistro" >
  <thead>
    <tr>
      <th class="span2">Matricula</th>
      <th class="span2">Generación Inscripción</th>
      <th>Datos</th>                
      <th class="span1">Status Pago</th>
      <!--th class="span1">Status de Solicitud</th>
      <th class="span1">Status Preparación</th-->
      <th class="span2">Registrar</th>
        <th class="span2">Ver Info</th>
    </tr>
  </thead>

  <tbody>
  
 </tbody>
</table>


</div>
<div id="dialog-ok" title="Mensaje">
  <p class="validateTips"></p>
  <div id="myDialogText"></div>
  <form>
  <fieldset>
    <label></label>
    
  </fieldset>
  </form>
</div> 
<div id="dialog-form" title="Información">
   
      
      <form>
        <fieldset>
       
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name"  class="text ui-widget-content ui-corner-all">
        <label for="tel_fijo">Telefono fijo</label>
        <input type="text" name="tel_fijo" id="tel_fijo"  class="text ui-widget-content ui-corner-all">
        <label for="tel_cel">Telefono celular</label>
        <input type="text" name="tel_cel" id="tel_cel"  class="text ui-widget-content ui-corner-all">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"  class="text ui-widget-content ui-corner-all">
        <label for="edad">Edad</label>
        <input type="text" name="edad" id="edad"  class="text ui-widget-content ui-corner-all">
        <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio" id="domicilio"  class="text ui-widget-content ui-corner-all">
        

        <!-- Allow form submission with keyboard without duplicating the dialog button -->
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>
</body>