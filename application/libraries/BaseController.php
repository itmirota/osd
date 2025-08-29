<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller {
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $divisi_id = '';
	protected $loginType = '';
	protected $global = array ();
	
	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}

	function set_notifikasi_swal($icon,$title,$text){
		$this->session->set_flashdata('swal_icon', $icon);
		$this->session->set_flashdata('swal_title', $title);
		$this->session->set_flashdata('swal_text', $text);
	}
	
	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->pegawai_id = $this->session->userdata ( 'pegawai_id' );
			$this->vendorId = $this->session->userdata ( 'pegawai_id' );
			$this->name = $this->session->userdata ( 'name' );
			$this->divisi_id = $this->session->userdata ( 'divisi_id' );
			$this->jabatan_id = $this->session->userdata ( 'jabatan_id' );
			$this->divisi = $this->session->userdata ( 'divisi' );
			$this->loginType = $this->session->userdata ( 'loginType' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			
			$this->global ['userId'] = $this->vendorId;
			$this->global ['pegawai_id'] = $this->pegawai_id;
			$this->global ['name'] = $this->name;
			$this->global ['divisi_id'] = $this->divisi_id;
			$this->global ['divisiName'] = $this->divisi;
			$this->global ['jabatan_id'] = $this->jabatan_id;
			$this->global ['role'] = $this->role;
			$this->global ['loginType'] = $this->loginType;
			$this->global ['role_text'] = $this->roleText;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	function isAdmin() {
		if ($this->role != ROLE_SUPERADMIN) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * This function is used to load the set of views
	 */
	function loadThis() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		
		$this->load->view ( 'includes/header', $this->global );
		$this->load->view ( 'access' );
		$this->load->view ( 'includes/footer' );
	}
	
	/**
	 * This function is used to logged out user from system
	 */
	function logout() {
		$this->session->sess_destroy ();
		
		redirect ( 'login' );
	}

	/**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('adminpanel/includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('adminpanel/includes/footer', $footerInfo);
    }

	function loadViewsLogin($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('includes/header2', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

	function loadViewsUser($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

		$this->load->view('includes/header2', $headerInfo);
		$this->load->view($viewName, $pageInfo);
		$this->load->view('includes/footer', $footerInfo);
	}

	function generateBarcode($kode, $namaqrcode){
    $this->load->library('ciqrcode'); //pemanggilan library QR CODE

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']             = './assets/'; //string, the default is application/cache/
    $config['errorlog']             = './assets/'; //string, the default is application/logs/
    $config['imagedir']             = './assets/images/qrcode/'.$kode.'/'; //direktori penyimpanan qr code
    $config['quality']              = true; //boolean, the default is true
    $config['size']                 = '1024'; //interger, the default is 1024
    $config['black']                = array(224,255,255); // array, default is array(255,255,255)
    $config['white']                = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $image_name = $kode.'_'.$namaqrcode.'.png'; //buat name dari qr code sesuai dengan nim
 
    $params['data'] = $namaqrcode; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		return $image_name;
  }                                                                                         
	
	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10) {
		$this->load->library ( 'pagination' );
	
		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = SEGMENT;
		$config ['per_page'] = $perPage;
		$config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="arrow">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="arrow">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="arrow">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';
	
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( SEGMENT );
	
		return array (
				"page" => $page,
				"segment" => $segment
		);
	}
	
}