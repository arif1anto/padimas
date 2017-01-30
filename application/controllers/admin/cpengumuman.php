<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpengumuman extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mpengumuman','mkategori','mlogin','mprogram','mrekomendasi','mkonfig'));
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
        $key = $this->session->userdata('filter_png');
        $url ='admin/pengumuman/page';
        $v['data2'] = $this->mpengumuman->getcbbulan();
        if(!empty($key)) {
            $totrows = $this->mpengumuman->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpengumuman->getpengumumanby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter_png');
            $totrows = $this->mpengumuman->getpengumuman();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpengumuman->getpengumumanby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    public function index(){
        $v = $this->init(1);
        $v['judul'] = "Pengumuman";
        $this->session->unset_userdata('filter_png');
        $v['content'] = "admin/pengumuman";
        $this->global_view($v);
    }

    public function baru($aksi=null){
        $v['judul'] = "Pengumuman Baru";
        if ($aksi=="simpan") {
            if ($_POST) {
                $id = $this->input->post('id')+1;
                $cek = $this->mpengumuman->getpengumumanby_id($id);
                if (count($cek)==0) {
                    $this->mpengumuman->inpengumuman($id);
                } else {
                    $this->mpengumuman->uppengumuman($id);
                }
            }  
            redirect("admin/pengumuman");  
        } else {
            $v['data2'] = $this->mpengumuman->getmaxid();
			$v['data3'] = $this->mprogram->getprogramby();
			$v['data4'] = $this->mkonfig->qGetSetting('sampel_surat');
            $v['content'] = "admin/pengumuman_baru";

            $this->global_view($v);
        }
    }

    public function cari(){
        if ($_POST) {
            $tgl = $this->input->post('tgl');
            $key = $this->input->post('key');
            $ket = $this->input->post('png_all');
            $filter = $tgl.'&'.$key.'&'.$ket;
            $this->session->set_userdata('filter_png', $filter);
            $v = $this->init(1);
            $v['content'] = "admin/pengumuman";
            $this->global_view($v);
        } else {
            redirect("admin/pengumuman");
        } 
    }

    public function edit($id=null, $aksi=null){
        $v['judul'] = "Sunting Pengumuman";
        if ($id!=null) {
            if ($aksi=="simpan") {
                if ($_POST) {
                    $this->mpengumuman->uppengumuman($id);
                }
                redirect("admin/pengumuman");
            } else {
                $v['data1'] = $this->mpengumuman->getpengumumanby_id($id);
				$v['data3'] = $this->mprogram->getprogramby();
				$v['data4'] = $this->mkonfig->qGetSetting('sampel_surat');
                $v['content'] = "admin/pengumuman_baru";
                $this->global_view($v);
            }
        } else {
            redirect("admin/pengumuman");
        }
    }
	
	public function cetak($id=null){
        $v['judul'] = "Surat Pengumuman";
        if ($id!=null) {
			$dt=$this->mrekomendasi->getrekomendasi_byid($id,"surat");
			$format=$this->mpengumuman->getpengumumanby_id($dt[0]->png_id,$dt[0]->kd_jenis_beasiswa);
			$no_surat=isset($id) && isset($dt[0]->jalur_pendaftaran) && isset($dt[0]->rekomendasi) || isset($dt[0]->no_surat) || isset($dt[0]->png_id)  ? $this->mrekomendasi->upnosurat($id,$dt[0]->jalur_pendaftaran,$dt[0]->rekomendasi,$dt[0]->no_surat,$dt[0]->png_id) : "-";
			$data['surat']= isset($format[0]->png_terima) && isset($dt[0]->rekomendasi) && isset($format[0]->png_tolak)  ? ($dt[0]->rekomendasi=="diterima" ? $format[0]->png_terima : $format[0]->png_tolak) : ""   ;
            $data['dt']=$dt;
			$data['no_surat']=$no_surat;
			$this->load->view('admin/cetak/surat_terima',$data);
        } else {
            redirect("admin/pengumuman");
        }
    }
	
	public function cetak_amplop($id=null){
        $v['judul'] = "Amplop Surat Pengumuman";
        if ($id!=null) {
			$dt=$this->mrekomendasi->getrekomendasi_byid($id,"surat");
			$format=$this->mpengumuman->getpengumumanby_id($dt[0]->png_id);
			isset($id) ? $this->mrekomendasi->upcetakamplop($id) : "-";
			$data['surat']= isset($format[0]->png_amplop)  ? $format[0]->png_amplop :""   ;
            $data['dt']=$dt;
			$this->load->view('admin/cetak/surat_amplop',$data);
        } else {
            redirect("admin/pengumuman");
        }
    }

    public function page($id=1){
        $v = $this->init($id);
        $v['content'] = "admin/pengumuman";
        $this->global_view($v);
    }

    private function refresh(){
        $v = $this->init(1);
        $data = $v['data1'];
        if ($data!=null) {
            foreach ($data as $row) {
                $sts = $row->status;
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="png_'.$row->png_id.'" value="'.$row->png_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/pengumuman/edit/'.$row->png_id.'" title="Click to edit">'.$row->png_judul.'</a></strong></td>';
                echo '<td><a href="'.base_url().index_page().'pengumuman/'.$row->png_link.'" target="_blank">'.base_url().index_page().'pengumuman/'.$row->png_link.'</a></td>';
                echo '<td>'.($row->png_tgl==null?"Belum Dipublish": date_format(date_create($row->png_tgl),"d M Y \p\u\k\u\l H:i:s")).'</td>';
                echo '<td class="text-center"><span class="label label-'.($sts?'success':'default').'"><i class="fa fa-'.($sts?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="5" class="danger text-center"><strong>Tidak ditemukan pengumuman</strong></td>';
            echo '</tr>';
        }
    }

    // ajax publish
    public function publish(){
        $id=$this->input->post('id');
        $ket = $this->input->post('ket');
        $ex = explode("|", $id);
        for ($i=0; $i < count($ex); $i++) { 
            if ($ex[$i]!="") {
                $this->mpengumuman->setpublish($ex[$i],$ket);
            }
        }
        $this->refresh();
    }

    // ajax hapus
    public function hapus(){
        $id=$this->input->post('id');
        $ex = explode("|", $id);
        for ($i=0; $i < count($ex); $i++) { 
            if ($ex[$i]!="") {
                $this->mpengumuman->delpengumuman($ex[$i]);
            }
        }
        $this->refresh();
    }

    // ajax get page all / published
    public function getpengumuman(){
        $tgl = $this->input->post('tgl');
        $key = $this->input->post('key');
        $ket = $this->input->post("sts");
        $filter = $tgl.'&'.$key.'&'.$ket;
        $this->session->set_userdata('filter_png', $filter);

        $v = $this->init(1);
        $data = $v['data1'];
        echo '<div class="col-sm-12">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th class="text-center" width="50"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                        <th>Judul Pengumuman</th>
                        <th>Link</th>
                        <th>Tanggal Publish</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>';
        if ($data!=null) {
            foreach ($data as $row) {
                $sts = $row->status;
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="png_'.$row->png_id.'" value="'.$row->png_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/pengumuman/edit/'.$row->png_id.'" title="Click to edit">'.$row->png_judul.'</a></strong></td>';
                echo '<td><a href="'.base_url().index_page().'pengumuman/'.$row->png_link.'" target="_blank">'.base_url().index_page().'pengumuman/'.$row->png_link.'</a></td>';
                echo '<td>'.($row->png_tgl==null?"Belum Dipublish": date_format(date_create($row->png_tgl),"d M Y \p\u\k\u\l H:i:s")).'</td>';
                echo '<td class="text-center"><span class="label label-'.($sts?'success':'default').'"><i class="fa fa-'.($sts?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="5" class="danger text-center"><strong>Tidak ditemukan pengumuman</strong></td>';
            echo '</tr>';
        }
        echo '</tbody>
                <tfoot>
                    <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Judul Pengumuman</th>
                    <th>Link</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Status</th>
                    </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <div class="col-sm-12 text-center">
        <ul class="pagination pagination-sm">
          '.$this->pagination->create_links().'
        </ul>
        </div>';
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
        $config['next_tag_open'] = '<li data-toggle="tooltip" data-placement="top" title="pengumuman Selanjutnya">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-chevron-left" title="pengumuman Sebelumnya"></i>';
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
            "user"      => $v['user'],
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
