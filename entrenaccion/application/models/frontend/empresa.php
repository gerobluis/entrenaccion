<?php

class Empresa extends CI_Model
{

	private $table_name			= 'empresa';			// company

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Create new company record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_company($data)
	{
		$data['creacion'] = date('Y-m-d H:i:s');
		$data['actualizacion'] = date('Y-m-d H:i:s');
		if ($this->db->insert('empresa', $data)) {
			$empresa_id = $this->db->insert_id();
			return $empresa_id;
		}
		return NULL;
	}

	/**
	 * Create new group companyuser record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_grpempresauser($data)
	{
		$data['creacion'] = date('Y-m-d H:i:s');
		if ($this->db->insert('grp_empresa_usuario', $data)) {
			$empresa_id = $this->db->insert_id();
			return $empresa_id;
		}
		return NULL;
	}


	/**
	 * Create new number company record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function create_number_company($data)
	{
		$this->db->insert('numero_empresa', $data);
	}

	/**
	 * Create new address company record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function create_address_company($data)
	{
		$data['creacion'] = date('Y-m-d H:i:s');
		$data['actualizacion'] = date('Y-m-d H:i:s');
		
		$this->db->insert('direccion', $data);
		return NULL;
	}

	/**
	 * Create new pedido record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function save_pedido($data)
	{
		$this->db->insert('deposito', $data);
		return $this->db->insert_id();
	}

	/**
	 * Create new division pedido record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function division_pedido($data)
	{
		$this->db->insert('division_deposito', $data);
		return $this->db->insert_id();
	}

	/**
	 * Find comision pedido record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function comision_pedido($compania, $sistema,$empresa)
	{
		$this->db->select('historial_comision.comision_id,historial_comision.comision');
		$this->db->from('historial_comision');
		$this->db->join('sistema_emp_compania', 
			'sistema_emp_compania.sistema_emp_compania_id = sistema_emp_compania.sistema_emp_compania_id');
		$this->db->join('sistema_empresa', 
			'sistema_emp_compania.sistema_emp_id = sistema_empresa.sistema_empresa_id');
		$this->db->where('sistema_empresa.empresa_id', $empresa);
		$this->db->where('sistema_empresa.sistema_id', $sistema);
		$this->db->where('sistema_emp_compania.compania_id', $compania);
		$this->db->where('sistema_emp_compania.compania_id', $compania);
		$this->db->where('historial_comision.estatus', 1);

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Find promocion digito
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function promocion_activa($digito,$compania)
	{
		$this->db->select('promocion.promocion_id');
		$this->db->from('promocion');
		$this->db->where('promocion.digito_promocion', $digito);
		$this->db->where('promocion.compania_id', $compania);
		$this->db->where('promocion.estatus', PROMOCION_ACTIVA);
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	 * Save promocion
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function save_promocion($id,$division)
	{
		$data["promocion_id"] =$id;
		$data["division_deposito_id"] =$division;
		$data["creacion"] =date('Y-m-d H:i:s');
		$this->db->insert('division_promocion', $data);
	}

	/**
	 * Find get company record
	 *
	 * @param	array
	 * @param	bool
	 * @return	null
	 */
	function getCompany($compania)
	{
		$this->db->select('nombre_compania');
		$this->db->from('compania');
		$this->db->where('compania_id', $compania);

		$query = $this->db->get();
		return $query->result();
	}	

	/**
	 * Update company
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function update_company($id,$data)
	{

		$this->db->where("empresa_id",$id);
		$this->db->update("empresa", $data);

	}

	/**
	 * Update address company
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function update_address_company($id,$data)
	{

		$this->db->where("empresa_id",$id);
		$this->db->update("direccion", $data);

	}

	/**
	 * Update deposito pedido
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function update_pedido_cantidad($id,$data)
	{

		$this->db->where("deposito_id",$id);
		$this->db->update("deposito", $data);

	}

}