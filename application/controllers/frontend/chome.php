<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','session','Pagination','encrypt','mathcaptcha'));
        $this->load->database();
        $this->load->model(array('martikel','mpage','mpengumuman','mmenu','mprogram','mpendaftar','mrekomendasi','mlogin'));
        //$this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
         $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
         $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
         $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
         $this->output->set_header('Pragma: no-cache');
    }

	public function index(){
        $this->session->unset_userdata('filter');
        $v = $this->initpage(1);
        $v['content'] = "frontend/home_artikel";
        $this->global_view($v);
	}

    public function landing(){
        $program = $this->mprogram->getprogram()
                  ->get()
                  ->result();
        $data["program"] = $program;
        $this->load->view('frontend/landingpage',$data);
    }

    public function halaman($link=null){
        $v['content'] = "frontend/halaman";
        $v['data1'] = $this->mpage->getpageby_link($link);
        //cek halaman tidak ditemukan atau status telah dipublish
        if (count($v['data1'])>0) {
            $v['judul'] = $v['data1'][0]->page_judul;
            $this->global_view($v);
        } else { 
            $v = $this->inithalaman(1);
	        $v['content'] = "frontend/home_halaman";
	        $this->global_view($v);
        }
    }

    public function pengumuman($link=null,$param=null,$id=null,$err=null){
        $v['data1'] = $this->mpengumuman->getpengumumanby_link($link);
        //cek pengumuman tidak ditemukan atau status telah dipublish
		$pgjump=$this->session->userdata("pgjump");
		$iddok=$this->session->userdata("id");
        if($param=="cetak" && $pgjump==2 && $id!=null && $_POST){
			$pass= $this->security->xss_clean(trim($this->input->post('sandi')));
			$cek=$this->mlogin->unduh($id,$pass);
			if($cek==true){
				$this->session->set_userdata("pgjump",3);
				$this->session->set_userdata("id",$id);
				redirect("pengumuman/".$link."/cetak");
			}
			else {
				$this->session->set_userdata("pgjump",1);
				redirect("pengumuman/".$link."/cetak/".$id."/error");
			}
				
		} 
		else if ($param=="cetak" && $pgjump==3){
			$this->session->set_userdata("pgjump",4);
			$dt=$this->mrekomendasi->getrekomendasi_byid($iddok,"surat");
			$format=$this->mpengumuman->getpengumumanby_id($dt[0]->png_id,$dt[0]->kd_jenis_beasiswa);
			$no_surat=isset($iddok) && isset($dt[0]->jalur_pendaftaran) && isset($dt[0]->rekomendasi) || isset($dt[0]->no_surat) || isset($dt[0]->png_id)  ? $this->mrekomendasi->upnosurat($iddok,$dt[0]->jalur_pendaftaran,$dt[0]->rekomendasi,$dt[0]->no_surat,$dt[0]->png_id) : "-";
			$data['surat']= isset($format[0]->png_terima) && isset($dt[0]->rekomendasi) && isset($format[0]->png_tolak)  ? ($dt[0]->rekomendasi=="diterima" ? $format[0]->png_terima : $format[0]->png_tolak) : ""   ;
			$data['dt']=$dt;
			$data['no_surat']=$no_surat;
			$data['link'] =$link;
			$this->load->view('frontend/cetak/surat_terima',$data);
		}
		else if($param=="cetakpdf" && $pgjump==4){
			$this->load->helper(array('dompdf', 'file'));
			$dt=$this->mrekomendasi->getrekomendasi_byid($iddok,"surat");
			$format=$this->mpengumuman->getpengumumanby_id($dt[0]->png_id,$dt[0]->kd_jenis_beasiswa);
			$no_surat=isset($iddok) && isset($dt[0]->jalur_pendaftaran) && isset($dt[0]->rekomendasi) || isset($dt[0]->no_surat) || isset($dt[0]->png_id)  ? $this->mrekomendasi->upnosurat($iddok,$dt[0]->jalur_pendaftaran,$dt[0]->rekomendasi,$dt[0]->no_surat,$dt[0]->png_id) : "-";
			$data['surat']= isset($format[0]->png_terima) && isset($dt[0]->rekomendasi) && isset($format[0]->png_tolak)  ? ($dt[0]->rekomendasi=="diterima" ? $format[0]->png_terima : $format[0]->png_tolak) : ""   ;
			$data['dt']=$dt;
			$data['no_surat']=$no_surat;
			$this->session->unset_userdata("pgjump");
			$this->session->unset_userdata("id");
			$output = $this->load->view('frontend/cetak/surat_terima_pdf',$data,true);
			 $filename 	= "PENGUMUMAN_PMB-".$dt[0]->nama.".pdf";
			 pdf_create($output, $filename);
		
		}
		else if (count($v['data1'])>0 && $v['data1'][0]->status) {
            $v['judul'] = $v['data1'][0]->png_judul;
			$this->session->set_userdata("pgjump",1);
			if($param=="tabel"){
				if($id!=null)
					$page=$id;
				else
					$page=1;
				$url='pengumuman/'.$link."/tabel";
				$jml=$this->mrekomendasi->getrekomendasi_bypngid($v['data1'][0]->png_id,null,$v['data1'][0]->prg_id,null,null,"mhs");
				if(isset($v['data1'][0]->png_tabel) && $v['data1'][0]->png_tabel!=null){
				   $table='
						<div class="table-responsive">
						  <table class="table table-hover table-bordered table-striped" >
							<thead style="background-color:#252525;color:#fff;font-weight:bold;">
							  <tr>
								<th rowspan="2" class="text-center" width="5%">Aksi</th>
								<th rowspan="2" class="text-center">No</th>
								<th rowspan="2" class="text-center">Nama</th>
								<th rowspan="2" class="text-center">Asal Sekolah</th>
								<th colspan="3" class="text-center">Diterima Pada</th>
							  </tr>
							  <tr>
								<th class="text-center">Program Studi</th>
								<th class="text-center">Jenjang</th>
								<th class="text-center">Fakultas</th>
							   </tr>
								
							</thead>
							<tbody>
									';
							if($jml->num_rows()>0){		
								$set = $this->paging($page,$jml->num_rows(),$url);
								$data=$this->mrekomendasi->getrekomendasi_bypngid($v['data1'][0]->png_id,null,$v['data1'][0]->prg_id,$set['confpage'],$set['idpage'],"mhs");
								empty($set['idpage']) ? $no=0 : $no=$set['idpage'] ;							
								foreach($data as $r) {
									$table.=
									'<tr>
										<td class="text-center"><a class="btn btn-group btn-primary btn-xs" href="'.base_url().index_page()."pengumuman/".$v['data1'][0]->png_link."/cetak/".$r->id_rekomendasi.'"><i class="fa fa-print"></i> Cetak</a></td>
										<td class="text-center">'.++$no.'</td>
										<td>'.$r->nama.'</td>
										<td>'.$r->sklh.'</td>
										<td class="text-center">'.$r->jurusan.'</td>
										<td class="text-center">'.$r->jenjang.'</td>
										<td class="text-center">'.$r->fakultas.'</td>
									</tr>';
								}
							}else 
								$table.='<tr><td colspan="7" class="text-center">Tidak Ada Data</td></tr>';
									
					$table.='</tbody>
						  </table>
						</div>
						<ul class="pagination pagination-md">
						  '.$this->pagination->create_links().'
						</ul>';

					$v['data2']= $table;
					$v['content'] = "frontend/pengumuman_tabel";
				}
			}
			else if($param=="cetak" && $id!=null && $pgjump==1 ){
				$this->session->set_userdata("pgjump",2);
				$v["data2"]=$err;
				$v['content'] = "frontend/pengumuman_login";
			}else if ($pgjump<1){
				redirect("pengumuman/".$link);
			}
			else{
				$this->session->unset_userdata("pgjump");
				$this->session->unset_userdata("id");
				$v['content'] = "frontend/pengumuman";
			}
            $this->global_view($v);
        } else { 
			$this->session->unset_userdata("id");
            $v = $this->initpengumuman(1);
	        $v['content'] = "frontend/home_pengumuman";
	        $this->global_view($v);
            //show_404($link);
        }
		
		
    }
	private function paging($id=1,$totrows=null,$method=null){ 
		$config['base_url'] = site_url($method);
		$config['uri_segment']	= 4;
        $config['num_links']= 2;
        $config['per_page'] = 15; 
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
        $rkey=array('confpage' => $config['per_page'],'idpage' => $page);
        return $rkey;
    }
    public function program($link=null,$aksi=null){
        $v['data1'] = $this->mprogram->getprogramby_link($link);
		$config['question_format']='numeric';
		$config['answer_format']='numeric';
		$this->mathcaptcha->init($config);
        if ($aksi==null) {
            $v['content'] = "frontend/program";
        } elseif ($aksi=="daftar") {
            if ($v['data1'][0]->prg_form != null && $v['data1'][0]->status) {
                $v['content'] = "frontend/program_form";
				if($_POST){
					$capca=$this->security->xss_clean(trim($this->input->post('mumet')));
					$nis=$this->input->post("no_induk");
					$email=$this->input->post("email");
					$telp=$this->input->post("telp");
					$dt=array("nis" => $nis,"email" => $email,"telp"=>$telp);
					$cek=$this->mpendaftar->cekpendaftar($dt);
					if($cek==false && $this->mathcaptcha->check_answer($capca)==TRUE){
						$iddaftar=$this->mpendaftar->inpendaftar_bymaba($v['data1'][0]->prg_id);
						$this->session->set_userdata("id",$iddaftar);
						redirect('program/'.$link.'/cetak');
					}else if($cek==true && $this->mathcaptcha->check_answer($capca)==TRUE){
						$email = $cek->email;
						$e = explode('@',$email);
						
						$telp = $cek->telp;
						
						$l = strlen($telp);

						for($a=1; $a<=$l; $a++){
							switch($l){
								case 12 : $u = 8; break;
								case 11 : $u = 7; break;
								case 10 : $u = 6; break;
								case 9 : $u = 5; break;
								case 8 : $u = 4; break;
								default : $u = 0; break;
							}
						}
						$s = substr($telp,0,$u);
						$v['data2']='
							<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header" style="background-color:#ff4136; border-radius: 6px 6px 0 0; color: #fff;">
									  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <h4 class="modal-title" id="myModalLabel"><strong><i class="fa fa-exclamation-triangle fa-lg"></i> Gagal Melakukan Pendaftaran !</strong></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
										  <p>Saudara <b>"'.ucwords(strtolower($cek->nama)).'"</b> ternyata <b>sudah pernah</b> melakukan pendaftaran sebelumnya.</p>
											<p>Nomor pendaftaran saudara : <b>"'.$cek->id_daftar.'"</b>.</p>
											<p>Detail lainnya tentang pendaftaran saudara adalah sebagai berikut:
												<ul>
													<li>Email : ****@"'.$e[1].'"</li>
													<li>No Telp : "'.$s.'"****</li>
													<li>Asal Sekolah : "'.strtoupper($cek->nm_sklh).'"</li>
													<li>Waktu Pendaftaran : "'.date('d-m-Y H:i:s',strtotime($cek->tgl_daftar)).'"</li>
													<li>IP Komputer : "'.$cek->ip.'"</li>
												</ul>
											</p>
											<p>Apabila ada yang ingin ditanyakan kepada panitia, silakan hubungi kontak yang ada pada halaman <a href="'.base_url().index_page().'halaman/kontak">Kontak Panitia</a>.</p>
										</div>
										<div id="responnim" class="form-group text-center" ></div>
									</div>
									<div class="modal-footer" style="background-color:#ff4136; border-radius: 0 0 6px 6px; color: #fff;margin-top:0;">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
									</div>
								</div>
							  </div>
							</div>
						<script>$("#konfirmasi").modal();</script>
						';
					}
					else{
						$v['data2']='
						<script>$(".capca-salah").html("captcha salah");</script>
						';
					}
				}
            } else {
                show_404($link);
            }
        }
		if($aksi=="cetak"){
			$id=$this->session->userdata("id");
			if($id!=null){
				$v["dt"]=$this->mpendaftar->getpendaftar_byid2($id);
				$v["link"]=$link;
				$output = $this->load->view("frontend/program_konfirmasi",$v,false);	
			}
			else
				redirect('program/'.$link);
		}else if($aksi=="cetakpdf"){
			$id=$this->session->userdata("id");
			if($id!=null){
				$v["dt"]=$this->mpendaftar->getpendaftar_byid2($id);
				$this->load->helper(array('dompdf', 'file'));
				$filename 	= "BUKTI_PENDAFTARAN_PMB".$id.".pdf";
				$this->session->unset_userdata("id");
				$output = $this->load->view("frontend/program_konfirmasi_pdf",$v,true);
				pdf_create($output, $filename);
				
			}
			else
				redirect('program/'.$link);
		}
        else if (count($v['data1'])>0) {
			$v['data3'] = $this->mathcaptcha->get_question();
            $v['judul'] = $v['data1'][0]->prg_judul;
            $this->global_view($v);
        } else { 
            show_404($link);
        }
    }

    public function page($id=1){
        $v = $this->initpage($id);
        $v['content'] = "frontend/home_artikel";
        $this->global_view($v);
    }

	public function detail($link=null){
		$v['content'] = "frontend/detail";
        if ($link!=null) {
            $v['data1'] = $this->martikel->getartikelby_link($link);
        } else {
            $v['data1'] = null;
        }
        //cek artikel tidak ditemukan atau status telah dipublish
        if (count($v['data1'])>0 && $v['data1'][0]->status) {
            $v['judul'] = $v['data1'][0]->art_judul;
            $this->global_view($v);
        } else {
            show_404($link);
        }
	}

    private function initpage($id=1){
        $key = $this->session->userdata('filter');
        $url ='page';
        if(!empty($key)) {
            $totrows = $this->martikel->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->martikel->getartikelby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter');
            $totrows = $this->martikel->getartikel();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->martikel->getartikelby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    private function initpengumuman($id=1){
        $key = $this->session->userdata('filter_pengumuman');
        $url ='page';
        if(!empty($key)) {
            $totrows = $this->mpengumuman->getqby_flter($key);
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpengumuman->getpengumumanby_page($p['confpage'],$p['idpage'],$key);
            $v['idpage'] = $p['idpage'];
            $v['sfilter'] = $key;
        } else {
            $this->session->unset_userdata('filter_pengumuman');
            $totrows = $this->mpengumuman->getpengumuman();
            $p = $this->paging($id,$url,$totrows->get()->num_rows());
            $v['data1'] = $this->mpengumuman->getpengumumanby_page($p['confpage'],$p['idpage']);
            $v['idpage'] = $p['idpage'];
        }
        return $v;
    }

    private function inithalaman($id=1){
        $key = $this->session->userdata('filter');
        $url ='page';
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

	private function global_view($v) {
        $v['menu']      = $this->mmenu->getmenu_all();
        $v['program']   = $this->mprogram->getprogramby();
        $v['pengumuman']= $this->mpengumuman->getpengumumanby_pub();

        isset($v['active'])  ? $v['active'] : $v['active'] 	= null;
        isset($v['judul'])   ? $v['judul']  : $v['judul'] 	= null;
        isset($v['menu'])    ? $v['menu']   : $v['menu']    = null;
        isset($v['program']) ? $v['program']: $v['program'] = null;
        isset($v['pengumuman']) ? $v['pengumuman']: $v['pengumuman'] = null;
        isset($v['content']) ? $v['content']: $v['content'] = null;
        isset($v['data1'])   ? $v['data1'] 	: $v['data1'] 	= null;
        isset($v['data2']) 	 ? $v['data2'] 	: $v['data2'] 	= null;
        isset($v['data3']) 	 ? $v['data3'] 	: $v['data3'] 	= null;
        isset($v['data4']) 	 ? $v['data4'] 	: $v['data4'] 	= null;
        isset($v['data5']) 	 ? $v['data5'] 	: $v['data5'] 	= null;
        isset($v['idpage'])  ? $v['idpage'] : $v['idpage'] 	= null;

        if (!isset($v['judul'])) {
        	$v['judul'] = "Penerimaan Mahasiswa Baru";
        } else {
        	$v['judul'] = $v['judul']==''?"Penerimaan Mahasiswa Baru":$v['judul']." | PMB";
        }

        $data = array(
            "active" 	=> $v['active'],
            "judul" 	=> $v['judul'],
            "view" 		=> $v['content'],
            "menu"      => $v['menu'],
            "program"	=> $v['program'],
            "pengumuman"	=> $v['pengumuman'],
            "data1" 	=> $v['data1'],
            "data2" 	=> $v['data2'],
            "data3" 	=> $v['data3'],
            "data4" 	=> $v['data4'],
            "data5" 	=> $v['data5'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('index', $data);
    }
}
