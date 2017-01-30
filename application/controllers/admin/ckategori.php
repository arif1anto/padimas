<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckategori extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mkategori','mlogin'));
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
        $key = $this->session->userdata('filter');
        $url ='admin/kategori/page';
        $v['data2'] = $this->mpage->getcbbulan();
        if(!empty($key)) {
            $totrows = $this->mpage->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpage->getpageby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter');
            $totrows = $this->mpage->getpage();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpage->getpageby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    public function index(){
        $v = $this->initpage(1);
        $v['judul'] = "Halaman";
        $this->session->unset_userdata('filter');
        $v['content'] = "admin/page";
        $this->global_view($v);
    }

    public function baru($aksi=null){
        $v['judul'] = "Halaman Baru";
        $user = $this->session->userdata("user");
        $v['user'] = $this->mlogin->getauthorby_uname($user);
        if ($aksi=="simpan") {
            if ($_POST) {
                $kat_id = $this->input->post("kat");
                $id = $this->input->post('id')+1;
                $cek = $this->mpage->getpageby_id($id);
                if (count($cek)==0) {
                    $this->mpage->inpage($user);
                } else {
                    $this->mpage->uppage($id,$user);
                }
            }  
            redirect("admin/halaman");  
        } else {
            $v['data2'] = $this->mpage->getmaxid();
            $v['content'] = "admin/page_baru";

            $this->global_view($v);
        }
    }

    public function cari(){
        if ($_POST) {
            $tgl = $this->input->post('tgl');
            $key = $this->input->post('key');
            $ket = $this->input->post('page_all');
            $filter = $tgl.'&'.$key.'&'.$ket;
            $this->session->set_userdata('filter', $filter);
            $v = $this->initpage(1);
            $v['content'] = "admin/page";
            $this->global_view($v);
        } else {
            redirect("admin/halaman");
        } 
    }

    public function edit($id=null, $aksi=null){
        $v['judul'] = "Sunting Halaman";
        $user = $this->session->userdata("user");
        $v['user'] = $this->mlogin->getauthorby_uname($user);
        if ($id!=null) {
            if ($aksi=="simpan") {
                if ($_POST) {
                    $kat_id = $this->input->post("kat");
                    $this->mpage->uppage($id,$user);
                }
                redirect("admin/halaman");
            } else {
                $v['data1'] = $this->mpage->getpageby_id($id);
                $v['content'] = "admin/page_baru";
                $this->global_view($v);
            }
        } else {
            redirect("admin/halaman");
        }
    }

    public function page($id=1){
        $v = $this->initpage($id);
        $v['content'] = "admin/page";
        $this->global_view($v);
    }

    private function refresh(){
        $v = $this->initpage(1);
        $data = $v['data1'];
        foreach ($data as $row) {
            $sts = $row->status;
            echo '<tr>';
            echo '<td class="text-center"><input  type="checkbox" name="page_'.$row->page_id.'" value="'.$row->page_id.'"></td>';
            echo '<td><strong><a href="'.base_url().index_page().'admin/halaman/edit/'.$row->page_id.'" title="Click to edit">'.$row->page_judul.'</a></strong></td>';
            echo '<td><a href="'.base_url().index_page().'halaman/'.$row->page_link.'" target="_blank">'.base_url().index_page().'halaman/'.$row->page_link.'</a></td>';
            echo '<td><a href="'.base_url().index_page().'admin/halaman/author/'.$row->aut_username.'">'.$row->aut_display_name.'<a/></td>';
            echo '<td>'.($row->page_tgl==null?"Belum Dipublish": date_format(date_create($row->page_tgl),"d M Y \p\u\k\u\l H:i:s")).'</td>';
            echo '<td class="text-center"><span class="label label-'.($sts==1?'success':'default').'"><i class="fa fa-'.($sts==1?'check':'times').'"></i></span></td>';
            echo '</tr>';
        }
    }

    // ajax simpandraft
    public function simpandraft(){
        //cek id
        $user = $this->session->userdata("user");
        $id = $this->input->post("id")+1;
        $cek = $this->mpage->getpageby_id($id);
        if (count($cek)==0) {
            $this->mpage->inpage($user);
        } else {
            $this->mpage->uppage($id,$user);
        }
        echo "<small>Terakhir disimpan ".date_format(new datetime(),"d/m/y H:i:s")."</small>";
    }

    // ajax publish
    public function publish(){
        $id=$this->input->post('id');
        $ket = $this->input->post('ket');
        $ex = explode("|", $id);
        for ($i=0; $i < count($ex); $i++) { 
            if ($ex[$i]!="") {
                $this->mpage->setpublish($ex[$i],$ket);
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
                $this->mpage->delpage($ex[$i]);
            }
        }
        $this->refresh();
    }

    // ajax get page all / published
    public function getpage(){
        $tgl = $this->input->post('tgl');
        $key = $this->input->post('key');
        $ket = $this->input->post("sts");
        $filter = $tgl.'&'.$key.'&'.$ket;
        $this->session->set_userdata('filter', $filter);

        $v = $this->initpage(1);
        $data = $v['data1'];
        echo '<div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Judul Halaman</th>
                    <th>Link</th>
                    <th>Author</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>';
        if ($data!=null) {
            foreach ($data as $row) {
                $sts = $row->status;
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="page_'.$row->page_id.'" value="'.$row->page_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/halaman/edit/'.$row->page_id.'" title="Click to edit">'.$row->page_judul.'</a></strong></td>';
                echo '<td><a href="'.base_url().index_page().'halaman/'.$row->page_link.'" target="_blank">'.base_url().index_page().'halaman/'.$row->page_link.'</a></td>';
                echo '<td><a href="'.base_url().index_page().'admin/halaman/author/'.$row->aut_username.'">'.$row->aut_display_name.'<a/></td>';
                echo '<td>'.($row->page_tgl==null?"Belum Dipublish": date_format(date_create($row->page_tgl),"d M Y \p\u\k\u\l H:i:s")).'</td>';
                echo '<td class="text-center"><span class="label label-'.($sts==1?'success':'default').'"><i class="fa fa-'.($sts==1?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="6" class="danger text-center"><strong>Tidak ditemukan halaman</strong></td>';
            echo '</tr>';
        }
        echo '</tbody>
                <tfoot>
                    <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Judul Halaman</th>
                    <th>Link</th>
                    <th>Author</th>
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
