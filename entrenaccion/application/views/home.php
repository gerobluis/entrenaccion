<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Menu Principal</title>
	<link href="css/bootstrap-responsive.css" rel="stylesheet"> 
 	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 	<link rel="stylesheet" type="text/css" href="css/home.css">
 	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
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

	#body{
		margin: 0 15px 0 15px;
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
			$('#enrolar').live('click',function(){


	alert("I am an alert box!");
	
});

			$("#entrar").live('click',(function(){
				$.post("/sistema/login", { usuario: $("#usuario").val(),password: $("#password").val()},
			   function(data) {
			     if(data.valor == false){
			     	$("#error-mensaje").text("Correo o Contraseña Incorrecta");
			     }
			     if(data.valor == true){
			     	window.location.href = "/sistema/inicio";
			     }
			   });
			});
	});
	</script>
</head>
<body>

<div id="container">
	<img src="img/logo-entrenaccion.jpg">
	
	<div id="body">
		<ul id="menu" class="list-inline">
  <li><img id="enrolar" src="img/enrolar.png" class="img-rounded">Enrolamiento e Inscripciones</li>
  <li><img src="img/cash.png" class="img-rounded">Caja</li>
  <li><img src="img/reportes.png" class="img-rounded">Busquedas e Informes</li>
</ul>
	</div>

	<p class="footer"></p>
</div>

</body>
</html>