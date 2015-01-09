<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('application/libraries/phpass-0.1/PasswordHash.php');
require_once('application/libraries/tcpdf/examples/tcpdf_include.php');

date_default_timezone_set('America/Mexico_City');
class Sistema extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();

		$this->ci->load->config('tank_auth', TRUE);
		$this->load->helper('date');	
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->ci->load->library('session');
		$this->ci->load->database();		
		$this->ci->load->model('backend/administrador');
		$this->load->library('form_validation');
		$this->load->library('Pdf');
	}

	function login(){
		$hasher = new PasswordHash(
						$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
						$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
		$valor=false;
		if (!is_null($user = $this->ci->administrador->get_user_login($this->input->post('usuario'),$this->input->post('password')))) {	// login ok
			$this->ci->session->set_userdata(array(
								'user_id'	=> $user->id_admin,
								'adminname'	=> $user->Usuario,
								'permisos'	=> $user->permisos
						));
				$valor=true;
		}
		 $this->output
    				->set_content_type('application/json')
    				->set_output(
				    		json_encode(
				    			array('valor'=>$valor)
				    		)
    					);
	}

	/**
	 * Logout user from the site
	 *
	 * @return	void
	 */
	function logout()
	{
		$this->ci->session->set_userdata(array('user_id' => '', 'adminname' => ''));
		$this->ci->session->sess_destroy();
		redirect('');
	}

	function inicio()
	{
		$user=$this->ci->session->all_userdata();
		
			if(!empty($user['adminname'])){
			$data['user'] = $user['adminname'];
			if($user['permisos']=="01")
			$this->load->view('common/home01',$data);
			if($user['permisos']=="02")
			$this->load->view('common/home',$data);
			
		}else{
			redirect('/login');
		}	
				
	}
	function llamada()
	{
		$user=$this->ci->session->all_userdata();
			
			if(!empty($user)){
				if(array_key_exists ( 'adminname', $user))
				{
				$data['user'] = $user['adminname'];
			//$data['resultados']  = $this->ci->administrador->get_participantes_by_gen(0);
		
				$this->load->view('common/llamada',$data);
			
				}else{
					redirect('/login');
				}
		}else{
			redirect('/login');
		}

				
	}
	function registro()
	{
		$user=$this->ci->session->all_userdata();
			
			if(!empty($user)){
				if(array_key_exists ( 'adminname', $user))
				{
				$data['user'] = $user['adminname'];
			//$data['resultados']  = $this->ci->administrador->get_participantes_by_gen(0);
		
				$this->load->view('common/registro',$data);
			
				}else{
					redirect('');
				}
		}else{
			redirect('');
		}

				
	}

	function inscripciones()
	{
		$user=$this->ci->session->all_userdata();
			if(!empty($user)){
				if(array_key_exists('adminname',$user))
				{
					$data['user'] = $user['adminname'];
					$data['promociones'] = $this->ci->administrador->getAllPromociones();
					$data['cursos'] = $this->ci->administrador->getAllCursos();
					$this->load->view('common/inscripciones',$data);
			}else{
				redirect('');
			}

		}else{
			redirect('');
		}	
				
	}
	function promociones()
	{
		$user=$this->ci->session->all_userdata();
			if(!empty($user)){
				if(array_key_exists('adminname',$user))
				{
					$data['user'] = $user['adminname'];
					$this->load->view('common/promociones',$data);
				}else{
				redirect('');
			}
		}else{
			redirect('');
		}	
				
	}
	function caja()
	{
		$user=$this->ci->session->all_userdata();
		
			if(!empty($user)){
				if(array_key_exists('adminname',$user))
				{
					$data['user'] = $user['adminname'];
					if($user['permisos']=="01")
						$this->load->view('common/caja01',$data);
					if($user['permisos']=="02")
						$this->load->view('common/caja',$data);
			}else{
				redirect('/login');
			}
		}else{
			redirect('/login');
		}	
				
	}
	function reportes()
	{
			$user=$this->ci->session->all_userdata();
			
			if(!empty($user)){
				if(array_key_exists ( 'adminname', $user))
				{
					$data['user'] = $user['adminname'];				
					if($user['permisos']=="01")
						$this->load->view('common/reportes',$data);
					if($user['permisos']=="02")
						$this->load->view('common/reportes',$data);
				}else{
				redirect('');
			}
			
		}else{
			redirect('');
		}	
				
	}
	function graduaciones()
	{
		$user=$this->ci->session->all_userdata();
			if(!empty($user)){
				if(array_key_exists ( 'adminname', $user))
				{
					$data['user'] = $user['adminname'];
					$data['resultados'] = $this->ci->administrador->get_participantes_by_gen(0);
					$this->load->view('common/graduaciones',$data);
				}else{
					redirect('');
				}
		}else{
			redirect('');
		}	
				
	}
	function busquedas()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
			$data['user'] = $user;
			$data['cursos'] = $this->ci->administrador->getAllCursos();
			$this->load->view('common/busquedas',$data);
			
		}else{
			redirect('/login');
		}	
				
	}

	function enrolar()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		
				$data['id_participante'] =$this->ci->administrador->get_id_participante();

				$data['nombre'] = $this->input->post('name');
				$data['usuario'] = $this->input->post('user');
				$data['password'] =$this->input->post('user');
				$data['generacion'] =$this->input->post('generacion');
				$data['id_curso'] =$this->input->post('id_curso');
				$data['becado'] =$this->input->post('beca');
				$data['codigo_promo']=$this->input->post('codigo_promo');
				$data['id_enrolador']=$this->input->post('matricula_enrolador');
				$data['origen_enrolamiento']=$this->input->post('fin_enrolamiento');

				$info['id_participante']=$data['id_participante'];
				$info['telefono']=$this->input->post('tel_fijo');
				$info['celular']=$this->input->post('tel_contacto');
				$info['edad']=$this->input->post('edad');
				$info['email']=$this->input->post('email');
				$info['domicilio']=$this->input->post('domicilio');

				

				$metas['id_participante']=$data['id_participante'];
				$metas['id_curso'] =$this->input->post('id_curso');
				$metas['meta1']=$this->input->post('meta1');
				$metas['meta2']=$this->input->post('meta2');
				$metas['meta3']=$this->input->post('meta3');

				$preparacion['id_participante']=$data['id_participante'];
				$preparacion['id_curso'] =$this->input->post('id_curso');
				$preparacion['inscripcion']=$this->input->post('generacion');
				$preparacion['datos']=true;
				$preparacion['metas']=true;
				$preparacion['firma']=$this->input->post('firma');
				$preparacion['medica']=$this->input->post('medica');
				$preparacion['contactos']=$this->input->post('contactos');
				$preparacion['tarea']=$this->input->post('tarea');
				
				$contactos['id_participante']=$data['id_participante'];
				$contactos['c1_nombre']=$this->input->post('c1_nombre');
				$contactos['c1_celular']=$this->input->post('c1_tel_contacto');
				$contactos['c1_telefono']=$this->input->post('c1_tel_fijo');
				$contactos['c1_domicilio']=$this->input->post('c1_domicilio');
				$contactos['c1_relacion']=$this->input->post('c1_relacion');
				$contactos['c2_nombre']=$this->input->post('c2_nombre');
				$contactos['c2_celular']=$this->input->post('c2_tel_contacto');
				$contactos['c2_telefono']=$this->input->post('c2_tel_fijo');
				$contactos['c2_domicilio']=$this->input->post('c2_domicilio');
				$contactos['c2_relacion']=$this->input->post('c2_relacion');
				$admin['id_curso'] =$this->input->post('id_curso');
				$admin['id_participante']=$data['id_participante'];
				if($this->input->post('codigo_promo')==0)
				{
				$result=$this->ci->administrador->get_costo_curso($this->input->post('id_curso'));
				$admin['costo']=$result->costo;
				}
				else
				{
				$result=$this->ci->administrador->getCostoPromo($this->input->post('codigo_promo'));
				$admin['costo']=$result->precio;
				}	
				if($this->ci->administrador->create_participante($data)){
					if ($this->ci->administrador->create_participante_info($info)) {
						if($this->ci->administrador->create_metas($metas)){
							if ($this->ci->administrador->create_participante_preparacion($preparacion)){
								if ($this->ci->administrador->create_participante_contactos($contactos)){
										$this->ci->administrador->create_participante_admin($admin);

										$respuesta['matricula']=$data['id_participante'] ;
										return $this->output->set_content_type('application/json')
										->set_output(json_encode($respuesta));
										
									}	
								}

							}
						
					}
						else
					{	
						$error['mensaje']=2;
						return $this->output->set_content_type('application/json')
											->set_output(json_encode($error));
					}

					
				}
				else
				{	
					$error['mensaje']=1;
					return $this->output->set_content_type('application/json')
										->set_output(json_encode($error));
				}
				
			}else{
			redirect('/inicio');
		}	

	}


	function inscribir()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){

				if($this->ci->administrador->getAdeudoParticipante($this->input->post('id_participante'))>0){

					$response['resultado']=ERROR_ADEUDO;
					
					$response['mensaje']="El participante con la matricula: ".$this->input->post('id_participante').
										  " tiene un adeudo en el presente curso. Favor de liquidar";
					/*$response['id_participante']==$this->input->post('id_participante');	
					$response['generacion']=$result->generacion;
					$response['id_curso']=$result->id_curso;*/
				
						return $this->output->set_content_type('application/json')
										->set_output(json_encode($response));
				}
				$curso=$this->input->post('id_curso');
				$data['id_participante'] =$this->input->post('id_participante');			
				$data['generacion'] =$this->input->post('generacion');
				$data['id_curso'] =$this->input->post('id_curso');
				$data['becado'] =$this->input->post('beca');
				$data['codigo_promo']=$this->input->post('codigo_promo');
				

				$metas['id_participante']=$data['id_participante'];
				$metas['id_curso'] =$this->input->post('id_curso');
				$metas['meta1']=$this->input->post('meta1');
				$metas['meta2']=$this->input->post('meta2');
				$metas['meta3']=$this->input->post('meta3');

				$preparacion['id_participante']=$data['id_participante'];
				$preparacion['id_curso'] =$this->input->post('id_curso');				
				$preparacion['inscripcion']=$this->input->post('generacion');
				$preparacion['datos']=true;
				$preparacion['firma']=$this->input->post('firma');				
				$preparacion['tarea']=$this->input->post('tarea');
				
				$admin['id_curso'] =$this->input->post('id_curso');
				$admin['id_participante']=$data['id_participante'];
				if($this->input->post('codigo_promo')==0)
				{
				$result=$this->ci->administrador->get_costo_curso($this->input->post('id_curso'));
				$admin['costo']=$result->costo;
				}
				else
				{
				$result=$this->ci->administrador->getCostoPromo($this->input->post('codigo_promo'));
				$admin['costo']=$result->precio;
				}	

				if($this->ci->administrador->validate_previous_course($data)){
					if($this->ci->administrador->inscribir_participante($curso,$data,$metas,$preparacion,$admin)){
					$response['resultado']=SUCCESS;
					$response['mensaje']="El participante con la matricula: ".$this->input->post('id_participante').
										  "ha sido inscrito con éxito";
										$respuesta['matricula']=$data['id_participante'] ;
										return $this->output->set_content_type('application/json')
										->set_output(json_encode($response));
										
							
						
				

					
				}
				else
				{	$result=$this->ci->administrador->getParticipante($data['id_participante']);
					$response['resultado']=ERROR_NOT_GRADUATED;
					$response['mensaje']="El participante con la matricula: ".$this->input->post('id_participante').
										  " no ha terminado su participación en el entrenamiento anterior.
										   Deseas graduarlo?";
					$response['id_participante']=$data['id_participante'];	
				
					return $this->output->set_content_type('application/json')
										->set_output(json_encode($response));
				}
			}else
				{	
					$response['resultado']=ERROR_NOT_GRADUATED;
					$response['participante']=$this->ci->administrador->getParticipante($data['id_participante']);
					$response['mensaje']="El participante con la matricula: ".$this->input->post('id_participante').
										  " no ha terminado su participación en el entrenamiento anterior.
										   Deseas graduarlo?";
					
					return $this->output->set_content_type('application/json')
										->set_output(json_encode($response));
				}
				
				
			}else{
			redirect('/inicio');
		}	

	}
	function get_participantes_gen()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		$data['resultados'] = $this->ci->administrador->get_participantes_by_gen($this->input->post('gen'));
		
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}
	function get_participantes_by_genandcurso()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		$data['resultados'] = $this->ci->administrador->get_participantes_by_genandcurso($this->input->post('gen'),$this->input->post('curso'));
		
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}
	function get_participantes_by_genandcurso_para_graduar()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		$data['resultados'] = $this->ci->administrador->get_participantes_by_genandcurso_para_graduar($this->input->post('gen'),$this->input->post('curso'));
		
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}
function findByMatr()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		
			
				$respuesta['enrolador']=$this->ci->administrador->get_enrolador($this->input->post('matricula_enrolador')) ;
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
										
				

					
				
				
			}else{
			redirect('/inicio');
		}	

	}
	function findParticipante()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
		
			
				$respuesta['participante']=$this->ci->administrador->getParticipante($this->input->post('matricula_enrolador')) ;
				
				if(!empty($respuesta['participante'])){
					$matricula=$respuesta['participante']['0']->id_participante;
					$respuesta['adeudo']=$this->ci->administrador->getAdeudoParticipante($matricula) ;
				}
				
				if(!empty($respuesta['participante']))
				{
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
				}else{
					$respuesta['mensaje']=1;
					return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
				}

				

					
				
				
			}else{
			redirect('/login');
		}	

	}

	function registrar()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
				
			$respuesta['response']=$this->ci->administrador->update_registro_participante(
				$this->input->post('id_participante'),$this->input->post('gen'),$this->input->post('curso')); 
				
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
				
			
		}else{
			redirect('/login');
		}	
				
	}
	function graduar()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
				
			$response=$this->ci->administrador->update_curso_participante(
				$this->input->post('id_participante'),$this->input->post('gen'),$this->input->post('curso')); 
			if($response==1)
			$respuesta['mensaje']="Participante graduado exitosamente, puedes proceder a inscribirlo.";
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
				
			
		}else{
			redirect('/login');
		}	
				
	}
	
    function cerrarRegistro()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
			
			$result=$this->ci->administrador->cerrarRegistro($this->input->post('id_participante'),
				$this->input->post('gen'),$this->input->post('curso'));
			if($result>0){
				$this->ci->administrador->generarBK($this->input->post('curso'));
				$response['mensaje']  ="Registro cerrado exitosamente";	
			}else{
				$response['mensaje']  ="Sin alumnos por registrar";	
				}
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($response));
				
			
		}else{
			redirect('/login');
		}	
				
	}
	function cerrarGraduacion()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
			
			$result=$this->ci->administrador->generarDrops($this->input->post('curso'),$this->input->post('gen'));
			if($result){				
				$response['mensaje']  ="Registro cerrado exitosamente";	
			}
				$response['mensaje']  ="Ocurrio un error porfavor contacte al administrador del sistema";	
				
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($response));
				
			
		}else{
			redirect('/login');
		}	
				
	}

	function realizarPago()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
				$bValid=true;
				$bBecado=$this->administrador->esBecado($this->input->post('id_participante'));

				$bValid=$bValid && !$bBecado;
				$bValid=$bValid && $this->input->post('cantidad_adeudo')!=0;
					if ($bValid)
					{
						$data['folio']=$this->ci->administrador->get_id_folio();
						$data['id_participante'] =$this->input->post('id_participante');			
						$data['concepto_pago'] =$this->input->post('concepto_pago');
						$data['tipo_pago'] =$this->input->post('tipo_pago');
						$data['cantidad_pagada'] =$this->input->post('cantidad_pago');
						$data['id_curso']=$this->input->post('id_curso');
						$adeudo=$this->ci->administrador->getAdeudoParticipante($data['id_participante']);
						if ($adeudo-$this->input->post('cantidad_pago')>=0){
						$data['cantidad_adeudo']=$adeudo-$this->input->post('cantidad_pago');
						$response['folio']=$data['folio'];
						$response['resultado']=$this->ci->administrador->create_pago($data);
							if ($data['cantidad_adeudo']==0){
								$this->ci->administrador->updatePagoCompleto($data['id_participante'],$data['id_curso']);	
							}
						}else{
								$response['resultado']=ERROR_NO_PAGO;
								$response['mensaje']="El pago debe ser menor a la cantidad de adeudo";
								return $this->output->set_content_type('application/json')
											->set_output(json_encode($response));		
						}
					
					}else{
							if($bBecado){
								
								$response['resultado']=ERROR_BECADO;
								$response['mensaje']="El participante es becado";
							}else{
								$response['resultado']=ERROR_NO_PAGO;
								$response['mensaje']="El participante no tiene pago pendiente";
							}
								
								
					}				
					

					
				
				
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($response));
				
			
		}else{
			redirect('/login');
		}	

	}	
function	realizarCorteCaja(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$fecha_ultimo_corte=$this->ci->administrador->getLastCorte();
			 	if(!empty($fecha_ultimo_corte)){
			 			$response['resultados']=$this->ci->administrador->getCajaAfterDate($fecha_ultimo_corte);
			 			echo($entradas=$this->ci->administrador->getCountEntradas($fecha_ultimo_corte));
				 		$salidas=0;//$this->ci->administrador->getCountSalidas($fecha_ultimo_corte);
				 		$this->ci->administrador->create_corte_caja($entradas,$salidas);	
			 	}else{
				 		$response['resultados']=$this->ci->administrador->getAllCaja();
				 		$entradas=$this->ci->administrador->getCountEntradas(0);			 		
				 		$salidas=0;//=$this->ci->administrador->getCountSalidas(0);
				 		$fecha_inicio=$response['resultados']['0']->fecha_pago;
				 		$this->ci->administrador->create_corte_caja($entradas,$salidas,$fecha_inicio);
			 	}
			return $this->output->set_content_type('application/json')
				->set_output(json_encode($response));
		}else{
			redirect('/inicio');
		}




	}
	function cierre(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$desde=date("Y-m-d") . " 00:00:01";
			$hasta =date("Y-m-d") . " 23:59:59";

			$cierre=$this->ci->administrador->get_cierres($desde,$hasta);
			$error['mensaje'] = "Ya se ha hecho el cierre del día";
			
			if($cierre==NULL){
				$productos = $this->ci->administrador->get_productos_dia();
				foreach ($productos as $producto) {
					$data['usuario_id'] =$user;
					$data['codigo']= $producto->codigo;
					$data['stock'] = $producto->existencia;
					$data['precio'] = $producto->precio_med;
					
					$ruta=0;
					$vendedor =0;
					if($producto->ruta!=null){
						$ruta=$producto->ruta;
						
					}
					if($producto->vendedor!=null){
						$vendedor =$producto->vendedor;
					}
					$stock=0;
					$rutas=$this->ci->administrador->get_producto_ruta($producto->codigo);
					foreach ($rutas as $ruta) {
						$stock += $ruta->existencia;
					}
					$data['ruta'] = $stock;
					$data['creacion'] = date("Y-m-d H:i:s");
					$this->ci->administrador->create_cierre($data);
					$error['mensaje'] = "Se guardo correctamente";
				}
			}
			
			
			return $this->output
			    	->set_content_type('application/json')
			    	->set_output(
			    		json_encode(
			    			$error
			    			));

		}
	}
	function creaPDF()
	{
		$user=$this->ci->session->userdata('user_id');
			if(!empty($user)){
					$concepto=	$this->input->post('concepto_pago');
					switch ($concepto){
						case 1:
						$pdfData['concepto_pago']="Anticipo";
						break;
						case 2:
						$pdfData['concepto_pago']="Abono";
						break;
						case 3:
						$pdfData['concepto_pago']="Pago completo";
						break;
						case 4:
						$pdfData['concepto_pago']="Liquidación";
						break;
						case 5:
						$pdfData['concepto_pago']="Otro";
						break;
					}
					$tipo=	$this->input->post('tipo_pago');
					switch ($tipo){
						case 1:
						$pdfData['tipo_pago']="Efectivo";
						break;
						case 2:
						$pdfData['tipo_pago']="Cheque";
						break;
						case 3:
						$pdfData['tipo_pago']="Deposito bancario";
						break;
						case 4:
						$pdfData['tipo_pago']="T. de crédito";
						break;
						case 5:
						$pdfData['tipo_pago']="T. de dédito";
						break;
						case 6:
						$pdfData['tipo_pago']="Transferencia";
						break;
					}
					$pdfData['id_folio']=$this->input->post('id_folio');
					$pdfData['id_participante']=$this->input->post('id_participante');
					$pdfData['nombre']=$this->input->post('nombre_participante');
					$pdfData['nombre_curso']=$this->input->post('nombre_curso');	
					
					$pdfData['cantidad_pago'] =$this->input->post('cantidad_pago');
				
					
					$data['resultado']=$this->createPDF($pdfData);	
					$data['resultado']=1;	
					 return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
					}else{
		
		}

	}


	function createPDF($data)
	{
				// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$name=$data['id_folio'];
		$pdfFilePath = "pagos/$name.pdf";

		 
		if (file_exists($pdfFilePath) == FALSE)
		{
		    /*ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
		    $html = $this->load->view('common/pdf_report', $data, true); // render the view into HTML
		     
		    $this->load->library('pdf');
		    $pdf = $this->pdf->load(); 
		    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
		    $pdf->WriteHTML($html); // write the HTML into the PDF
		    $pdf->Output($pdfFilePath, 'F'); // save to file because we can
		    $respuesta['resultado']=$pdfFilePath;
		    return $this->output
			    	->set_content_type('application/json')
			    	->set_output(
			    		json_encode(
			    			$respuesta
			    			)); */
 			$date=date('d/m/Y');
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);		
 			$pdf->setFontStretching(100);
 			$pdf->setFontSpacing(0);
    		$pdf->AddPage();
    		$html = $this->load->view('common/pdf_report', $data, true); // render the view into HTML
			$pdf->SetFont('helvetica', '', 9);
    		$tbl = <<<EOD
			<table cellpadding="1" >
			
			<tr>
			 <th colspan="2"> Matricula:<b>{$data['id_participante'] }</b></th> 
			 <th colspan="2"   align="center"> <b>RECIBO DE PAGO</b></th>       
			 <th colspan="3"   align="right" > Folio: <b>{$data['id_folio']}</b></th>
			</tr>
			<tr>
			<th colspan="7" align="right" >Fecha: {$date} </th>
			</tr>
			<tr>
			<th colspan="4">Recibi de:
			 {$data['nombre'] }</th>
			
			</tr>
			<tr>
			<th colspan="6">Pago para el entrenamiento:  {$data['nombre_curso']}</th>
			</tr>
			<tr>
			<th colspan="2">Concepto de pago:</th>
			<th> {$data['concepto_pago']}</th>
			<th colspan="1">Tipo de pago:</th>
			<th>{$data['tipo_pago']}</th>

			</tr>
			<tr>
			<th colspan="5">La cantidad de: $ {$data['cantidad_pago']} MXN</th>
			</tr>
			<tr>
			<th colspan="5">
			 <br>
			 <br>
			 Contacto: 1534 6931 al 45 
			 <br>Sierra Lampazos 1707, 
			 <br> Col.Contry, Monterrey, N.L. 
			 <br>Corporativo M.E.T.A. Liderazgo Vivencial SC RFC: CML 121033UW7 </th>
			<th colspan="7">________________________________</th>
			</tr>
			<tr>
			<th colspan="5" align="center"> www.entrenaccionmexico.com.mx </th>
			<th colspan="5" style="text-align:center;">Nombre y Firma</th>
			</tr>
			</table>
EOD;
			$pdf->writeHTML($html, true, false, true, false, '');			
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($html, true, false, true, false, '');			
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$pdf->writeHTML($html, true, false, true, false, '');			
			$pdf->writeHTML($tbl, true, false, false, false, '');		 		
			$pdf->Output($pdfFilePath, 'F');
		}
		 
		redirect($pdfFilePath);
		/* return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));*/
	}
	function creaUsuario(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
				$data['Usuario']=$this->input->post('username');
				$data['Contrasena']=$this->input->post('password');
				$respuesta['response']=$this->ci->administrador->insertUsuario($data); 
				$respuesta['resultados']=$this->ci->administrador->getAccesos();
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}
	function editarUsuario(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
				$id=$this->input->post('id_usuario');
				$data['Usuario']=$this->input->post('nombre');
				$data['Contrasena']=$this->input->post('password');
				$respuesta['response']=$this->ci->administrador->updateUsuario($id,$data); 
				$respuesta['resultados']=$this->ci->administrador->getAccesos();
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}

	}
	function creaCurso(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
				$data['descripcion']=$this->input->post('descripcion');
				$data['nombre_curso']=$this->input->post('nombre_curso');
				$data['costo']=$this->input->post('costo');
				$respuesta['response']=$this->ci->administrador->insertCurso($data); 
				$respuesta['resultados']=$this->ci->administrador->getAllCursos();
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}
	function getUsuario(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
				$data['id_usuario']=$this->input->post('id_usuario');				
				$response['usuario']=$this->ci->administrador->get_user($this->input->post('id_usuario')); 
				$respuesta['usuario']=$response['usuario']['0']->Usuario;
				$respuesta['password']=$response['usuario']['0']->Contrasena;
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}

	function getParamBusqueda()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$paramBusqueda=$this->input->post('b_param');
			if($paramBusqueda==1)
			{
			$data['resultados'] = $this->ci->administrador->getBusquedaByCurso($this->input->post('curso'));
			}
			if($paramBusqueda==2)
			{
			$data['resultados'] = $this->ci->administrador->getBusquedaByGen($this->input->post('gen'));
			}
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	


	}

	function getHistorialPagos()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
			$time = time();
			$date=date('Y-m-d');
			
			$data['resultados'] = $this->ci->administrador->getHistorialPagos($date);
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	


	}
	function getParticipantes(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultados'] = $this->ci->administrador->getParticipantes();
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}

	function getParticipanteDetalle(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultado'] = $this->ci->administrador->
										getParticipanteDetalle($this->input->post('id'));
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}
	function getParticipantesAdeudo(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultados'] = $this->ci->administrador->getParticipantesAdeudo();
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	
	}
	function getBackLocks()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultados'] = $this->ci->administrador->getBackLocks();
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	


	}
	function getDrops()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultados'] = $this->ci->administrador->getDrops();
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	


	}
	function getTendencia()
	{
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			
			
			$data['resultados'] = $this->ci->administrador->getTendencia();
			
			
			
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}else{
			redirect('/login');
		}	


	}
	function porcentajeContinuidad(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data['resultados']=$this->ci->administrador->porcentajeContinuidad();

			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}
	}

	function getAccesos(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data['resultados']=$this->ci->administrador->getAccesos();
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}
	}
		function getEntrenamientos(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data['resultados']=$this->ci->administrador->getAllCursos();
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}
	}
	function getPromociones(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data['resultados']=$this->ci->administrador->getAllPromociones();
			return $this->output->set_content_type('application/json')
										->set_output(json_encode($data));
		}
	}
	function deleteUsuario(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data=$this->ci->administrador->deleteUsuario($this->input->post('id_admin'));
			if($data==1){
			$respuesta['mensaje']="Usuario eliminado.";
			$respuesta['resultados']=$this->ci->administrador->getAccesos();
			}
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		
		}
	}
	function deleteCurso(){
		$user=$this->ci->session->userdata('user_id');
		if(!empty($user)){
			$data=$this->ci->administrador->deleteCurso($this->input->post('id_curso'));
			if($data==1){
			$respuesta['mensaje']="Entrenamiento eliminado.";
			$respuesta['resultados']=$this->ci->administrador->getAllCursos();
			}
				return $this->output->set_content_type('application/json')
				->set_output(json_encode($respuesta));
		}
	}

}
?>