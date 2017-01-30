<?php

class Mlogin extends CI_Model {
	
	var $tb = "pmb_author";
	function __construct() {
		parent::__construct();
	}

	function login(){
		$q = $this->db->select('*')
				      ->from($this->tb)
				      ->where(array('aut_username' => $this->security->xss_clean(trim($this->input->post('uname'))), 
				      				'aut_pass' => $this->security->xss_clean(trim($this->input->post('password')))))
				      ->get();
		if ($q->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	function getauthorby_uname($uname){
		$q = $this->db->select("a.*, c.*")
				  ->from($this->tb." a")
				  ->join("pmb_hakakses b","a.aut_username=b.aut_username","inner")
				  ->join("pmb_group c","b.id_hakakses=c.id_hakakses","inner")
				  ->where("a.aut_username",$uname)
				  ->order_by("c.id_hakakses","asc")
				  ->get();
		return $q->row();
	}

	function getakses($uname){
		$q = $this->db->select("a.*, c.*")
				  ->from($this->tb." a")
				  ->join("pmb_hakakses b","a.aut_username=b.aut_username","inner")
				  ->join("pmb_group c","b.id_hakakses=c.id_hakakses","inner")
				  ->where("a.aut_username",$uname)
				  ->order_by("c.id_hakakses","asc")
				  ->get();
		return $q->result();
	}

	function getmenu_backend($user=null){
		$parent = $this->getmenu_admin($user);
		$menu = '<ul class="nav navbar-top-links navbar-left">';
		//level 0
		foreach ($parent as $row) {
			if ($row->jml>0) {
				$menu .= '<li class="dropdown"><a href="'.$row->menu_link.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$row->menu_nama.'</a><ul class="dropdown-menu multi-level">';
				$level_1 = $this->getmenu_admin($user,$row->menu_id);
				//level 1
				foreach ($level_1 as $row1) {
					if ($row1->jml>0) {
						$menu .= '<li class="dropdown-submenu"><a href="'.$row1->menu_link.'">'.$row1->menu_nama.'</a><ul class="dropdown-menu">';
						$level_2 = $this->getmenu_admin($user,$row1->menu_id);
						//level 2
						foreach ($level_2 as $row2) {
							$menu .= '<li><a href="'.$row2->menu_link.'">'.$row2->menu_nama.'</a></li>';
						}
						$menu .= "</ul></li>";
					} else {
						$menu .= '<li><a href="'.$row1->menu_link.'">'.$row1->menu_nama.'</a></li>';
					}
				}
				$menu .= "</ul></li>";
			} else {
				$menu .= '<li><a href="'.$row->menu_link.'">'.$row->menu_nama.'</a></li>';
			}
		}
		$menu .= '</ul>';
		return $menu;
	}

	function getprivilieges($role=null,$url=null){
		if ($url==base_url().index_page()."admin") {
			return true;
		} else {
			$q = $this->db->select("a.id_hakakses")
						->from("pmb_group a")
						->join("pmb_group_menu b","a.id_hakakses=b.id_hakakses","inner")
						->join("pmb_menu c","b.menu_id=c.menu_id","inner")
						->where("'$url' LIKE CONCAT(REPLACE(c.menu_link,'[host]','".base_url().index_page()."'),'%') ",'',false)
						->where("a.group",$role)
						->get()->num_rows();
			return ($q>0);
		}
	}

	// menu admin
	function getmenu_admin($user=null,$parent=0){
		$q = $this->db->select("a.menu_id,a.menu_nama,a.menu_link_title,a.menu_parent,a.menu_icon,a.menu_role,
						REPLACE(a.menu_link,'[host]','".base_url().index_page()."') as menu_link,
						(SELECT COUNT(*) FROM pmb_menu WHERE menu_parent=a.menu_id) jml",false)
					->from("pmb_menu a")
					->join("pmb_group_menu b","a.menu_id=b.menu_id","inner")
					->join("pmb_hakakses c","b.id_hakakses=c.id_hakakses","inner")
					->where("a.menu_parent",$parent)
					->where("a.menu_role","admin")
					->where("c.aut_username",$user)
					->group_by("a.menu_id")
					->order_by("a.menu_order","asc");
		return $q->get()->result();
	}

	function getallmenu_admin($user=null,$parent=0){
		$q = $this->db->select("a.menu_id,a.menu_nama,a.menu_link_title,a.menu_parent,a.menu_icon,a.menu_role,
						REPLACE(a.menu_link,'[host]','".base_url().index_page()."') as menu_link,
						(SELECT COUNT(*) FROM pmb_menu WHERE menu_parent=a.menu_id) jml, 
						CASE WHEN ISNULL(c.aut_username) THEN '' ELSE 'checked' END cek",false)
					->from("pmb_menu a")
					->join("pmb_group_menu b","a.menu_id=b.menu_id","left")
					->join("pmb_hakakses c","b.id_hakakses=c.id_hakakses and c.aut_username='".$user."'","left")
					->where("a.menu_parent",$parent)
					->where("a.menu_role","admin")
					->group_by("a.menu_id")
					->order_by("a.menu_order","asc");
		return $q->get()->result();
	}
	
	function unduh($id=null,$pin=null){
		$q = $this->db->select('a.id_daftar')
				      ->from("pmb_pendaftar a")
					  ->join("pmb_rekomendasi b","b.id_daftar=a.id_daftar","inner")
				      ->where(array('b.id_rekomendasi' => $id, 
				      				'a.pin' => $pin))
				      ->get();
		if ($q->num_rows()==1) {
			return true;
		} else {
			return false;
		}
	}

	// Hak Akses
	function getmenu_checkbox($user = null){
		$parent = $this->getallmenu_admin($user);
		$menu = '<div class="table-responsive"><table class="table"><tr>';
		//level 0
		foreach ($parent as $row) {
				$menu .= '<td>';
				$menu .= '<div class="checkbox level-0">
                              <label><input type="checkbox" name="menu['.$row->menu_id.']" value="'.$row->menu_id.'" '.$row->cek.'>'.$row->menu_nama.'</label>';
				$level_1 = $this->getallmenu_admin($user,$row->menu_id);
				//level 1
				foreach ($level_1 as $row1) {
					$menu .= '<div class="checkbox level-1">
                          <label><input type="checkbox" name="menu['.$row1->menu_id.']" value="'.$row1->menu_id.'" '.$row1->cek.'>'.$row1->menu_nama.'</label>';
					$level_2 = $this->getallmenu_admin($user,$row1->menu_id);
					//level 2
					foreach ($level_2 as $row2) {
						$menu .= '<div class="checkbox level-2">
                          <label><input type="checkbox" name="menu['.$row2->menu_id.']" value="'.$row2->menu_id.'" '.$row2->cek.'>'.$row2->menu_nama.'</label></div>';
					}
					$menu .= "</div>";
				}
				$menu .= "</div>";
				$menu .="</td>";
		}
		$menu .= '</tr></table></div>';
		return $menu;
	}

	function getgroup_akses(){
		$q = $this->db->get('pmb_group');
		return $q->result();
	}

	function delete_hakakses($id=null){
		if ($id!=null) {
			$this->db->where('id_hakakses', $id);
			$this->db->delete('pmb_group_menu'); 
			return true;
		} else {
			return false;
		}
	}

	function add_hakakses($id_hak=null,$menu_id=null){
		if ($id_hak!=null && $menu_id!=null) {
			$data = array('id_hakakses' => $id_hak, 
						'menu_id'	=> $menu_id);
			$this->db->insert("pmb_group_menu",$data);
			return true;
		} else {
			return false;
		}
	}
}