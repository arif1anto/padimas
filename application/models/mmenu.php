<?php
class Mmenu extends CI_Model {
	
	var $tb = "pmb_menu";
	function __construct() {
		parent::__construct();
	}

	function addmenu(){
		$link =  $this->input->post('link');
		$link = explode(base_url().index_page(), $link);
		if (count($link)>1) {
			$link = "[host]".$link[1];
		} else {
			$link = $link[0];
		}
		$data = array(
					'menu_nama' => $this->input->post("nama"),
					'menu_link' => $link,
					'menu_link_title' =>  $this->input->post("link_title"),
					'menu_parent' =>  $this->input->post("parent"),
					'menu_icon' =>  $this->input->post("icon"),
					'menu_role'	=> 'user',
					'menu_order' => $this->getOrder()
					);
		$this->db->insert($this->tb,$data);
		return true;
	}

	function upmenu($id=null){
		if ($id!=null) {
			$link =  $this->input->post('link');
			$link = explode(base_url().index_page(), $link);
			if (count($link)>1) {
				$link = "[host]".$link[1];
			} else {
				$link = $link[0];
			}
			$data = array(
						'menu_nama' => $this->input->post("nama"),
						'menu_link' => $link,
						'menu_link_title' =>  $this->input->post("link_title"),
						'menu_parent' =>  $this->input->post("parent"),
						'menu_icon' =>  $this->input->post("icon")
						);
			$this->db->where('menu_id',$id);
			$this->db->update($this->tb,$data);
			return true;
		}
	}

	function delmenu($id) {
		$this->db->where('menu_id', $id);
        $this->db->delete($this->tb); 
	}

	function move($id){
		$ket = $this->input->post("action");
		$pos = $this->input->post("pos");
		if ($ket=="down") {
			if ($pos<$this->getOrder()-1) {
				$data = array('menu_order' => $pos);
				$this->db->where("menu_order",$pos+1);
				$this->db->update($this->tb,$data);
				$data = array('menu_order' => $pos+1);
				$this->db->where("menu_id",$id);
				$this->db->update($this->tb,$data);
			}
		} elseif ($ket=="up") {
			if ($pos>1) {
				$data = array('menu_order' => $pos);
				$this->db->where("menu_order",$pos-1);
				$this->db->update($this->tb,$data);
				$data = array('menu_order' => $pos-1);
				$this->db->where("menu_id",$id);
				$this->db->update($this->tb,$data);
			}
		}
	}

	private function getmenu(){
		$q = $this->db->select("menu_id,menu_nama,menu_link_title,menu_parent,menu_icon,menu_role,menu_order,
						REPLACE(menu_link,'[host]','".base_url().index_page()."') as menu_link",false)
					  ->from($this->tb)
					  ->where("menu_role",'user')
					  ->order_by("menu_order","asc");
		return $q;
	}

	private function getOrder(){
		$q = $this->db->query("SELECT IFNULL(MAX(menu_order),0)+1 id FROM pmb_menu WHERE menu_role='user'")
			->row();
		return $q->id;
	}

	function geticon(){
		$q = $this->db->get("pmb_icon");
		return $q->result();
	}

	function getmenu_all(){
		$q = $this->getmenu();
		return $q->get()->result();
	}

	function getmenu_parent(){
		$q = $this->getmenu();
		$q = $q->where("menu_parent",0);
		return $q->get()->result();
	}

}