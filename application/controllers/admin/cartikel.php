<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cartikel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('martikel','mkategori','mlogin'));
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

    private function getkategori($art_id=null){
        //parent 0
        $i=0;
        $datakat = null;
        $data = $this->martikel->getartikel_kat($art_id);
        $kat = $this->mkategori->getkategoriby_parent(0);
        foreach ($kat as $row) {
            //cek selected kategori
            if ($art_id==null) {
                $datakat[$i] = array('kat_id'   => $row->kat_id,
                                     'kat_nama' => $row->kat_nama,
                                     'kat_link' => $row->kat_link,
                                     'kat_level'=> "kat-level-0",
                                     'kat_sel'  => "");
            } else {
                $sel = "";
                foreach ($data as $kate) {
                    if ($kate->kat_id==$row->kat_id) {
                        $sel = "checked";
                    }
                }
                $datakat[$i] = array('kat_id'   => $row->kat_id,
                                     'kat_nama' => $row->kat_nama,
                                     'kat_link' => $row->kat_link,
                                     'kat_level'=> "kat-level-0",
                                     'kat_sel'  => $sel);
            }
            //sub level 1
            $kat1 = $this->mkategori->getkategoriby_parent($row->kat_id);
            foreach ($kat1 as $row1) {
                $i++;
                //cek selected kategori
                if ($art_id==null) {
                    $datakat[$i] = array('kat_id'   => $row1->kat_id,
                                         'kat_nama' => $row1->kat_nama,
                                         'kat_link' => $row1->kat_link,
                                         'kat_level'=> "kat-level-1",
                                         'kat_sel'  => "");
                } else {
                    $sel = "";
                    foreach ($data as $kate1) {
                        if ($kate1->kat_id==$row1->kat_id) {
                            $sel = "checked";
                        }
                    }
                    $datakat[$i] = array('kat_id'   => $row1->kat_id,
                                         'kat_nama' => $row1->kat_nama,
                                         'kat_link' => $row1->kat_link,
                                         'kat_level'=> "kat-level-1",
                                         'kat_sel'  => $sel);
                }
                //sub level 2
                $kat2 = $this->mkategori->getkategoriby_parent($row1->kat_id);
                foreach ($kat2 as $row2) {
                    $i++;
                    //cek selected kategori
                    if ($art_id==null) {
                        $datakat[$i] = array('kat_id'   => $row2->kat_id,
                                             'kat_nama' => $row2->kat_nama,
                                             'kat_link' => $row2->kat_link,
                                             'kat_level'=> "kat-level-2",
                                             'kat_sel'  => "");
                    } else {
                        $sel = "";
                        foreach ($data as $kate2) {
                            if ($kate2->kat_id==$row2->kat_id) {
                                $sel = "checked";
                            }
                        }
                        $datakat[$i] = array('kat_id'   => $row2->kat_id,
                                             'kat_nama' => $row2->kat_nama,
                                             'kat_link' => $row2->kat_link,
                                             'kat_level'=> "kat-level-2",
                                             'kat_sel'  => $sel);
                    }
                    //sub level 3
                    $kat3 = $this->mkategori->getkategoriby_parent($row2->kat_id);
                    foreach ($kat3 as $row3) {
                        $i++;
                        //cek selected kategori
                        if ($art_id==null) {
                            $datakat[$i] = array('kat_id'   => $row3->kat_id,
                                                 'kat_nama' => $row3->kat_nama,
                                                 'kat_link' => $row3->kat_link,
                                                 'kat_level'=> "kat-level-3",
                                                 'kat_sel'  => "");
                        } else {
                            $sel = "";
                            foreach ($data as $kate3) {
                                if ($kate3->kat_id==$row3->kat_id) {
                                    $sel = "checked";
                                }
                            }
                            $datakat[$i] = array('kat_id'   => $row3->kat_id,
                                                 'kat_nama' => $row3->kat_nama,
                                                 'kat_link' => $row3->kat_link,
                                                 'kat_level'=> "kat-level-3",
                                                 'kat_sel'  => $sel);
                        }
                    }
                }
            }
            $i++;
        }
        return $datakat;
    }

    public function index(){
        $v = $this->initpage(1);
        $v['judul'] = "Artikel";
        $this->session->unset_userdata('filter_artikel');
        $v['content'] = "admin/artikel";
        $this->global_view($v);
    }

    private function simpan_kategori($art_id=null, $kat_id=null){
        if ($art_id!=null && $kat_id!=null) {
            $this->martikel->delartikel_kat($art_id);
            foreach ($kat_id as $row) {
                $this->martikel->inartikel_kat($art_id,$row);
            }
        }
    }

    public function baru($aksi=null){
        $v['judul'] = "Artikel Baru";
        $user = $this->session->userdata("user");
        $v['user'] = $this->mlogin->getauthorby_uname($user);
        if ($aksi=="simpan") {
            if ($_POST) {
                $kat_id = $this->input->post("kat");
                $id = $this->input->post('id')+1;
                $cek = $this->martikel->getartikelby_id($id);
                if (count($cek)==0) {
                    $this->martikel->inartikel($user);
                } else {
                    $this->martikel->upartikel($id,$user);
                }
                $this->simpan_kategori($id,$kat_id);
            }  
            redirect("admin/artikel");  
        } else {
            $v['data2'] = $this->martikel->countheadline()<5?"checked":"";
            $v['data3'] = $this->martikel->getmaxid();
            $v['data4'] = $this->getkategori();
            $v['content'] = "admin/artikel_baru";

            $this->global_view($v);
        }
    }

    public function cari(){
        if ($_POST) {
            $tgl = $this->input->post('tgl');
            $kat = $this->input->post('kat');
            $key = $this->input->post('key');
            $ket = $this->input->post('art_all');
            $filter = $tgl.'&'.$kat.'&'.$key.'&'.$ket;
            $this->session->set_userdata('filter_artikel', $filter);
            $v = $this->initpage(1);
            $v['content'] = "admin/artikel";
            $this->global_view($v);
        } else {
            redirect("admin/artikel");
        } 
    }

    public function edit($id=null, $aksi=null){
        $v['judul'] = "Sunting Artikel";
        $user = $this->session->userdata("user");
        $v['user'] = $this->mlogin->getauthorby_uname($user);
        if ($id!=null) {
            if ($aksi=="simpan") {
                if ($_POST) {
                    $kat_id = $this->input->post("kat");
                    $this->martikel->upartikel($id,$user);
                    $this->simpan_kategori($id,$kat_id);
                }
                redirect("admin/artikel");
            } else {
                $v['data1'] = $this->martikel->getartikelby_id($id);
                $v['data2'] = $this->martikel->countheadline()<5?"checked":"";
                $v['data4'] = $this->getkategori($id);
                $v['content'] = "admin/artikel_baru";
                $this->global_view($v);
            }
        } else {
            redirect("admin/artikel");
        }
    }

    public function page($id=1){
        $v = $this->initpage($id);
        $v['content'] = "admin/artikel";
        $this->global_view($v);
    }

    public function kategori($link){
        echo "Artikel dengan kategori = ".$link;
    }

    private function initpage($id=1){
        $key = $this->session->userdata('filter_artikel');
        $url ='admin/artikel/page';
        $v['data2'] = $this->martikel->getcbbulan();
        $v['data3'] = $this->mkategori->getcbkategori();
        if(!empty($key)) {
            $totrows = $this->martikel->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->martikel->getartikelby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter_artikel');
            $totrows = $this->martikel->getartikel();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->martikel->getartikelby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    private function refresh(){
        $v = $this->initpage(1);
        $data = $v['data1'];
        if ($data!=null) {
            foreach ($data as $row) {
                $sts = $row->status;
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="art_'.$row->art_id.'" value="'.$row->art_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/artikel/edit/'.$row->art_id.'" title="Click to edit">'.$row->art_judul.'</a></strong></td>';
                echo '<td>'."<a href='".base_url().index_page()."admin/artikel/author/".$row->aut_username."'>".$row->aut_display_name."<a/>".'</td>';
                echo '<td>'.($kat==null?"<a href='".base_url().index_page()."admin/artikel/kategori/belum_dikategorikan'>Belum Dikategorikan<a/>":$kat).'</td>';
                echo '<td>'.$tag.'</td>';
                echo '<td>'.($row->art_tgl_terbit==null?"Belum Dipublish": date_format(date_create($row->art_tgl_terbit),"d M Y \p\u\k\u\l H:i:s")).'</td>';
                echo '<td class="text-center"><span class="label label-'.($row->art_headline?'success':'default').'"><i class="fa fa-'.($row->art_headline?'check':'times').'"></i></span></td>';
                echo '<td class="text-center"><span class="label label-'.($sts?'success':'default').'"><i class="fa fa-'.($sts?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="8" class="danger text-center"><strong>Tidak ditemukan artikel</strong></td>';
            echo '</tr>';
        }
    }

    // ajax tambah kategori
    public function tambah_kategori(){
        $this->mkategori->addkategori();
        $data = $this->getkategori();
        $i = 0;
        echo '<div class="checkbox">
              <label>
                <input type="checkbox" name="kat[0]" value="0" form="artikel">
                Belum Dikategorikan
              </label>
            </div>';
        for ($i=0; $i<count($data); $i++){
        echo '<div class="checkbox '.$data[$i]['kat_level'].'">
              <label>
                <input type="checkbox" name="kat[.'.$i.']" value="'.$data[$i]['kat_id'].'" form="artikel">
                '.$data[$i]['kat_nama'].'
              </label>
            </div>';
        }
    }

    // ajax simpandraft
    public function simpandraft(){
        //cek id
        $id = $this->input->post("id")+1;
        $cek = $this->martikel->getartikelby_id($id);
        if (count($cek)==0) {
            $this->martikel->inartikel('admin');
        } else {
            $this->martikel->upartikel($id,'admin');
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
                $this->martikel->setpublish($ex[$i],$ket);
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
                $this->martikel->delartikel($ex[$i]);
            }
        }
        $this->refresh();
    }

    // ajax get artikel all / published
    public function getartikel(){
        $tgl = $this->input->post('tgl');
        $kat = $this->input->post('kat');
        $key = $this->input->post('key');
        $ket = $this->input->post("sts");
        $filter = $tgl.'&'.$kat.'&'.$key.'&'.$ket;
        $this->session->set_userdata('filter_artikel', $filter);

        $v = $this->initpage(1);
        $data = $v['data1'];
        echo '<div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onclick="pilih($(this))"></th>
                    <th>Judul Artikel</th>
                    <th>Authors</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Headline</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>';
        if ($data!=null) {
            foreach ($data as $row) {
                $sts = $row->status;
                $kats = $row->kategoris;
                $tag = $row->tags;
                echo '<tr>';
                echo '<td class="text-center"><input  type="checkbox" name="art_'.$row->art_id.'" value="'.$row->art_id.'"></td>';
                echo '<td><strong><a href="'.base_url().index_page().'admin/artikel/edit/'.$row->art_id.'" title="Click to edit">'.$row->art_judul.'</a></strong></td>';
                echo '<td>'."<a href='".base_url().index_page()."admin/artikel/author/".$row->aut_username."'>".$row->aut_display_name."<a/>".'</td>';
                echo '<td>'.($kats==null?"<a href='".base_url().index_page()."admin/artikel/kategori/belum_dikategorikan'>Belum Dikategorikan<a/>":$kats).'</td>';
                echo '<td>'.$tag.'</td>';
                echo '<td>'.($row->art_tgl_terbit==null?"Belum Dipublish": date_format(date_create($row->art_tgl_terbit),"d M Y \p\u\k\u\l H:i:s")).'</td>';
                echo '<td class="text-center"><span class="label label-'.($row->art_headline?'success':'default').'"><i class="fa fa-'.($row->art_headline?'check':'times').'"></i></span></td>';
                echo '<td class="text-center"><span class="label label-'.($sts?'success':'default').'"><i class="fa fa-'.($sts?'check':'times').'"></i></span></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="8" class="danger text-center"><strong>Tidak ditemukan artikel</strong></td>';
            echo '</tr>';
        }
        echo '</tbody>
                <tfoot>
                    <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onclick="pilih($(this))"></th>
                    <th>Judul Artikel</th>
                    <th>Authors</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Headline</th>
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

        isset($v['active'])  ? $v['active'] : $v['active'] 	= null;
        isset($v['judul'])   ? $v['judul']  : $v['judul'] 	= null;
        isset($v['menu'])    ? $v['menu'] 	: $v['menu'] 	= null;
        isset($v['content']) ? $v['content']: $v['content'] = null;
        isset($v['user'])   ? $v['user']  : $v['user']   = null;
        isset($v['data1'])   ? $v['data1'] 	: $v['data1'] 	= null;
        isset($v['data2']) 	 ? $v['data2'] 	: $v['data2'] 	= null;
        isset($v['data3']) 	 ? $v['data3'] 	: $v['data3'] 	= null;
        isset($v['data4']) 	 ? $v['data4'] 	: $v['data4'] 	= null;
        isset($v['data5'])   ? $v['data5']  : $v['data5']   = null;
        isset($v['sfilter']) ? $v['sfilter']: $v['sfilter'] = null;
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
            "user"     => $v['user'],
            "data1" 	=> $v['data1'],
            "data2" 	=> $v['data2'],
            "data3" 	=> $v['data3'],
            "data4" 	=> $v['data4'],
            "data5"     => $v['data5'],
            "sfilter" 	=> $v['sfilter'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
