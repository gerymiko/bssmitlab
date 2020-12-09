<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysvacancy extends CI_Controller {

        function __construct() {
            parent::__construct();
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

        public function table_loker(){
            $loker = $this->mod_karir_loker->get_datatables();
            $data  = array();
            $no    = $this->input->post('start');
           
            foreach ($loker as $field) {
                $today    = date_create($field->tgl_open);
                $title    = str_replace(" ", "", $field->jabatan_alias);
                $string   = html_entity_decode($title);
                $subtitle = preg_replace("/&/",'',$string);
                date_add($today,date_interval_create_from_date_string("14 days"));
                $harini = date_format($today,"Y-m-d");
                if ($harini >= date("Y-m-d")) {
                    $label = '<button class="btn btn-xs btn-danger pull-right"><i class="fa fa-tags"></i> Terbaru</button>';
                    $class = 'style="border: 2px solid #002F65;"';
                } else {
                    $label = '';
                    $class = '';
                }
                $id      = $this->encrypt->encode($field->lowongan_id);
                $title   = 'Lowongan pekerjaan PT BINA SARANA SUKSES '.$field->jabatan_alias ;
                $summary = 'Lowongan pekerjaan untuk posisi '.$field->jabatan_alias;
                $image   = 'https://bss.com/rekrutmen/s_url/logo_mobile';
                $url     = site_url('vacancy/detail/'.$id.'/'.strtolower($subtitle));

                $fb      = "window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=".$title."; ?>&amp;p[summary]=".$summary."&amp;p[url]=".$url."&amp;&p[images][0]=".$image."', 'sharer', 'toolbar=0,status=0,width=550,height=400');";
                $tw      = "https://twitter.com/share?source=sharethiscom&text=".$title."&url=".$url."&via=berbagiyuks";
                $in      = "https://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title."&summary=".$summary."&source=BerbagiYuks.com";
                $no++;
                $row    = array();
                $row[]  = '
                    <div style="padding: 0;">
                        <tr>
                            <td>
                                <a target="_blank" href="'.site_url('account/vacancy/detail/'.$id.'/'.strtolower($subtitle)).'">
                                    <div class="panel-default boxeshad nobottommargin" '.$class.'>
                                        <div class="panel-body">
                                            <div class="fancy-title" style="margin-bottom: 5px">
                                                <h5 class="title">'.$field->jabatan_alias.'</h5>
                                                <div class="pull-right"><i class="icon-line-ellipsis"></i></div>
                                            </div>
                                            <div class="heading-line nobottommargin">
                                                <p class="nobottommargin title black">
                                                    <i class="far fa-clock" style="font-size: 15px;color: #1883E9;padding-right: 5px;"></i>
                                                    Dipublikasikan pada tanggal : '.date("d/m/Y", strtotime($field->tgl_open)).''.$label.'
                                                </p>
                                                <a class="btn btn-xs btn-primary" onClick="'.$fb.'" target="_parent" href="javascript: void(0)">
                                                    <i class="icon-facebook f11" style="padding-right: 2px;padding-left: 2px;"></i>
                                                </a>
                                                <a class="btn btn-xs btn-cyan twitter popup" href="'.$tw.'">
                                                    <i class="icon-twitter f7"></i>
                                                </a>
                                                <a class="btn btn-xs btn-primary popup" href="'.$in.'" rel="nofollow">
                                                    <i class="icon-linkedin f9"></i>
                                                </a>
                                                <a class="btn btn-xs btn-danger" onClick="'.$fb.'" target="_parent" href="javascript: void(0)">
                                                    <i class="icon-email f9"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </div>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_loker->count_all(),
                "recordsFiltered" => $this->mod_karir_loker->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>