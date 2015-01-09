<!DOCTYPE html>
<html lang="en">
<head>
 <head>

  <style type="text/css">
  .body {
    position: relative;
    overflow: hidden;
  }

  .container {
    width: 100%;
    background-color: #FFF;
  }

  .container {
    margin-right: auto;
    margin-left: auto;
  }
  .span12 {
    width: 940px;
  }
  .span2 {
    width: 140px;
  }
  .row {
    margin-left: -20px;
  }
  [class*="span"] {
    float: left;
    min-height: 1px;
    margin-left: 20px;
  }

  legend {
    display: block;
    width: 100%;
    padding: 0;
    margin-bottom: 20px;
    font-size: 21px;
    line-height: 40px;
    color: #333;
    border: 0;
    border-bottom: 1px solid #e5e5e5;
  }

  #donate {
    margin-left:45px;
    
    float:left;
  }

  #close {
    margin:4px;
    
    float:right;
  }

  #donate label {
    float:left;
    width:50px;
    line-height: normal;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    
  }
  #close label {
    float:left;
    width:60px;
    line-height: normal;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    
  }


  #donate label span {
    text-align:center;
    font-size: 16px;
    
    display:block;
  }

  #close label span {
    text-align:center;
    font-size: 22px;
    
    display:block;
  }


  #donate label input {
    display: none;
    position:absolute;
    top:-20px;
  }

  #close label input {
    position:absolute;
    top:-20px;
  }

  #donate .red input:checked + span {
   background-color:#F50909;
   color:#F7EFEF;
 }
 #donate .green input:checked + span {
  background-color:#A3D900;
  color:#F7EFEF;
}
#close input:checked + span {
  background-color:#404040;
  color:#F7F7F7;
}

#donate .red {
  background-color:#FFF;
  color:#000;
  
}



#donate .green {
  background-color:#FFF;
  color:#000;
  
}
img{
  width: 160px;

}
#botones{
  margin-top: 50px;
  margin-left: 45%;
}
#opciones label{
  text-align: center;
}
input {
  text-transform: uppercase;
  }</style>
  

</head>
<body>
  <div class="container">
    <a ><img src=<?php echo "\"".base_url() ."img/logo-entrenaccion.jpg\"";?>></a>

    <!--div class="row clearfix">
      <div class="span12">
          
       <div class="row show-grid">
        <div id="opciones"
        data-original-title="" title="">
             <legend>Recibí de: <?php echo $nombre; ?></legend>          
        </div>        
      </div>
       <div class="row show-grid">
        <div id="opciones"
         data-original-title="" title="">
             <legend>Pago para el curso: <?php echo $nombre_curso; ?></legend>          
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
          <div class="span10" >
            <legend>La cantidad de: <?php echo $cantidad_pago; ?></legend>
                    
                   
                  
          </div>    
      </div>
      <div class="row show-grid">
        <div id="opciones"
          data-original-title="" title="">
             <legend>Recibí de: <?php echo $nombre; ?></legend>          
        </div>        
      </div> 
       <div class="row show-grid">
        <div id="opciones"
         data-original-title="" title="">
             <legend>Pago para el curso: <?php echo $nombre_curso; ?></legend>          
        </div>        
      </div> 

      <div class="row show-grid">
        <div id="opciones"
          data-original-title="" title="">
             <legend>Concepto de Pago: <?php echo $concepto_pago; ?></legend>          
        </div>        
      </div> 

    
      <div class="row show-grid">
        <div id="opciones"  class="span12" data-original-title="" title="">
             <legend>Tipo de Pago: <?php echo $tipo_pago; ?></legend>
        
        </div>
      </div>
      <div class="row show-grid">
          <div class="span10" >
            <legend>La cantidad de: <?php echo $cantidad_pago; ?></legend>
                    
                   
                  
          </div>    
      </div-->
     
    </div>

   

  </body>