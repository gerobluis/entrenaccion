<?php
date_default_timezone_set('America/Mexico_City');
class Administrador extends CI_Model
{

	private $table_name			= 'administrador';			// company

	function __construct()
	{ 
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}
	/********** CREATES **************/

	/**
	 * Create participante
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_participante($data)
	{
		
		if ($this->db->insert('participante', $data)) {
			return true;
		}
		return false;
	}
	/**
	 * Create participante
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_participante_info($data)
	{
		
		if ($this->db->insert('datos_perso', $data)) {
			return true;
		}
		return false;
	}
	
	function create_metas($data)
	{
		
		if ($this->db->insert('metas', $data)) {
			return true;
		}
		return false;
	}
	/**
	 * Create participante
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_participante_preparacion($data)
	{
		
		if ($this->db->insert('preparacion', $data)) {
			return true;
		}
		return false;
	}
	
	function create_participante_contactos($data)
	{
		
		if ($this->db->insert('participante_contactos', $data)) {
			return true;
		}
		return false;
	}

	/**
	 * Create inventario
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_participante_admin($data)
	{
		$this->db->set('fecha', 'NOW()', FALSE);
		if ($this->db->insert('datos_admin', $data)) {
			return true;
		}
		return false;
	}
	
	/**
	 * Create pago
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_pago($data)
	{
		$this->db->set('fecha_pago', 'NOW()', FALSE);
		if ($this->db->insert('registro_admin', $data)) {
			return $this->db->insert_id();
		}
		return 1;
	}
	

	

	/**
	 * Create cierre
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_cierre($data)
	{
		
		if ($this->db->insert('cierres', $data)) {
			return $this->db->insert_id();
		}
		return NULL;
	}

	/**
	 * Create alerta
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_alerta($data)
	{
		
		if ($this->db->insert('anuncios', $data)) {
			return $this->db->insert_id();
		}
		return NULL;
	}
	function create_corte_caja($entradas,$salidas,$fecha_inicio){
		$data['entradas']=$entradas;
		$data['salidas']=$salidas;
		$total=(int)$entradas-(int)$salidas;
		$data['total']=$total;
		$data['fecha_inicio']=$fecha_inicio;
		$this->db->set('fecha_final', 'NOW()', FALSE);
		if ($this->db->insert('corte_caja', $data)) {
			return $this->db->insert_id();
		}
		return 1;
	}

	/********** UPDATES **************/
		/**
	 * update cliente
	 *
	 * @param	string
	 * @return	object
	 */
	function update_id_participante($id)
	{
		$data['id']=$id+1;
		$this->db->where("auto_increments.tabla",'participante');
		$this->db->update('auto_increments', $data);	
		
		return NULL;
	}
	function update_id_folio($id)
	{
		$data['id']=$id+1;
		$this->db->where("auto_increments.tabla",'registro_admin');
		$this->db->update('auto_increments', $data);	
		
		return NULL;
	}
	/**
	 * update cliente
	 *
	 * @param	string
	 * @return	object
	 */
	function update_registro_participante($participante,$gen,$curso)
	{
		$data['generacion']=$gen;
		$this->db->where("participante.id_participante",$participante);
		$this->db->update('participante', $data);
			$intro['registro']=$gen;
			$this->db->where("preparacion.id_participante",$participante);
			$this->db->where("preparacion.id_curso",$curso);
			$this->db->update('preparacion', $intro);
			return $this->db->affected_rows();
		
		
		
	}
	function update_curso_participante($participante,$gen,$curso)
	{
		$data['generacion']=$gen;
		$this->db->where("participante.id_participante",$participante);
		$this->db->update('participante', $data);
		
			$pro['registro']=$gen;
			$pro['graduado']=TRUE;
			$this->db->where("preparacion.id_participante",$participante);
			$this->db->where("preparacion.id_curso",$curso);
			$this->db->update('preparacion', $pro);
			return $this->db->affected_rows();
			
		
		
	}
	/**
	* Llena el campo campo completo de la tabla de preparación correspondiente con un ="1";	
	*
	*
	*/
	function updatePagoCompleto($participante,$curso)
	{
		
		
			$intro['pago_completo']=1;
			$this->db->where("preparacion.id_participante",$participante);
			$this->db->where("preparacion.id_curso",$curso);
			$this->db->update('preparacion', $intro);
			return $this->db->affected_rows();
			
		
	}

	/**
	 * update registro generación
	 *
	 * @param	string
	 * @return	object
	 */
	function cerrarRegistro($participante,$gen,$curso)
	{
		
		$data['p.generacion']=$gen+1;
		
		if($curso==1){
			$this->db->where("p.id_curso",$curso);
			$this->db->where("p.generacion",$gen);
			$this->db->where("pi.registro",null);
			$this->db->update('participante p join preparacion pi on p.id_participante=pi.id_participante', $data);
		}
			
		return $this->db->affected_rows();
	
		
		
	}
	function inscribir_participante($curso,$participante,$metas,$preparacion,$admin)
	{
		
		
		
		
			$this->create_participante_preparacion($preparacion);
			$this->create_metas($metas);
			$this->create_participante_admin($admin);
			$data['id_curso']=$curso;
			$this->db->where("id_participante",$participante['id_participante']);		
			$this->db->update('participante', $data);
		
			
		return $this->db->affected_rows();
	
		
		
	}
	/**
	 * update backlocks de las generaciones 
	 *
	 * @param	string
	 * @return	affected rows
	 */
	function generarBK($curso)
	{
		
		$data['bk']=1;
		
		
			
			$this->db->where("pi.registro",null);
			$this->db->where("pi.id_curso",$curso);
			$this->db->update('participante p join preparacion pi on p.id_participante=pi.id_participante and (generacion-inscripcion>=2)', $data);
		
			
		return $this->db->affected_rows();
	
		
		
	}
	/**
	 * update drop de las generacion graduada 
	 *
	 * @param	string
	 * @return	affected rows
	 */
	function generarDrops($curso,$generacion)
	{
		
		$data['drop']=1;
		
		
			
			$this->db->where("pi.registro",$generacion);
			$this->db->where("pi.id_curso",$curso);
			$this->db->update('participante p join preparacion pi on p.id_participante=pi.id_participante', $data);
		
			
		return $this->db->affected_rows();
	
		
		
	}


	/**
	 * update ejecutivo
	 *
	 * @param	string
	 * @return	object
	 */
	function updateUsuario($id,$data)
	{
		
		$this->db->where("admins.id_admin",$id);
		$this->db->update('admins', $data);
		
		return NULL;
	}

	/**
	 * update producto stock
	 *
	 * @param	string
	 * @return	object
	 */
	function update_producto_stock($codigo,$data)
	{
		
		$this->db->where("existencias.codigo",$codigo);
		$this->db->update('existencias', $data);
		
		return NULL;
	}

	/**
	 * update inventario ejecutivo
	 *
	 * @param	string
	 * @return	object
	 */
	function update_inventario($codigo,$data,$vendedor)
	{
		
		$this->db->where("INVENTARIO.codigo",$codigo);
		$this->db->where("INVENTARIO.clave_vendedor",$vendedor);
		$this->db->update('INVENTARIO', $data);
		
		return NULL;
	}

	/**
	 * update historial inventario
	 *
	 * @param	string
	 * @return	object
	 */
	function update_historial_inventario($codigo,$data,$vendedor)
	{
		
		$this->db->where("inventario_historial.codigo",$codigo);
		$this->db->where("inventario_historial.clave_vendedor",$vendedor);
		$this->db->where("inventario_historial.estatus",0);
		$this->db->update('inventario_historial', $data);
		
		return NULL;
	}

	/**
	 * update alerta
	 *
	 * @param	string
	 * @return	object
	 */
	function update_alerta($id,$data)
	{
		
		$this->db->where("anuncio_id",$id);
		$this->db->update('anuncios', $data);	
		
		return NULL;
	}

	/********** GETS **************/

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_login($email,$password)
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('LOWER(usuario)=', strtolower($email));
		$this->db->where('contrasena', $password);
		
		$query = $this->db->get();

		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	/**
	 * Get id participante
	 *
	 * @param	string
	 * @return	object
	 */
	function get_id_participante()
	{
		$this->db->select('id');
		$this->db->from('auto_increments');
		$this->db->where('tabla', 'participante');

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$row = $query->row(); 
			$this->update_id_participante($row->id);

			return $row->id;
		} 
		return NULL;
	}
	function get_id_folio()
	{
		$this->db->select('id');
		$this->db->from('auto_increments');
		$this->db->where('tabla', 'registro_admin');

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$row = $query->row(); 
			$this->update_id_folio($row->id);

			return $row->id;
		} 
		return NULL;
	}
	/**
	 * Get user name
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('id_admin', $id);

		$query = $this->db->get();
		if ($query->num_rows() == 1) return $query->result();
		return NULL;
	}
	
	
/**
	 * Get participantes
	 *
	 * @param	string
	 * @return	object
	 */
	function get_participantes_by_gen($generacion)
	{
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');
		$this->db->where("generacion",$generacion);	
			

			
			
		
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
		
	}
	function get_participantes_by_genandcurso($generacion,$curso)
	{
		$empty=NULL;
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');		
		$this->db->join('preparacion', 'preparacion.id_participante = participante.id_participante','inner');		
		$this->db->where("generacion",$generacion);	
		$this->db->where("participante.id_curso",$curso);		
		$this->db->where("registro",0);	
		$this->db->where("bk !=",1);		
		
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
		
	}
	function get_participantes_by_genandcurso_para_graduar($generacion,$curso)
	{
		$empty=NULL;
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');

		
		$this->db->join('preparacion', 'preparacion.id_participante = participante.id_participante','inner');
		$this->db->where("registro",$generacion);	
		
		$this->db->where("participante.generacion",$generacion);	
		$this->db->where("preparacion.id_curso",$curso);
		$this->db->where("preparacion.graduado",$empty);	
		$this->db->where("participante.drop",$empty);
			
			
		
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
		
	}
	function validate_previous_course($data)
	{
		
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');		
		$this->db->join('preparacion', 'preparacion.id_participante = participante.id_participante','inner');
		$this->db->where("preparacion.graduado",true);
		$this->db->where("preparacion.id_curso",$data['id_curso']-1);			
		$this->db->where("participante.id_participante",$data['id_participante']);	
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		if ( $query->num_rows() > 0 )
			{
			    return TRUE;
			}
			else
			{
			    return FALSE;
			}
		
	}

	function get_costo_curso($curso)
	{
		$this->db->select('costo');
		$this->db->from('cursos');
		$this->db->where("id_curso",$curso);
		$query = $this->db->get();
		
		return $query->row();
	}
	function getCostoPromo($promo)
	{
		$this->db->select('precio');
		$this->db->from('promociones');
		$this->db->where("id_promocion",$promo);
		$query = $this->db->get();
		
		return $query->row();
	}
	function get_enrolador($id)
	{
		$this->db->select('*');
		$this->db->from('participante');		
		//$this->db->join('datos_perso', 'participante.id_participante = datos_perso.id_participante','inner');
		if(is_numeric($id)){$this->db->where("participante.id_participante",$id,FALSE); }
		else{ $this->db->like("nombre",$id,FALSE);}
			

			
			
		
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
		
	}
	function getParticipante($id)
	{
		
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');
		$this->db->join('datos_perso', 'participante.id_participante = datos_perso.id_participante','inner');		
		if(is_numeric($id)){$this->db->where("participante.id_participante",$id,FALSE); }
		else{ $this->db->like("nombre",$id,FALSE);}
	
		
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
		
	}
	function getCursoParticipante($id)
	{   $this->db->select('participante.id_curso as curso');
		$this->db->from('participante');
		$this->db->join('cursos', 'participante.id_curso = cursos.id_curso','inner');
		$this->db->where('participante.id_participante',$id);
		$query = $this->db->get();
		
			$row = $query->row(); 
			return $row->curso;
	}
	function getAdeudoParticipante($id)
	{
		$curso=$this->getCursoParticipante($id);

		$adeudo=NULL;
		if(!$this->esBecado($id)){
				if($this->tieneHistorialAdmin($id,$curso)){
				 $adeudo= $this->getLastAdeudo($id);

			}else
			{			
				 $adeudo= $this->getAdeudo($id,$curso);		
				
			}
		}
		
		
		return $adeudo;
	}


	/**
	 * Get cierres
	 *
	 * @return	object
	 */
	function getAllCursos()
	{
		
		$this->db->select('*');
		$this->db->from('cursos');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	function getAccesos()
	{
		
		$this->db->select('id_admin,Usuario');
		$this->db->from('admins');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}

	/**
	 * Get anuncios
	 *
	 * @param	string
	 * @return	object
	 */
function getAllPromociones()
	{
		
		$this->db->select('*');
		$this->db->from('promociones');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}




	function esBecado($id_participante)
	{
		$this->db->select('becado');
		$this->db->from('participante');
		$this->db->where('participante.id_participante',$id_participante);
		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$row = $query->row(); 
			if($row->becado==1)
				return true;
			else
				return false;
		
		} 
		return false;
		

	}
	function tieneHistorialAdmin($id_participante,$id_curso)
	{
		$this->db->select('cantidad_adeudo');
		$this->db->from('registro_admin');
		$this->db->where('id_participante',$id_participante);
		$this->db->where('id_curso',$id_curso);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			
			return true;
			
		
		} 
		return false;
	
	}
	function getLastAdeudo($id_participante)
	{
		$this->db->select('cantidad_adeudo as adeudo');
		$this->db->from('registro_admin');
		$this->db->where('id_participante',$id_participante);
		$this->db->order_by("registro_admin.folio", "desc"); 
		$query = $this->db->get();
		if ($query->num_rows() >0)
		{
			$row = $query->row(0); 
			return $row->adeudo;
		}
		$zero='0';
		return $zero;
	}
	function getAdeudo($id_participante,$curso)
	{
		$this->db->select('costo');
		$this->db->from('datos_admin');
		$this->db->where('id_participante',$id_participante);
		$this->db->where('id_curso',$curso);
		$query = $this->db->get();
		
			$row = $query->row(); 
			return $row->costo;
	}
	
	function getBusquedaByCurso($id_curso)
	{
		$this->db->select('*');
		$this->db->from('participante');
		//$this->db->join('datos_perso',' participante.id_participante = datos_perso.id_participante','inner');
		$this->db->where('participante.id_curso',$id_curso);
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
	}
	function getBusquedaByGen($gen)
	{
		$this->db->select('*');
		$this->db->from('participante');
		//$this->db->join('datos_perso',' participante.id_participante = datos_perso.id_participante','inner');
		$this->db->where('participante.generacion',$gen);
		$this->db->order_by("participante.id_participante", "asc"); 

		$query = $this->db->get();
		
		return $query->result();
	}
	function getFolioPago()
	{
		$this->db->select('id');
		$this->db->from('auto_increments');
		$this->db->where('tabla', 'registro_admin');

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$row = $query->row(); 
			$this->update_id_folio($row->id);

			return $row->id;
		} 
		return NULL;
	}

	function getHistorialPagos($date){

		$this->db->select('*');
		$this->db->from('registro_admin');
		$this->db->join('participante', 'participante.id_participante = registro_admin.id_participante','inner');
		$query=$this->db->like('fecha_pago',  date('Y-m-d'));
		$query=$this->db->get();
		return  $query->result();
	}
	function getLastCorte()
	{
		$this->db->select('fecha_final as fecha');
		$this->db->from('corte_caja');		
		$this->db->order_by("corte_caja.id", "desc"); 
		$query = $this->db->get();
		if ($query->num_rows() >0)
		{
			$row = $query->row(0); 
			return $row->fecha;
		}
		$zero=NULL;
		return $zero;
	}

function getCajaAfterDate(){
 return "AFTER DATE CAJA";
}
function getAllCaja(){
	$this->db->select('*');
	$this->db->from('registro_admin');
	$this->db->order_by("registro_admin.fecha_pago", "asc"); 
	$query = $this->db->get();

	return $query->result();
}
	function getCountEntradas($where){

	$this->db->select_sum( 'cantidad_pagada' ) ;
	$this->db->from('registro_admin');
		if($where!=0){
			$this->db->where('fecha_pago >', $where);
		}
		$query=$this->db->get();
		$row = $query->row(0); 
			return $row->cantidad_pagada;
	}

	function getCountSalidas($where){
		$this->db->select_sum( 'cantidad_pagada' ) ;
		$this->db->from('registro_admin');
		if($where!=0){
			$this->db->where('fecha_pago >', $where);
		}
		$query=$this->db->get();
		return  $query->result();
	}
	function getParticipantes(){
		$this->db->select('*');
		$this->db->from('participante');
		
		/*$this->db->query("'SELECT m1.* , MIN( m1.cantidad_adeudo ) adeudo FROM registro_admin m1 
							LEFT JOIN registro_admin m2 ON ( m1.id_participante = m2.id_participante 
							AND m1.cantidad_adeudo < m2.cantidad_adeudo ) 
							WHERE m1.cantidad_adeudo !=0 GROUP BY m1.id_participante ASC'");*/
		$query=$this->db->get();
		return  $query->result();
	}
	function getParticipanteDetalle($id_participante){
		$this->db->select('m1.*');
		$this->db->select('p1.*');
		$this->db->from('datos_perso m1');
		$this->db->join('participante p1', 'p1.id_participante = m1.id_participante','inner');
		$this->db->where('m1.id_participante',$id_participante);
		/*$this->db->query("'SELECT m1.* , MIN( m1.cantidad_adeudo ) adeudo FROM registro_admin m1 
							LEFT JOIN registro_admin m2 ON ( m1.id_participante = m2.id_participante 
							AND m1.cantidad_adeudo < m2.cantidad_adeudo ) 
							WHERE m1.cantidad_adeudo !=0 GROUP BY m1.id_participante ASC'");*/
		$query=$this->db->get();
		return  $query->result();
	}
	function getParticipantesAdeudo(){
		$this->db->select('m1.*');
		$this->db->select('p1.*');
		$this->db->select('MIN(m1.cantidad_adeudo) adeudo');
		$this->db->from('registro_admin m1');
		$this->db->join('registro_admin m2', 'm1.id_participante = m2.id_participante','inner');
		$this->db->join('participante p1', 'p1.id_participante = m1.id_participante','inner');
		$this->db->where('m1.cantidad_adeudo !=',0);
		$this->db->group_by("m1.id_participante", "asc"); 
		/*$this->db->query("'SELECT m1.* , MIN( m1.cantidad_adeudo ) adeudo FROM registro_admin m1 
							LEFT JOIN registro_admin m2 ON ( m1.id_participante = m2.id_participante 
							AND m1.cantidad_adeudo < m2.cantidad_adeudo ) 
							WHERE m1.cantidad_adeudo !=0 GROUP BY m1.id_participante ASC'");*/
		$query=$this->db->get();
		return  $query->result();
	}

	function getBackLocks(){
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->where('bk',1);
		$query=$this->db->get();
		return  $query->result();
	}
	function getDrops(){
		$this->db->select('*');
		$this->db->from('participante');
		$this->db->where('drop',1);
		$query=$this->db->get();
		return  $query->result();
	}
	function getTendencia(){
		$this->db->select('generacion');
		$this->db->select('count(*) total');
		$this->db->from('participante');
		$this->db->group_by('participante.generacion', 'asc');
		$this->db->order_by('participante.generacion', 'asc');
		
		$query=$this->db->get();
		return  $query->result();
	}
		function porcentajeContinuidad(){
		$this->db->select('id_curso');		
		$this->db->select('count(*) total');
		$this->db->from('preparacion');			
		$this->db->where("preparacion.id_curso >",0);
		$this->db->where('preparacion.registro IS NOT NULL', null, false);
		$this->db->group_by("preparacion.id_curso", "desc"); 
		$this->db->limit('3');
		$query=$this->db->get();
		return  $query->result();
	
	}
	function insertUsuario($data){
	
		if ($this->db->insert('admins', $data)) {
			return $this->db->insert_id();
		}
	}
	function deleteUsuario($id){
	$this->db->where('id_admin', $id);
   $this->db->delete('admins');
   return 1;
   }
   function insertCurso($data){
	
		if ($this->db->insert('cursos', $data)) {
			return $this->db->insert_id();
		}
	} 
	function deleteCurso($id){
	$this->db->where('id_curso', $id);
   $this->db->delete('cursos');
   return 1;
   }
}
?>