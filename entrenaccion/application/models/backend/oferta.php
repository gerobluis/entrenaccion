<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oferta extends CI_Model {

	    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }


    function getoffers(){
    $this->db->select("*");
    $this->db->from("offers");

    $query = $this->db->get();
    return $query->result();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */