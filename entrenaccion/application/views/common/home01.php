<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Menu Principal</title>
    <link rel="stylesheet" href=<?php echo "\"".base_url() ."css/bootstrap-responsive.css\"";?>> 
    <link rel="stylesheet" media="screen" href=<?php echo "\"".base_url() ."css/bootstrap.min.css\"";?> >
    <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/home.css\"";?>>
    <link rel="stylesheet" type="text/css" href=<?php echo "\"".base_url() ."css/main.css\"";?>>
    <script type="text/javascript" src=<?php echo "\"".base_url() ."js/jquery-1.11.0.min.js\"";?>></script>
    <script type="text/javascript"src=<?php echo "\"".base_url() ."js/jquery-migrate-1.2.1.min.js\"";?>></script>

    <style type="text/css">

    ::selection{ background-color: #E13300; color: white; }
    ::moz-selection{ background-color: #E13300; color: white; }
    ::webkit-selection{ background-color: #E13300; color: white; }

    

    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
        cursor: pointer;
    }

    h1 {
        color: #444;
        text-align: center;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }

    
    #form{
        width: 200px; height: 100px; margin: 30px auto 0 auto;
    }
    p.footer{
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }
    
    #container{
        margin: 10px;
        
    }
    button{
        margin-left: 65px;
    }
    img{
        width: 200px;
        margin: 10px auto 0 0;
    }
    </style>

    <script type="text/javascript">
    $(document).ready(function  () {
        
    });
    </script>
</head>
<body>

    
    <div id="body">
        <div class="navbar navbar-default navbar-static-top navbar-main" role="navigation">
                <div class="navbar-header"><img src=<?php echo "\"".base_url() ."img/logo-entrenaccion.jpg\"";?>>
                  
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs">
                        <a href="#" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle avatar pull-right" data-toggle="dropdown">
                         
                            <span class="hidden-small">Bienvenido,  <?php echo $user ?><b class="caret"></b></span>
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
        <div id="container" >
            
            
            <ul id="menu" class="list-inline">
                <li><a href="/sistema/inscripciones"><img id="enrolar" class="img-rounded" src=<?php echo "\"".base_url() ."img/enrolar.png\"";?>></a>Inscripciones</li>
                <li><a href="/sistema/llamada"><img id="registro" class="img-rounded" src=<?php echo "\"".base_url() ."img/llamada_preparacion.png\"";?>></a>Llamada de preparación</li>
                
                <li><a href="/sistema/registro"><img id="registro" class="img-rounded" src=<?php echo "\"".base_url() ."img/registro.png\"";?>></a>Registro de participantes</li>
                <li><a href="/sistema/graduaciones"><img id="graduacion" class="img-rounded" src=<?php echo "\"".base_url() ."img/registro.png\"";?>></a>Graduar participantes</li>              
                <li><a href="/sistema/busquedas"><img src=<?php echo "\"".base_url() ."img/busqueda.png\"";?> class="img-rounded"></a>Búsquedas</li>
                <li><a href="/sistema/reportes"><img src=<?php echo "\"".base_url() ."img/reportes.png\"";?> class="img-rounded"></a>Reportes</li>
               
                
               
            </ul>
        </div>

        <p class="footer"></p>
    </div>

</body>
</html>