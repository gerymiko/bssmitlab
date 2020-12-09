<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysvacancy extends CI_Controller {

        function __construct() {
            parent::__construct();
			if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model(['mloker/mod_karir_loker']);
        }

        public function index(){        
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/account/grid/vmenu',
                'content' => 'pages/pvacancy/vloker',
                'footer'  => 'pages/account/grid/vfooter',
                'total_loker' => $this->mod_karir_loker->count_all() - 1,
        	);
        	$this->load->view('pages/account/index', $data);
        }

        private static function _generate_url($surl){
            return file_get_contents('http://tinyurl.com/api-create.php?url='.$surl);
        }

        public function table_loker(){
            $loker = $this->mod_karir_loker->get_datatables();
            $data  = array();
            $no    = $this->security->xss_clean($this->input->post('start'));
           
            foreach ($loker as $field) {
                $today    = date_create($this->security->xss_clean($field->tgl_open));
                $title    = str_replace(" ", "", $this->security->xss_clean($field->jabatan_alias));
                $string   = html_entity_decode($title);
                $subtitle = preg_replace("/&/",'',$string);
                date_add($today,date_interval_create_from_date_string("14 days"));
                $harini    = date_format($today,"Y-m-d");
                if ($harini >= date("Y-m-d")) {
                    $label = '<button class="btn btn-xs btn-danger pull-right"><i class="fa fa-tags"></i> Terbaru</button>';
                    $class = 'style="border: 2px solid #002F65;"';
                } else {
                    $label = '';
                    $class = '';
                }
                $id      = $this->encrypt->encode($this->security->xss_clean($field->lowongan_id));
                $title   = 'Lowongan pekerjaan PT BINA SARANA SUKSES - '.$this->security->xss_clean($field->jabatan_alias) ;
                $summary = 'Lowongan pekerjaan untuk posisi '.$this->security->xss_clean($field->jabatan_alias);
                $image   = 'https://web.binasaranasukses.com/karir/s_url/logo_mobile';
                $url     = site_url('vacancy/detail/'.$id.'/'.strtolower($subtitle));

                $fb      = 'https://www.facebook.com/sharer.php?s=100&p[title]='.$title.';&p[summary]='.$summary.'&p[url]='.$this->_generate_url($url).'&&p[images][0]='.$image.'';
                $tw      = 'https://twitter.com/share?source=sharethiscom&text='.$title.'&url='.$this->_generate_url($url).'&via=web.binasaranasukses.com';
                $in      = 'https://www.linkedin.com/shareArticle?mini=true&url='.$this->_generate_url($url).'&title='.$title.'&summary='.$summary.'&source=web.binasaranasukses.com';

                $no++;
                $row    = array();
                $row[]  = '
                    <a target="_blank" href="'.$url.'">
                        <div class="panel-default boxeshad nobottommargin" '.$class.'>
                            <div class="panel-body">
                                <div class="fancy-title" style="margin-bottom: 5px">
                                    <h5 class="title ls3">'.$this->security->xss_clean($field->jabatan_alias).'</h5>
                                    <div class="pull-right black">. . .</div>
                                </div>
                                <div class="heading-line nobottommargin">
                                    <p class="nobottommargin title gray f13 ls1">
                                        <i class="far fa-clock f14" style="color: #1883E9;padding-right: 5px;"></i>
                                        Dipublikasikan pada tanggal : '.date("d/m/Y", strtotime($this->security->xss_clean($field->tgl_open))).''.$label.'
                                    </p>
                                    <p class="nobottommargin title black ls1">
                                        '.strip_tags(html_entity_decode(substr($this->security->xss_clean($field->job_desc), 0, 150))).' . . .
                                    </p>
                                    <p class="nobottommargin black ls1">Berbagi ke :
                                        <a class="btn btn-xs btn-primary" onClick="pop_twitter(\''.$fb.'\');" target="_parent" href="javascript: void(0)">
                                            <i class="icon-facebook f11" style="padding-right: 2px;padding-left: 2px;"></i>
                                        </a>
                                        <a class="btn btn-xs btn-cyan" onClick="pop_twitter(\''.$tw.'\');" target="_parent" href="javascript: void(0)">
                                            <i class="icon-twitter f7"></i>
                                        </a>
                                        <a class="btn btn-xs btn-primary" onClick="pop_linkedin(\''.$in.'\');" target="_parent" href="javascript: void(0)">
                                            <i class="icon-linkedin f9"></i>
                                        </a>
                                    </p> 
                                </div>
                            </div>
                        </div>
                    </a>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->security->xss_clean($this->input->post('draw')),
                "recordsTotal"    => $this->mod_karir_loker->count_all(),
                "recordsFiltered" => $this->mod_karir_loker->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>