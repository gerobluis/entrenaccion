<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Caja</title>
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.css\"";?>> 
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/jquery-ui-1.10.4.custom.min.css\"";?> >
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/caja.css\"";?>>
  
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/main.css\"";?>>
  
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-ui-1.10.4.custom.js\"";?>></script>  

  
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/caja.js\"";?>></script>
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
                    <li class="visible-xs">
                        <a href="#" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
                            <span class="sr-only"></span>
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <li class="dropdown notification">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="label label-danger arrowed arrow-left-in pull-right">12</span>
                            <i class="fa fa-bell"></i>
                        </a>
                       
                    </li>
                    <li class="dropdown notification">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="label label-primary arrowed arrow-left-in pull-right">6</span>
                            <i class="fa fa-inbox"></i>
                        </a>
                       
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle avatar pull-right" data-toggle="dropdown">
                         
                            <span class="hidden-small">Bienvenido, <?php echo $user ?><b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="fa fa-gear"></i>Account Settings</a></li>
                            <li><a href="profile.html"><i class="fa fa-user"></i>View Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div class="body">
            <aside class="sidebar">
                    <ul class="nav nav-stacked">
                        <li><a id="btn_rea_pag" >Realizar pago de participante</a></li>                      
                      
                    </ul>
                </aside>
                <section class="content" style="min-height: 140px;">
                    
 <div class="container">
    
    <div class="row clearfix">
      <div class="span12">
          
       <div id="pago">
        <div class="span10">
          <form id="f_matricula_enrolador" class="form-horizontal"  method="post">
            <fieldset>

              <!-- Form Name -->
              <legend>Participante</legend>

              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" for="textinput">Matricula</label>
                <div class="controls">
                  <input id="matricula_enrolador" name="matricula_enrolador" type="text" placeholder="matricula" class="input-xlarge">
                  <button id="buscar" type="button" class="btn btn-success">Buscar</button>
                </div>
              </div>
            
            </fieldset>
          </form>
        <div id="info_matricula_enrolador" class="span9">
           <div class="control-group">
          <label class="span3" >Matricula:</label>    
          <label id="matricula_info" class="span3" ></label>  

        </div>
          <div class="control-group">
            <label class="span3" >Nombre Completo:</label>    
            <label id="nombre_enrolador" class="span5" ></label>  

          </div>
           <div class="control-group">
            <label class="span3" for="textinput">Usuario:</label>    
            <label id="usuario_enrolador" class="span3" ></label>        

          </div>
           <div class="control-group">
            <label class="span3" >Curso:</label>    
            <label id="curso_enrolador" class="span3" ></label>  
             <label id="id_curso_enrolador" class="span3" ></label>  
           </div>
           <div class="control-group">
            <label class="span3" >Adeudo:</label>    
            <label id="adeudo_participante" class="span3" ></label>  

           </div>

          <div class="control-group">
            <label class="span3" for="email">Email:</label>
            <label id="email_enrolador" class="span3" ></label>  
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="span3" for="tel_fijo">Telefono fijo:</label>
            <label id="telfijo_enrolador" class="span3" ></label>  
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="span3" for="tel_contacto">Telefono Contacto:</label>
            <label id="telcontacto_enrolador"  class="span3" ></label>  
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="span3" for="domicilio">Domicilio:</label>
            <label  id="domicilio_enrolador" class="span3" ></label>  
          </div>
        </div>

      </div>


      <div class="row show-grid">
        <div id="opciones" class="span12" data-original-title="" title="">
             <legend>Concepto de Pago</legend>
          <div class="span2">
            <label class="control-label" for="Enrolado">Anticipo</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"  value="1"  id="firma_on" name="concepto_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Abono</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="2"        id="medica_on" name="concepto_pago"><span>Si</span></label>
                

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Pago Completo</label>
           
              <div id="donate">
                <label  class="green"><input type="radio"   value="3"     name="concepto_pago"><span>Si</span></label>
               

              </div>
           
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Liquidación</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="4"   name="concepto_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Otro</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="5"   name="concepto_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
         
        </div>        
      </div> 

    
      <div class="row show-grid">
        <div id="opciones" class="span12" data-original-title="" title="">
             <legend>Tipo de Pago</legend>
          <div class="span2">
            <label class="control-label" for="Enrolado">Efectivo</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"  value="1"  id="firma_on" name="tipo_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Cheque</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="2"        id="medica_on" name="tipo_pago"><span>Si</span></label>
                

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Dep.Bancario</label>
           
              <div id="donate">
                <label  class="green"><input type="radio"   value="3"     name="tipo_pago"><span>Si</span></label>
               

              </div>
           
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">T. de Crédito</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="4"   name="tipo_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">T. de Débito</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="5"   name="tipo_pago"><span>Si</span></label>
               

              </div>
            </div>
          </div>
          <div class="span2">
            <label class="control-label" for="Enrolado">Transferencia</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"   value="6"  name="tipo_pago"><span>Si</span></label>
              

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row show-grid">
          <div class="span10">
            <legend>La cantidad de</legend>
                    
                    <div class="controls">
                   
                      <input id="cantidad_pago" name="matricula_enrolador" type="text" placeholder="$ MXN" class="input-xlarge">
                     
                    </div>
                  
          </div>    
      </div>
      <div class="row show-grid">
        <div class="span12" data-original-title="" title="">
          <p id="botones" >
            <button id="cancelar" class="btn btn-danger" type="button">Cancelar</button>
            <button id="guardar"  class="btn btn-success" type="button">Guardar</button>
          </p>
        </div>
      </div>
    </div>
    <div id="historial">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tableRegistro" >
        <thead>
          <tr>
            <th class="span2">Matricula</th>            
            <th>Datos</th>
             <th>Entrenamiento</th>                
            <th class="span1">Cantidad pago</th>
            <!--th class="span1">Status de Solicitud</th>
            <th class="span1">Status Preparación</th-->
            <th class="span2">Fecha</th>
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
  </body>