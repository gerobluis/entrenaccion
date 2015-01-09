<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Administración</title>
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.min.css\"";?> >

  
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/main.css\"";?>>
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/promociones.css\"";?>>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.js\"";?>></script>  

  
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/promociones.js\"";?>></script>
  <style type="text/css">
  .navbar-nav.navbar-right:last-child {
    margin-right: 0px;
    }</style>
  </head>
  <body>
    <div class="navbar navbar-default navbar-static-top navbar-main" role="navigation">
      <div class="navbar-header">
        <a href="/sistema/inicio"><img src=<?php echo "\"".base_url() ."img/logo-entrenaccion.jpg\"";?>></a>

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
    <div class="body">
      <aside class="sidebar">
        <ul class="nav nav-stacked">
          <li><a id="btn_accesos">Accesos al sistema</a></li>
          <li><a id="btn_cursos" >Entrenamientos</a></li>                      
          <li><a id="btn_promos">Promociones</a></li>

        </ul>
      </aside>
      <section class="content" style="min-height: 440px;">

       <div class="container">

        <div class="row clearfix">
          <div class="span12">  
            <div id="historial">
              <h1 id="titulo"></h1>
              <button id="btn_nuevo_usuario" class="btn btn-success" type="button">Nuevo Usuario</button>
              <button id="btn_nuevo_curso" class="btn btn-success" type="button">Nuevo Entrenamiento</button>
              <button id="btn_nueva_promo" class="btn btn-success" type="button">Nueva Promoción</button>
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tableRegistro" >
               <thead>
                <tr>
                
                  <th>Información</th>
                  <th></th>
                  <th></th>                                

                </tr>
              </thead>

              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <!-- END: CONTENT -->
      </section>
    </div> 
    <div id="dialog-ok" title="Aviso">
      <p class="validateTips"></p>
      <div id="myDialogText"></div>
      <form>
        <fieldset>


        </fieldset>
      </form>
    </div> 
    <div id="dialog-form-usuario" title="Crear nuevo usuario">
      <p class="validateTips">Todos los campos son requeridos.</p>

      <form>
        <fieldset>
          <label for="name">Usuario</label>
          <input type="text" name="name" id="nombre" value="">     
          <label for="password">Contraseña</label>
          <input type="password" name="password" id="contrasena"  value="" class="text ui-widget-content ui-corner-all">

          <!-- Allow form submission with keyboard without duplicating the dialog button -->
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
    </div>
    <div id="dialog-form-curso" title="Crear nuevo curso">
      <p class="validateTips">Todos los campos son requeridos.</p>

      <form>
        <fieldset>
          <label for="name">Nombre</label>
          <input type="text" name="name" id="nom_curso"  class="text ui-widget-content ui-corner-all">
          <label for="des_curso">Descripcion</label>
          <input type="text" name="des_curso" id="des_curso"  class="text ui-widget-content ui-corner-all">
          <label for="password">Costo</label>
          <input type="text" name="costo" id="costo"  class="text ui-widget-content ui-corner-all">

          <!-- Allow form submission with keyboard without duplicating the dialog button -->
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
    </div>
      <div id="dialog-form-promo" title="Crear nueva promoción">
      <p class="validateTips">Todos los campos son requeridos.</p>
      
      <form>
        <fieldset>
          <label class="control-label" for="textinput">Curso</label>
           <select id="s_cursos" name="s_cursos" class="input-large">
               <option value="0">Seleccione</option>
               <?php 
                foreach($cursos as $row)
                { 
                  echo '<option value="'.$row->id_curso.'">'.$row->nombre_curso.'</option>';
                }
                ?>
             
            
            </select>
          <label for="name">Nombre</label>
          <input type="text" name="name" id="name"  class="text ui-widget-content ui-corner-all">
          <label for="des_curso">Fecha de vencimiento</label>
          <input type="text" name="des_curso" id="date"  class="text ui-widget-content ui-corner-all">
          <label for="password">Costo</label>
          <input type="text" name="costo" id="costo"  class="text ui-widget-content ui-corner-all">
          
          <!-- Allow form submission with keyboard without duplicating the dialog button -->
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
    </div>
     
  </body>