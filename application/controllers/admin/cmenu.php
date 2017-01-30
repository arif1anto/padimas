<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmenu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mmenu','mpage','mkategori','martikel','mlogin'));
        $this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }

    private function cek_sess() {
        $login = $this->session->userdata('login');
        if ($login){
            return true;
        } else {
            redirect('admin/login');
        }
    }


    private function getkategori_art(){
        //parent 0
        $i=0;
        $datakat = null;
        $kat = $this->mkategori->getkategoriby_parent(0);
        foreach ($kat as $row) {
            $datakat[$i] = array('kat_id'   => $row->kat_id,
                                 'kat_nama' => $row->kat_nama,
                                 'kat_link' => $row->kat_link,
                                 'kat_level'=> "kat-level-0",
                                 'kat_sel'  => "",
                                 'kat_nart' => $this->martikel->getkategori_numart($row->kat_id));
            //sub level 1
            $kat1 = $this->mkategori->getkategoriby_parent($row->kat_id);
            foreach ($kat1 as $row1) {
                $i++;
                $datakat[$i] = array('kat_id'   => $row1->kat_id,
                                     'kat_nama' => $row1->kat_nama,
                                     'kat_link' => $row1->kat_link,
                                     'kat_level'=> "kat-level-1",
                                     'kat_sel'  => "",
                                     'kat_nart' => $this->martikel->getkategori_numart($row1->kat_id));
                //sub level 2
                $kat2 = $this->mkategori->getkategoriby_parent($row1->kat_id);
                foreach ($kat2 as $row2) {
                    $i++;
                    $datakat[$i] = array('kat_id'   => $row2->kat_id,
                                         'kat_nama' => $row2->kat_nama,
                                         'kat_link' => $row2->kat_link,
                                         'kat_level'=> "kat-level-2",
                                         'kat_sel'  => "",
                                         'kat_nart' => $this->martikel->getkategori_numart($row2->kat_id));
                    //sub level 3
                    $kat3 = $this->mkategori->getkategoriby_parent($row2->kat_id);
                    foreach ($kat3 as $row3) {
                        $i++;
                        $datakat[$i] = array('kat_id'   => $row3->kat_id,
                                             'kat_nama' => $row3->kat_nama,
                                             'kat_link' => $row3->kat_link,
                                             'kat_level'=> "kat-level-3",
                                             'kat_sel'  => "",
                                             'kat_nart' => $this->martikel->getkategori_numart($row3->kat_id));
                    }
                }
            }
            $i++;
        }
        return $datakat;
    }

	public function index(){
        $v['data1'] = $this->mmenu->getmenu_all();
        $v['data2'] = $this->mmenu->getmenu_parent();
        $v['data3'] = $this->mpage->getcbpage();
        $v['data4'] = $this->mmenu->geticon();
        $v['data5'] = $this->getkategori_art();
		$v['content'] = "admin/menu";
		$this->global_view($v);
	}

    // ajax simpanmenu
    public function simpanmenu(){
        //cek id
        if ($_POST) {
            $this->mmenu->addmenu();
            $this->refresh();
        }
    }
    // ajax simpanmenu
    public function updatemenu(){
        //cek id
        if ($_POST) {
            $this->mmenu->upmenu($this->input->post("id"));
            $this->refresh();
        }
    }
    // ajax hapus menu
    public function hapusmenu(){
        if ($_POST) {
            $id = $this->input->post("id");
            $this->mmenu->delmenu($id);
        }
        $this->refresh();
    }

    public function move(){
        if ($_POST) {
            $id = $this->input->post("id");
            $this->mmenu->move($id);
        }
        $this->refresh();
    }

    //ajax refresh
    private function refresh(){
        $data1 = $this->mmenu->getmenu_all();
        $data2 = $this->mmenu->geticon();
        foreach ($data1 as $row) {
            echo '<div class="panel panel-default">
                <button type="button" class="btn btn-xs btn-danger pull-right" onclick="hapusmenu(\''.$row->menu_id.'\',\''.$row->menu_nama.'\')" style="margin-top: 6px;margin-right:10px;">Hapus</button>
                <div class="btn-group pull-right" style="margin-top: 6px;margin-right:10px;" role="group">
                  <button type="button" class="btn btn-xs btn-primary" onclick="move(\''.$row->menu_id.'\',\'up\',\''.$row->menu_order.'\')" >&nbsp;&nbsp;<i class="fa fa-angle-double-up"></i>&nbsp;&nbsp;</button>
                  <button type="button" class="btn btn-xs btn-primary" onclick="move(\''.$row->menu_id.'\',\'down\',\''.$row->menu_order.'\')" >&nbsp;&nbsp;<i class="fa fa-angle-double-down"></i>&nbsp;&nbsp;</button>
                </div>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row->menu_id.'" aria-expanded="true" aria-controls="collapse'.$row->menu_id.'" style="text-decoration:none;">
                    <div class="panel-heading" role="tab" id="heading'.$row->menu_id.' ?>">
                      <h4 class="panel-title">
                        <small>#'.$row->menu_order.'</small>&nbsp;&nbsp;&nbsp;'.$row->menu_nama.'
                      </h4>
                    </div>
                </a>
                <div id="collapse'.$row->menu_id.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$row->menu_id.'">
                  <div class="panel-body">
                    <form role="form" id="menu'.$row->menu_id.'">
                      <div class="form-group form-group-sm valid required">
                        <label>Nama Menu</label>
                        <div class="input-group">
                            <div class="input-group-addon icon">
                            <select class="form-control icon" name="icon" >';
            foreach ($data2 as $row2) {
                $sel = "";
                if ($row2->icon_nama==$row->menu_icon) {
                    $sel = "selected";
                }
                echo '<option value="'.$row2->icon_nama.'" '.$sel.'>'.$row2->icon_val.'</option>';
            }
            echo '</select>
                            </div>
                            <input type="text" class="form-control" name="nama" placeholder="Contoh: Beranda" value="'.$row->menu_nama.'">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group form-group-sm valid required">
                            <label>Link</label>
                                <input type="text" class="form-control" name="link" value="'.$row->menu_link.'">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group form-group-sm">
                            <label>Link Title</label>
                                <input type="text" class="form-control" name="link_title" value="'.$row->menu_link_title.'">
                          </div>
                        </div>
                      </div>
                      <div class="form-group form-group-sm valid required">
                        <label>Menu Parent</label>
                        <select class="form-control" name="menu_parent">
                            <option value="0">Parent</option>';
                            foreach ($data1 as $row1) {
                                $sel = "";
                                if ($row1->menu_parent==$row->menu_id) {
                                    $sel = "selected";
                                }
                                if ($row1->menu_id!=$row->menu_id) {
                                    echo '<option value="'.$row1->menu_id.'" '.$sel.'>'.$row1->menu_nama.'</option>';
                                }
                            }
                echo '</select>
                      </div>
                      <p class="text-right">
                      <button type="button" class="btn btn-xs btn-primary" onclick="update(\'menu'.$row->menu_id.'\',\''.$row->menu_id.'\')">Update</button>
                      <button type="button" class="btn btn-xs btn-danger" onclick="hapusmenu(\''.$row->menu_id.'\',\''.$row->menu_nama.'\')">Hapus</button>
                      </p>
                    </form>
                  </div>
                </div>
              </div>';
        }
    }

    private function global_view($v) {
        $v['menu'] = $this->mlogin->getmenu_backend($this->session->userdata("user"));
        isset($v['active'])  ? $v['active'] : $v['active'] 	= null;
        isset($v['judul'])   ? $v['judul']  : $v['judul'] 	= null;
        isset($v['menu'])    ? $v['menu'] 	: $v['menu'] 	= null;
        isset($v['content']) ? $v['content']: $v['content'] = null;
        isset($v['data1'])   ? $v['data1'] 	: $v['data1'] 	= null;
        isset($v['data2']) 	 ? $v['data2'] 	: $v['data2'] 	= null;
        isset($v['data3']) 	 ? $v['data3'] 	: $v['data3'] 	= null;
        isset($v['data4']) 	 ? $v['data4'] 	: $v['data4'] 	= null;
        isset($v['data5']) 	 ? $v['data5'] 	: $v['data5'] 	= null;
        isset($v['idpage'])  ? $v['idpage'] : $v['idpage'] 	= null;

        if (!isset($v['judul'])) {
        	$v['judul'] = "Admin PADIMAS";
        } else {
        	$v['judul'] = $v['judul']==''?"Admin PADIMAS":$v['judul']." | Admin PADIMAS";
        }

        $data = array(
            "active" 	=> $v['active'],
            "judul" 	=> $v['judul'],
            "view" 		=> $v['content'],
            "menu" 		=> $v['menu'],
            "data1" 	=> $v['data1'],
            "data2" 	=> $v['data2'],
            "data3" 	=> $v['data3'],
            "data4" 	=> $v['data4'],
            "data5" 	=> $v['data5'],
            "idpage"    => $v['idpage'],
            "csrf"      => ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
