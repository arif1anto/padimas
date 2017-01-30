<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cprogram extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mprogram','mmaster','mkonfig','mlogin'));
        $this->cek_sess();
        // menghilangkan cache ketika menekan tombol back sesudah logout
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

    private function init($id=1){
        $key = $this->session->userdata('filter_prg');
        $url ='admin/program/page';
        if(!empty($key)) {
            $totrows = $this->mprogram->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mprogram->getprogramby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter_prg');
            $totrows = $this->mprogram->getprogram();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mprogram->getprogramby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    private function getform(){
        $form = "";
        if ($this->input->post("prodi1")!=null || $this->input->post("prodi2")!=null) {
            $form .= '<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pilih Program Studi</h3>
                    </div>
                    <div class="panel-body">
                        <p>Silakan pilih dua program studi yang saudara minati:</p>';
            $form .= $this->input->post("prodi1");
            $form .= $this->input->post("prodi2");
            $form .= '</div></div>';
        }
        if ($this->input->post("nama")!=null ||
            $this->input->post("no_induk")!=null ||
            $this->input->post("alamat")!=null ||
            $this->input->post("telp")!=null ||
            $this->input->post("email")!=null ||
            $this->input->post("jml_saudara")!=null ||
            $this->input->post("anak_ke")!=null ||
            $this->input->post("nama_ayah")!=null ||
            $this->input->post("nama_ibu")!=null ||
            $this->input->post("kerja_ayah")!=null ||
            $this->input->post("kerja_ibu")!=null ||
            $this->input->post("alamat_ayah")!=null ||
			$this->input->post("alamat_ibu")!=null ||
            $this->input->post("telp_ayah")!=null ||
			$this->input->post("telp_ibu")!=null ||
			$this->input->post("pdpt_ortu")!=null){
            $form .= '<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Pendaftar</h3>
                </div>
                <div class="panel-body">
                    <p>Silakan isi data pribadi berikut ini dengan sebenar-benarnya:</p>';
            $form .= $this->input->post("nama");
            $form .= $this->input->post("no_induk");
            $form .= $this->input->post("alamat");
            $form .= $this->input->post("telp");
            $form .= $this->input->post("email");
            $form .= $this->input->post("jml_saudara");
            $form .= $this->input->post("anak_ke");
            $form .= $this->input->post("nama_ayah");
            $form .= $this->input->post("nama_ibu");
            $form .= $this->input->post("kerja_ayah");
            $form .= $this->input->post("kerja_ibu");
            $form .= $this->input->post("alamat_ayah");
			$form .= $this->input->post("alamat_ibu");
            $form .= $this->input->post("telp_ayah");
			$form .= $this->input->post("telp_ibu");
			$form .= $this->input->post("pdpt_ortu");
            $form .= '</div></div>';
        }
        if ($this->input->post("nama_sekolah")!=null ||
			$this->input->post("alamat_sekolah")!=null ||
            $this->input->post("telp_sekolah")!=null ||
            $this->input->post("nama_gurubk")!=null ||
            $this->input->post("telp_bk")!=null ||
            $this->input->post("raport_smt1")!=null ||
            $this->input->post("raport_smt2")!=null ||
            $this->input->post("raport_smt3")!=null ||
            $this->input->post("raport_smt4")!=null ||
            $this->input->post("rata_uan")!=null ||
            $this->input->post("prestasi")!=null) {
            $form .= '<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Sekolah</h3>
                    </div>
                    <div class="panel-body">';
            $form .= $this->input->post("nama_sekolah");
			$form .= $this->input->post("alamat_sekolah");
            $form .= $this->input->post("telp_sekolah");
            $form .= $this->input->post("nama_gurubk");
            $form .= $this->input->post("telp_bk");
            $form .= $this->input->post("raport_smt1");
            $form .= $this->input->post("raport_smt2");
            $form .= $this->input->post("raport_smt3");
            $form .= $this->input->post("raport_smt4");
            $form .= $this->input->post("rata_uan");
            $form .= $this->input->post("prestasi");
            $form .= '</div></div>';
        }
        
        //her registrasi
        if ($this->input->post("her_prodi")!=null) {
            $form .= '<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Program Studi Diterima</h3>
                    </div>
                    <div class="panel-body">
                        <p>Silakan pilih program studi tempat saudara diterima:</p>';
            $form .= $this->input->post("her_prodi");
            $form .= '</div></div>';
        }
        if ($this->input->post("her_nama")!=null ||
            $this->input->post("her_telp")!=null ||
            $this->input->post("her_no_induk")!=null ||
            $this->input->post("her_nama_sekolah")!=null ||
            $this->input->post("her_kota_sekolah")!=null ) {
            $form .= '<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Calon Mahasiswa</h3>
                    </div>
                    <div class="panel-body">
                        <p>Silakan isi formulir berikut ini dengan sebenar-benarnya:</p>';
            $form .= $this->input->post("her_nama");
            $form .= $this->input->post("her_telp");
            $form .= $this->input->post("her_no_induk");
            $form .= $this->input->post("her_nama_sekolah");
            $form .= $this->input->post("her_kota_sekolah");
            $form .= '</div></div>';
        }
        if ($this->input->post("her_nama_pengirim")!=null ||
            $this->input->post("her_bank")!=null ||
            $this->input->post("her_jmlkirim")!=null ||
            $this->input->post("her_norek")!=null ||
            $this->input->post("her_berita")!=null ||
            $this->input->post("her_tgltransfer")!=null) {
            $form .= '<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bukti Transfer Biaya</h3>
                    </div>
                    <div class="panel-body">
                        <p>Silakan isi formulir berikut ini dengan sebenar-benarnya:</p>';
            $form .= $this->input->post("her_nama_pengirim");
            $form .= $this->input->post("her_bank");
            $form .= $this->input->post("her_jmlkirim");
            $form .= $this->input->post("her_norek");
            $form .= $this->input->post("her_berita");
            $form .= $this->input->post("her_tgltransfer");
            $form .= '</div></div>';
        }
        return $form;
    }

    public function index(){
        $v = $this->init(1);
        $v['judul'] = "Program";
        $this->session->unset_userdata('filter_prg');
        $v['content'] = "admin/program";
        $this->global_view($v);
    }

    public function baru($aksi=null){
        $v['judul'] = "Program Baru";
		$v['data5'] = $this->mkonfig->getjenis_beasiswa();
        if ($aksi=="simpan") {
            if ($_POST) {
                $id = $this->input->post('id')+1;
                $cek = $this->mprogram->getprogramby_id($id);
                if ($this->input->post("dgform")==null) {
                    $form = null;
                } else {
                    $form = $this->getform()==""?null:$this->getform();
                }
                //image
                $config = array(
                    'upload_path' => "./image/program/",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048000", 
                    'max_height' => "768",
                    'max_width' => "1024"
                );
                $this->load->library('upload', $config);
                $src_file = null;
                if($this->upload->do_upload()){
                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $file_name = $upload_data['file_name'];
                    $src_file = "img/program/".$file_name;
                    //echo base_url().index_page()."image/program/".$file_name;
                }
                else{
                    $error = array('error' => $this->upload->display_errors());
                    $src_file = null;
                    echo $error['error'];
                }
                if (count($cek)==0) {
                    $this->mprogram->inprogram($form,$src_file,count($v['data5']));
                } else {
                    $this->mprogram->upprogram($id,$form,$src_file,count($v['data5']));
                }
            } 
            redirect("admin/program");  
        } else {
            $v['data2'] = $this->mprogram->getmaxid();
            $v['data3'] = $this->mmaster->getcbprodi_bystatus(1);
            $v['content'] = "admin/program_baru";

            $this->global_view($v);
        }
    }

    public function cari(){
        if ($_POST) {
            $key = $this->input->post('key');
            $filter = $key.'&';
            $this->session->set_userdata('filter_prg', $filter);
            $v = $this->init(1);
            $v['content'] = "admin/program";
            $this->global_view($v);
        } else {
            redirect("admin/program");
        } 
    }

    public function edit($id=null, $aksi=null){
        $v['judul'] = "Sunting Program";
		$v['data5'] = $this->mkonfig->getjenis_beasiswa();
        if ($id!=null) {
            if ($aksi=="simpan") {
                if ($_POST) {
                    if ($this->input->post("dgform")==null) {
                        $form = null;
                    } else {
                        $form = $this->getform()==""?null:$this->getform();
                    }
                    //image
                    $config = array(
                        'upload_path' => "./img/program/",
                        'allowed_types' => "jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'max_size' => "2048000"
                        //'max_height' => "768",
                        //'max_width' => "1024"
                    );
                    $this->load->library('upload', $config);
                    $src_file = null;
                    if($this->upload->do_upload()){
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                        $file_name = $upload_data['file_name'];
                        $src_file = "img/program/".$file_name;
                        //echo base_url().index_page()."image/program/".$file_name;
                    }
                    else{
                        //$error = array('error' => $this->upload->display_errors());
                        $src_file = null;
                       // echo $error['error'];
                    }
                    $this->mprogram->upprogram($id,$form,$src_file,count($v['data5']));
                }
                redirect("admin/program");
            } else {
                $v['data1'] = $this->mprogram->getprogramby_id($id);
                $v['data3'] = $this->mmaster->getcbprodi_bystatus(1);
				$v['data4'] = $this->mmaster->getcbpropinsi();
                $v['content'] = "admin/program_baru";
                $this->global_view($v);
            }
        } else {
            redirect("admin/halaman");
        }
    }

    public function page($id=1){
        $v = $this->init($id);
        $v['content'] = "admin/program";
        $this->global_view($v);
    }

    private function refresh(){
        $v = $this->init(1);
        $data = $v['data1'];
        if (count($data)>0) {
            foreach ($data as $row) {
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="page_'.$row->prg_id.'" value="'.$row->prg_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/program/edit/'.$row->prg_id.'" title="Click to edit">'.$row->prg_nama.'</a></strong></td>';
                echo '<td>'.$row->prg_judul.'</td>';
                echo '<td><a href="'.base_url().index_page().'program/'.$row->prg_link.'" target="_blank">'.base_url().index_page().'program/'.$row->prg_link.'</a></td>';
                echo '<td>'.$row->prg_tglmulai.' s.d. '.$row->prg_tglakhir.'</td>';
                echo '<td class="text-center"><span class="label label-'.($sts?'success':'default').'"><i class="fa fa-'.($sts?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>
                <td colspan="6" class="danger text-center"><strong>Tidak ditemukan program</strong></td>
            </tr>';
        }
    }

    // ajax simpandraft
    public function simpandraft(){
        //cek id
        $id = $this->input->post("id")+1;
        $cek = $this->mprogram->getprogramby_id($id);
        if (count($cek)==0) {
            $this->mprogram->inprogram();
        } else {
            $this->mprogram->upprogram($id);
        }
        echo "<small>Terakhir disimpan ".date_format(new datetime(),"d/m/y H:i:s")."</small>";
    }

    // ajax hapus
    public function hapus(){
        $id=$this->input->post('id');
        $ex = explode("|", $id);
        for ($i=0; $i < count($ex); $i++) { 
            if ($ex[$i]!="") {
                $this->mprogram->delprogram($ex[$i]);
            }
        }
        $this->refresh();
    }

    private function paging($id,$url=null,$totrows=null){   
        $config['base_url'] = site_url($url);
        $config['uri_segment'] = 4;
        $config['num_links']= 10;
        $config['per_page'] = 10; 
        $config['total_rows'] = $totrows;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
        $config['next_tag_open'] = '<li data-toggle="tooltip" data-placement="top" title="Halaman Selanjutnya">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-chevron-left" title="Halaman Sebelumnya"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['use_page_numbers'] = true;
        $page = $config['per_page']*($id-1);
        $jml = ceil($totrows/$config['per_page']);
        $config['full_tag_open'] = '<li class="active"><a>Page '.$id.'/'.$jml;
        $config['full_tag_close'] = '</a></li>';
        $this->pagination->initialize($config);
        $rkey=array('confpage' => $config['per_page'],'idpage' => $page );
        return $rkey;
    }

    private function global_view($v) {
        $v['menu'] = $this->mlogin->getmenu_backend($this->session->userdata("user"));
        isset($v['active'])  ? $v['active'] : $v['active']  = null;
        isset($v['judul'])   ? $v['judul']  : $v['judul']   = null;
        isset($v['menu'])    ? $v['menu']   : $v['menu']    = null;
        isset($v['content']) ? $v['content']: $v['content'] = null;
        isset($v['user'])   ? $v['user']  : $v['user']   = null;
        isset($v['data1'])   ? $v['data1']  : $v['data1']   = null;
        isset($v['data2'])   ? $v['data2']  : $v['data2']   = null;
        isset($v['data3'])   ? $v['data3']  : $v['data3']   = null;
        isset($v['data4'])   ? $v['data4']  : $v['data4']   = null;
        isset($v['data5'])   ? $v['data5']  : $v['data5']   = null;
        isset($v['sfilter']) ? $v['sfilter']: $v['sfilter'] = null;
        isset($v['idpage'])  ? $v['idpage'] : $v['idpage']  = null;

        if (!isset($v['judul'])) {
        	$v['judul'] = "Admin PADIMAS";
        } else {
        	$v['judul'] = $v['judul']==''?"Admin PADIMAS":$v['judul']." | Admin PADIMAS";
        }

        $data = array(
            "active"    => $v['active'],
            "judul"     => $v['judul'],
            "view"      => $v['content'],
            "menu"      => $v['menu'],
            "user"     => $v['user'],
            "data1"     => $v['data1'],
            "data2"     => $v['data2'],
            "data3"     => $v['data3'],
            "data4"     => $v['data4'],
            "data5"     => $v['data5'],
            "sfilter"   => $v['sfilter'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
