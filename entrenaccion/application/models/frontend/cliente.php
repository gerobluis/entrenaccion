<?php

class Cliente extends CI_Model
{

	private $table_name			= 'cliente';			// user accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Load cargo clientes
	 *
	 * @return	array
	 */
	function load_cargoCliente()
	{
		$this->db->select('*');
		$query = $this->db->get('cargo_cliente');
		return $query->result();
	}

	/**
	 * Load estados Mexico
	 *
	 * @return	array
	 */
	function load_estadosMexico()
	{
		$this->db->select('*');
		$query = $this->db->get('estado');
		return $query->result();
	}

	/**
	 * Load municipios Mexico
	 *
	 * @return	array
	 */
	function load_municipiosMexico($estados)
	{
		$this->db->select('*');
		$this->db->where('estado_id',$estados);
		$query = $this->db->get('municipio');
		return $query->result();
	}

	/**
	 * Load ciudad Mexico
	 *
	 * @return	array
	 */
	function load_ciudadMexico($municipio)
	{
		$this->db->select('*');
		$this->db->where('municipio_id',$municipio);
		$query = $this->db->get('ciudad');
		return $query->result();
	}

	/**
	 * Load colonia Mexico
	 *
	 * @return	array
	 */
	function load_coloniaMexico($ciudad)
	{
		$this->db->select('*');
		$this->db->where('ciudad_id',$ciudad);
		$query = $this->db->get('colonia');
		return $query->result();
	}
	
	/**
	 * Load tipo Pagos
	 *
	 * @return	array
	 */
	function load_tipoPagos()
	{
		$this->db->select('*');
		$query = $this->db->get('tipo_deposito');
		return $query->result();
	}

	/**
	 * Load sistemas
	 *
	 * @return	array
	 */
	function load_sistemas($empresa)
	{
		$this->db->select('*');
		$this->db->from('sistema_empresa');
		$this->db->join('sistema', 'sistema.sistema_id = sistema_empresa.sistema_id','left');
		$this->db->where('empresa_id',$empresa);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Load companys
	 *
	 * @return	array
	 */
	function load_companys($sistema,$empresa)
	{
		$this->db->select('historial_comision.*,compania.*');
		$this->db->from('sistema_emp_compania');
		$this->db->join('compania', 'compania.compania_id = sistema_emp_compania.compania_id','left');
		$this->db->join('sistema_empresa', 'sistema_empresa.sistema_empresa_id = sistema_emp_compania.sitema_emp_id','left');
		$this->db->join('historial_comision', 'historial_comision.sistema_emp_compania_id = sistema_emp_compania.sistema_emp_compania_id','left');
		$this->db->where('sistema_empresa.sistema_id',$sistema);
		$this->db->where('sistema_empresa.empresa_id',$empresa);
		$this->db->where('historial_comision.estatus',1);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Load cuenta Bancaria
	 *
	 * @return	array
	 */
	function load_cuentaBancaria()
	{
		$this->db->select('*');
		$this->db->from('cuenta');
		$this->db->where('estatus_id',ACTIVO);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data)
	{
		$data['creacion'] = date('Y-m-d H:i:s');
		$data['actualizacion'] = date('Y-m-d H:i:s');
		if ($this->db->insert('usuario', $data)) {
			$user_id = $this->db->insert_id();
			return $user_id;
		}
		return NULL;
	}

	/**
	 * Create permiso user
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_permiso_usuario($data)
	{
		$data['creacion'] = date('Y-m-d H:i:s');
		$data['estatus_id'] = ACTIVO;
		$data['actualizacion'] = date('Y-m-d H:i:s');
		if ($this->db->insert('permiso_usuario', $data)) {
			$user_id = $this->db->insert_id();
			return $user_id;
		}
		return NULL;
	}

	/**
	 * Update user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function update_user($data,$id)
	{
		$data['actualizacion'] = date('Y-m-d H:i:s');
		$this->db->where("usuario_id",$id);
		$this->db->update("usuario", $data);
		
	}

	/**
	 * Update user permission record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function update_permiso_usuario($data,$id)
	{
		$data['actualizacion'] = date('Y-m-d H:i:s');
		$this->db->where("usuario_id",$id);
		$this->db->update("permiso_usuario", $data);
		
	}


	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email_cliente)=', strtolower($email));
		$query = $this->db->get($this->table_name);
		return $query->num_rows() >= 1;
	}

	/**
	 * Check if email available user for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_availableuser($email,$id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email_cliente)=', strtolower($email));
		$this->db->where('cliente_id !=', $id);
		$query = $this->db->get($this->table_name);
		return $query->num_rows() >= 1;
	}

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_email($email)
	{
		$this->db->where('LOWER(email_cliente)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by id
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_id($id)
	{
		$this->db->where('cliente_id', $id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get company record by id user
	 *
	 * @param	string
	 * @return	object
	 */
	function get_company_by_customer($cliente)
	{
		
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->join('grp_empresa_usuario','usuario.usuario_id=grp_empresa_usuario.usuario_id','left');
		$this->db->join('empresa','empresa.empresa_id=grp_empresa_usuario.empresa_id','left');
		$this->db->where('usuario.usuario_id',$cliente);
		
		$query = $this->db->get();
		if ($query->num_rows() >= 1) return $query->row();
		return NULL;
	}

	/**
	 * Get company record by id 
	 *
	 * @param	string
	 * @return	object
	 */
	function get_company_by_id($id)
	{
		$this->db->where('empresa_id', $id);

		$query = $this->db->get("empresa");
		if ($query->num_rows() >= 1) return $query->result();
		return NULL;
	}

	/**
	 * Get address company record by id user
	 *
	 * @param	string
	 * @return	object
	 */
	function get_address_by_idcompany($id)
	{
		$this->db->where('empresa_id', $id);
		$query = $this->db->get("direccion");
		if ($query->num_rows() >= 1) return $query->row();
		return NULL;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change login user
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */

	function login_user($email,$password)
	{
		$this->db->select('*');
		//$this->db->where('LOWER(email_cliente)=', strtolower($email));
		$this->db->where('pass_cliente', $password);
		$query = $this->db->get($this->table_name);
		var_dump($password);
		if ($query->num_rows() > 0)
		{
			return $query->result();	
		}
		else{
			return false;	
		}
		
	}

	/**
	 * Create new order record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_pedido($data)
	{
		if ($this->db->insert('deposito', $data)) {
			$user_id = $this->db->insert_id();
			return $user_id;
		}
		return NULL;
	}

}
?>