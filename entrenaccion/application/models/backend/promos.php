 
 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promos extends CI_Model {

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
    function getpromos(){

      /* SELECT o.nm_offer, offer_copy, offer_yuupoints, invitations, offer_promo, nm_bussiness, b.location, b.logo, offer_img
FROM offers as o JOIN bussiness as b on b.id_bussiness = id_business*/
        $this->db->select(' o.nm_offer, offer_copy, offer_yuupoints, invitations, offer_promo, nm_bussiness, b.location, b.logo, offer_img');
        $this->db->from('offers as o');
        $this->db->join('bussiness as b', 'b.id_bussiness = id_bussiness', 'right outer'); 
        $query = $this->db->get();
        return $query->result();
    }
}