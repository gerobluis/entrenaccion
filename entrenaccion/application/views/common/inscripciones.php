<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Enrolamiento e inscripciones</title>
  <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/inscripciones.css\"";?>>
  <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/main.css\"";?>>
  <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>  
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <script type="text/javascript"src=<?php echo "\"".base_url() ."js/inscripciones.js\"";?>></script>


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
            <ul>
            <li><a href="/sistema/promociones"><i class="fa fa-gear"></i>Account Settings</a></li>          
            <li class="divider"></li>
            <li><a href="/sistema/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
            </ul>
        </li>
    </ul>

  </div>
  <div class="container">

    <div>

      <div class="row clearfix">
        <div class="span12">
          <form  class="form-horizontal">
           <legend>Inscripción</legend>

           <div class="control-group">
            <label class="control-label" for="textinput">Inscribir al curso de:</label>

            <div class="controls">
             <select  id="s_cursos" name="s_cursos" class="input-xlarge">
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
        <div class="control-group">
          <label class="control-label" for="Generación">Generación</label>
          <div class="controls">
            <select id="generacion" name="Generación" class="input-xlarge">            
              <option>32</option>
              <option>33</option>
              <option>34</option>
              <option>35</option>
              <option>36</option>
              <option>37</option>
              <option>38</option>
              <option>39</option>
              <option>40</option>
              <option>41</option>
              <option>42</option>
              <option>43</option>
              <option>44</option>
              <option>45</option>
              <option>46</option>
              <option>47</option>
              <option>48</option>
              <option>49</option>
              <option>50</option>
              <option>51</option>
              <option>52</option>
              <option>53</option>
              <option>54</option>
              <option>55</option>
              <option>56</option>
              <option>57</option>
              <option>58</option>
            </select>
          </div>
        </div> 
      </form>

      <form id="ac" class="form-horizontal" action="/sistema/findByMatr" method="post">
        <fieldset>

          <!-- Form Name -->

          
          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="textinput">Matricula</label>
            <div class="controls">
              <input id="matricula" name="matricula" type="text" placeholder="matricula" class="input-large">
              <button id="buscar_insc" type="button" class="btn btn-success">Buscar</button>
            </div>
          </div>
        </fieldset>
      </form>

      <div id="af" class="span7"> 
        <div class="control-group">
          <label class="span3" >Matricula</label>    
          <label id="matricula_info" class="span3" ></label>  

        </div>
        <div class="control-group">
          <label class="span3" >Nombre Completo:</label>    
          <label id="nombre_info" class="span3" ></label>  

        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span3" for="textinput">Usuario:</label>    
          <label id="usuario_info" class="span3" ></label>        

        </div>
        <div class="control-group">
          <label class="span3" >Curso pasado:</label>    
          <label id="curso_info" class="span3" ></label>  

        </div>


        <div class="control-group">
          <label class="span3" for="email">Email</label>
          <label id="email_info" class="span3" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span3" for="tel_fijo">Telefono fijo</label>
          <label id="telfijo_info" class="span3" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span3" for="tel_contacto">Telefono Contacto</label>
          <label id="telcontacto_info"  class="span3" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span3" for="domicilio">Domicilio</label>
          <label  id="domicilio_info" class="span3" ></label>  
        </div>
      </div>
      <form id="a" class="form-horizontal">
        <fieldset>


          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="textinput">Nombre Completo</label>
            <div class="controls">
              <input id="name" name="name" type="text" placeholder="Nombre" class="input-xlarge" required="">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="textinput">Usuario</label>
            <div class="controls">
              <input id="user" name="user" type="text" placeholder="usuario" class="input-xlarge">

            </div>
          </div>

          <!-- Select Basic -->
          <div class="control-group">
            <label class="control-label" for="Edad">Edad</label>
            <div class="controls">
               <input id="edad" name="Edad" type="text" placeholder="edad" class="input-xlarge">
            
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
              <input id="email" name="email" type="text" placeholder="email@service.com" class="input-xlarge">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="tel_contacto">Telefono movil</label>
            <div class="controls">
              <input id="tel_contacto" name="tel_contacto" type="text" placeholder="81235649" class="input-xlarge" required="">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="tel_fijo">Telefono Contacto</label>
            <div class="controls">
              <input id="tel_fijo" name="tel_fijo" type="text" placeholder="81235649" class="input-xlarge">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="domicilio">Domicilio</label>
            <div class="controls">
              <input id="domicilio" name="domicilio" type="text" placeholder="calle #123" class="input-xlarge" required="">

            </div>
          </div>
          <!--div class="control-group">
            <label class="control-label" for="Estado">Estado</label>
            <div class="controls">
              <select id="estado" name="estado" class="input-large">
                <option value="Aguascalientes">Aguascalientes</option>
                <option value="Baja California">Baja California</option>
                <option value="Baja California Sur">Baja California Sur</option>
                <option value="Campeche">Campeche</option>
                <option value="Chiapas">Chiapas</option>
                <option value="Chihuahua">Chihuahua</option>
                <option value="Coahuila">Coahuila</option>
                <option value="Colima">Colima</option>
                <option value="Distrito Federal">Distrito Federal</option>
                <option value="Durango">Durango</option>
                <option value="Estado de México">Estado de México</option>
                <option value="Guanajuato">Guanajuato</option>
                <option value="Guerrero">Guerrero</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Jalisco">Jalisco</option>
                <option value="Michoacán">Michoacán</option>
                <option value="Morelos">Morelos</option>
                <option value="Nayarit">Nayarit</option>
                <option value="Nuevo León">Nuevo León</option>
                <option value="Oaxaca">Oaxaca</option>
                <option value="Puebla">Puebla</option>
                <option value="Querétaro">Querétaro</option>
                <option value="Quintana Roo">Quintana Roo</option>
                <option value="San Luis Potosí">San Luis Potosí</option>
                <option value="Sinaloa">Sinaloa</option>
                <option value="Sonora">Sonora</option>
                <option value="Tabasco">Tabasco</option>
                <option value="Tamaulipas">Tamaulipas</option>
                <option value="Tlaxcala">Tlaxcala</option>
                <option value="Veracruz">Veracruz</option>
                <option value="Yucatán">Yucatán</option>
                <option value="Zacatecas">Zacatecas</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="municipio">Municipio</label>
            <div class="controls">
              <select id="municipio" name="municipio" class="input-large">

              </select>
            </div>
          </div-->
          <div class="control-group">
            <label class="control-label" for="Enrolado">Enrolado</label>
            <div class="controls">
              <div id="donate">
                <label  class="green"><input type="radio"         id="element_on" name="enrolado"><span>Si</span></label>
                <label class="red"><input type="radio"     id="element_off" name="enrolado"><span>No</span></label>

              </div>
            </div>
          </div>
        </fieldset>
      </form>
      <div class="span12">
        <form id="ad" class="form-horizontal"  method="post">
          <fieldset>

            <!-- Form Name -->
            <legend>Enrolador</legend>

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
        <div id="ae">
         <div class="control-group">
          <label class="span2" >Matricula:</label>    
          <label id="mat_enrolador" class="control-label" ></label>  

        </div>
        <div class="control-group">
          <label class="span2" >Nombre Completo:</label>    
          <label id="nombre_enrolador" class="control-label" ></label>  

        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span2" for="textinput">Usuario:</label>    
          <label id="usuario_enrolador" class="control-label" ></label>        

        </div>



        <div class="control-group">
          <label class="span2" for="email">Email</label>
          <label id="email_enrolador" class="control-label" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span2" for="tel_fijo">Telefono fijo</label>
          <label id="telfijo_enrolador" class="control-label" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span2" for="tel_contacto">Telefono Contacto</label>
          <label id="telcontacto_enrolador"  class="control-label" ></label>  
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="span2" for="domicilio">Domicilio</label>
          <label  id="domicilio_enrolador" class="control-label" ></label>  
        </div>
        <div class="control-group">
          <label class="control-label" for="textinput">Origen enrolamiento</label>

          <div class="controls">
           <select id="fin_enrolamiento" name="fin_enrolamiento" class="input-xlarge">
            <option  value="1">1er Fin</option>
            <option  value="2">2do Fin</option>
            <option  value="3">3er Fin</option>   
            <option  value="4">4to Fin</option>
          </select>

        </div>
      </div>
    </div>

  </div>
  <div class="span12" >
    <form id="ab"class="form-horizontal">
      <fieldset>

        <div class="span5">
          <legend>Contacto 1</legend>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="c1_nombre">Nombre y Apellido</label>
            <div class="controls">
              <input id="c1_nombre" name="c1_nombre" type="text" placeholder="nombre apellido" class="input-large" required="">

            </div>
          </div>
      

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="tel_contacto">Telefono Contacto</label>
            <div class="controls">
              <input id="c1_tel_contacto" name="c1_tel_contacto" type="text" placeholder="81235649" class="input-large" required="">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="domicilio">Domicilio</label>
            <div class="controls">
              <input id="c1_domicilio" name="c1_domicilio" type="text" placeholder="calle #123" class="input-large" required="">

            </div>
          </div>

          <!-- Text input-->
          <div class="control-group">
            <label class="control-label" for="c1_relacion">Relación</label>
            <div class="controls">
              <input id="c1_relacion" name="c1_relacion" type="text" placeholder="Relacion" class="input-large" required="">
 

          </div>
        </div>
      </div>
      <div class="span5">
        <legend>Contacto 2</legend>

        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="c1_nombre">Nombre y Apellido</label>
          <div class="controls">
            <input id="c2_nombre" name="c2_nombre" type="text" placeholder="nombre apellido" class="input-large" required="">

          </div>
        </div>
       
        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="tel_contacto">Telefono Contacto</label>
          <div class="controls">
            <input id="c2_tel_contacto" name="c2_tel_contacto" type="text" placeholder="81235649" class="input-large" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="domicilio">Domicilio</label>
          <div class="controls">
            <input id="c2_domicilio" name="c2_domicilio" type="text" placeholder="calle #123" class="input-large" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="c2_relacion">Relación</label>
          <div class="controls">
             <input id="c2_relacion" name="c2_relacion" type="text" placeholder="Relacion" class="input-large" required="">

          </div>
        </div>
        <div>
        </fieldset>
      </form>
    </div>
    
    <div class="row show-grid">
      <div class="span12" data-original-title="" title="">
        <form id="ah" >
          <fieldset>

            <!-- Form Name -->
            <legend>Metas</legend>
            <!-- Textarea -->
            <div class="control-group">             
              <div class="controls">                     
                <textarea  rows="15" class="span4" id="meta1" name="meta1"></textarea>
                <textarea rows="15" class="span4" id="meta2" name="meta2"></textarea>
                <textarea rows="15" class="span4" id="meta3" name="meta3"></textarea>
              </div>
            </div>







          </fieldset>
        </form>
      </div>
    </div>
    <div class="row show-grid">
      <div id="ai" class="span6" data-original-title="" title="">
        <legend>Prerequisitos</legend>
        <div class="span1">
          <label class="control-label" for="Enrolado">Firma</label>
          <div class="controls">
            <div id="donate">
              <label  class="green"><input type="radio"  value="1"  id="firma_on" name="firma"><span>Si</span></label>
              <label class="red"><input type="radio"     value="0"   id="firma_off" name="firma"><span>No</span></label>

            </div>
          </div>
        </div>
        <div class="span1">
          <label class="control-label" for="Enrolado">Medica</label>
          <div class="controls">
            <div id="donate">
              <label  class="green"><input type="radio"   value="1"        id="medica_on" name="medica"><span>Si</span></label>
              <label class="red"><input type="radio"     value="0"       id="medica_off" name="medica"><span>No</span></label>

            </div>
          </div>
        </div>
        <div class="span1">
          <label class="control-label" for="Enrolado">Contactos</label>
          <div class="controls">
            <div id="donate">
              <label  class="green"><input type="radio"   value="1"     name="contactos"><span>Si</span></label>
              <label class="red"><input type="radio"      value="0"  name="contactos"><span>No</span></label>

            </div>
          </div>
        </div>
        <div class="span1">
          <label class="control-label" for="Enrolado">Tarea</label>
          <div class="controls">
            <div id="donate">
              <label  class="green"><input type="radio"   value="1"   name="tarea"><span>Si</span></label>
              <label class="red"><input type="radio"     value="0"   name="tarea"><span>No</span></label>

            </div>
          </div>
        </div>
        <div class="span1">
          <label class="control-label" for="Enrolado">Beca</label>
          <div class="controls">
            <div id="donate">
              <label  class="green"><input type="radio"   value="1"   name="beca"><span>Si</span></label>
              <label class="red"><input type="radio"     value="0"   name="beca"><span>No</span></label>

            </div>
          </div>
        </div>
      </div>
      <div id="aj" class="span5" data-original-title="" title="">
        <form class="form-horizontal">
         <legend>Promociones</legend>
         <div class="control-group">

          <label class="control-label" for="textinput">Promoción</label>
          <div class="controls">
           <select id="s_promociones" name="s_promociones" class="input-large">
             <option value="0">Ninguna</option>
             <?php 

             foreach($promociones as $row)
             { 
              echo '<option value="'.$row->id_promocion.'">'.$row->descripcion.'</option>';
            }
            ?>

            
          </select></form>

        </div>
      </div>
    </div>
  </div>
  <div class="row show-grid">
    <div class="span12" >
      <p id="ag" >
        <button id="cancelar" class="btn btn-danger" type="button">Cancelar</button>
        <button id="guardar"  class="btn btn-success" type="button"></button>
      </p>
    </div>
  </div>

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
</body>